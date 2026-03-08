<?php

namespace App\Http\Controllers;

use App\Mail\RecuPaiementMail;
use App\Models\Circonscription;
use App\Models\Departement;
use App\Models\District;
use App\Models\Formation;
use App\Models\Galerie;
use App\Models\Option;
use App\Models\PaiementInscription;
use App\Models\Enseignement;
use App\Models\Province;
use App\Models\Region;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaiementInscriptionController extends Controller
{
    public function showForm()
    {
        $options = Option::all();
        $departements = Departement::all();
        $circonscriptions = Circonscription::all();
        $districts = District::all();
        $formations = Formation::all();
        $enseignements = Enseignement::all();
        $provinces = Province::all();
        $regions = Region::all();
        $galeries = Galerie::where('statut', 0)->get();

        return view('paiement', compact(
            'options',
            'departements',
            'circonscriptions',
            'districts',
            'formations',
            'enseignements',
            'provinces',
            'regions',
            'galeries'
        ));
    }

    // ================== AJAX ==================
    public function getCirconscriptions($departementId)
    {
        return response()->json(
            Circonscription::where('departement_id', $departementId)->orderBy('nom')->get()
        );
    }

    public function getFormations($districtId)
    {
        return response()->json(
            Formation::where('district_id', $districtId)->orderBy('nom')->get()
        );
    }

    public function getRegions($provinceId)
    {
        return response()->json(
            Region::where('province_id', $provinceId)->orderBy('nom')->get()
        );
    }

    public function process(Request $request)
{
    // ================= VALIDATION DE BASE =================
    $rules = [
        'nom' => 'required|string|max:255',
        'prenoms' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required',
        'option_id' => 'required|exists:options,id',
        'montant' => 'required|integer|min:1',
        'enseignement_id' => 'required|exists:enseignements,id',
    ];

    $enseignement = Enseignement::find($request->enseignement_id);

    if (!$enseignement) {
        return back()->withErrors(['enseignement_id' => 'Enseignement invalide']);
    }

    $slug = strtolower($enseignement->nom);

    // ================= VALIDATION SELON ENSEIGNEMENT =================
    if ($slug === 'maternelle' || $slug === 'primaire') {
        $rules['departement_id'] = 'required|exists:departements,id';
        $rules['circonscription_id'] = 'required|exists:circonscriptions,id';
        $rules['district_id'] = 'required|exists:districts,id';
        $rules['formation_id'] = 'required|exists:formations,id';
    }

    if ($slug === 'secondaire') {
        $rules['province_id'] = 'required|exists:provinces,id';
        $rules['region_id'] = 'required|exists:regions,id';
    }

    if ($slug === 'autre') {
        $rules['province_id'] = 'required|exists:provinces,id';
        $rules['region_id'] = 'required|exists:regions,id';
        $rules['autre_enseignement'] = 'required|string|max:255';
    }

    $request->validate($rules);

    // ================= GÉNÉRATION RÉFÉRENCE =================
    $reference = uniqid('pay_');

    // ================= CRÉATION TRANSACTION FEDAPAY =================
    $payload = [
        "description" => "Paiement D'inscription - {$request->prenoms} {$request->nom}",
        "amount" => (int)$request->montant,
        "currency" => ["iso" => "XOF"],
        "callback_url" => route('paiement.success', ['ref' => $reference]),

        "metadata" => [
            "reference" => $reference
        ],
        "customer" => [
            "firstname" => $request->prenoms,
            "lastname" => $request->nom,
            "email" => $request->email,
            "phone_number" => [
                "number" => "+229" . $request->phone,
                "country" => "bj"
            ]
        ]
    ];

    Log::info('➡️ Création transaction FedaPay', $payload);

    try {
        $response = Http::timeout(30)->withHeaders([
            'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.fedapay.com/v1/transactions', $payload);

    } catch (\Exception $e) {
        Log::error('Exception FedaPay', ['message' => $e->getMessage()]);
        return back()->with('error', 'Service paiement indisponible.');
    }

    if ($response->failed()) {
        return back()->with('error', 'Erreur paiement.');
    }

    $transactionData = $response->json()['v1/transaction'] ?? null;

    if (!$transactionData) {
        return back()->with('error', 'Réponse FedaPay invalide.');
    }

    // ================= ENREGISTREMENT EN BASE =================
    $paiement = PaiementInscription::create([
        'nom' => $request->nom,
        'prenoms' => $request->prenoms,
        'email' => $request->email,
        'phone' => $request->phone,
        'option_id' => $request->option_id,
        'enseignement_id' => $request->enseignement_id,

        'departement_id' => $request->departement_id,
        'circonscription_id' => $request->circonscription_id,
        'district_id' => $request->district_id,
        'formation_id' => $request->formation_id,

        'province_id' => $request->province_id,
        'region_id' => $request->region_id,
        'autre_enseignement' => $request->autre_enseignement,

        'montant' => $request->montant,
        'reference' => $reference,
        'transaction_id' => $transactionData['id'],
        'payment_url' => $transactionData['payment_url'] ?? null,
        'status' => 'pending',
    ]);

    // ================= REDIRECTION VERS PAGE PAIEMENT =================
    return redirect()->away($transactionData['payment_url']);
}

    // ================== WEBHOOK ==================
    public function webhook(Request $request)
    {
        Log::info('🔔 Webhook FedaPay', $request->all());

        $transaction = $request->input('entity');

        if (!$transaction || !isset($transaction['id'])) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $paiement = PaiementInscription::where('transaction_id', $transaction['id'])->first();

        if (!$paiement) {
            return response()->json(['error' => 'Paiement introuvable'], 404);
        }

        $paiement->status = $transaction['status'];
        $paiement->save();

        if ($transaction['status'] === 'approved' && !$paiement->recu_envoye) {
            Mail::to($paiement->email)->send(new RecuPaiementMail($paiement));
            $paiement->recu_envoye = true;
            $paiement->save();
        }

        return response()->json(['message' => 'Webhook traité'], 200);
    }

    // ================== SUCCESS ==================
    public function success(Request $request)
    {
        $reference = $request->query('ref');
        $paiement = PaiementInscription::where('reference', $reference)->firstOrFail();

        return view('paiement-success', compact('paiement'));
    }

    // ================== PDF ==================
    public function download(PaiementInscription $paiement)
    {
        if ($paiement->status !== 'approved') {
            abort(403, "Paiement non validé.");
        }

        $pdf = Pdf::loadView('paiement-recu', ['paiement' => $paiement]);
        return $pdf->download('recu-' . $paiement->transaction_id . '.pdf');
    }
}
