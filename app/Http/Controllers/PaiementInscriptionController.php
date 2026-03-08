<?php

namespace App\Http\Controllers;

use App\Mail\RecuPaiementMail;
use App\Models\Circonscription;
use App\Models\Departement;
use App\Models\District;
use App\Models\Enseignement;
use App\Models\Formation;
use App\Models\Galerie;
use App\Models\Option;
use App\Models\PaiementInscription;
use App\Models\Province;
use App\Models\Region;
use App\Models\Parametre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PaiementInscriptionController extends Controller
{
    // ================== FORMULAIRE ==================
    public function showForm(Request $request)
    {
        $options = Option::where('statut', 'visible')->get();
        $departements = Departement::all();
        $circonscriptions = Circonscription::all();
        $districts = District::all();
        $formations = Formation::all();
        $enseignements = Enseignement::all();
        $provinces = Province::all();
        $regions = Region::all();
        $galeries = Galerie::where('statut', 0)->get();
        $selectedOption = $request->has('option') ? Option::find($request->option) : null;

        return view('frontend.pages.paiement', compact(
            'options',
            'departements',
            'circonscriptions',
            'districts',
            'formations',
            'enseignements',
            'provinces',
            'regions',
            'galeries',
            'selectedOption'
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

    // ================== PROCESS PAIEMENT ==================
    public function process(Request $request)
    {
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
        if (!$enseignement) return back()->withErrors(['enseignement_id' => 'Enseignement invalide']);

        $slug = strtolower($enseignement->nom);

        if (in_array($slug, ['maternelle', 'primaire'])) {
            $rules['departement_id'] = 'required|exists:departements,id';
            $rules['circonscription_id'] = 'required|exists:circonscriptions,id';
            $rules['district_id'] = 'required|exists:districts,id';
            $rules['formation_id'] = 'required|exists:formations,id';
        }

        if (in_array($slug, ['secondaire', 'autre'])) {
            $rules['province_id'] = 'required|exists:provinces,id';
            $rules['region_id'] = 'required|exists:regions,id';
            if ($slug === 'autre') $rules['autre_enseignement'] = 'required|string|max:255';
        }

        $request->validate($rules);

        $reference = uniqid('pay_');

        $payload = [
            "description" => "Paiement D'inscription - {$request->prenoms} {$request->nom}",
            "amount" => (int)$request->montant,
            "currency" => ["iso" => "XOF"],
            "callback_url" => route('paiement.success', ['ref' => $reference]),
            "metadata" => ["reference" => $reference],
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
                'Content-Type' => 'application/json',
            ])->post('https://api.fedapay.com/v1/transactions', $payload);
        } catch (\Exception $e) {
            Log::error('Exception FedaPay', ['message' => $e->getMessage()]);
            return back()->with('error', 'Service paiement indisponible.');
        }

        if ($response->failed()) return back()->with('error', 'Erreur paiement.');

        $transactionData = $response->json()['v1/transaction'] ?? null;
        if (!$transactionData) return back()->with('error', 'Réponse FedaPay invalide.');

        // Enregistrement paiement (sans tranches)
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

        return redirect()->away($transactionData['payment_url']);
    }


    public function callback(Request $request)
    {
        $transactionId = $request->query('id');

        if (!$transactionId) {
            return redirect()->route('paiement.status')
                ->with('error', 'Transaction manquante');
        }

        $paiement = PaiementInscription::where('transaction_id', $transactionId)->first();

        if (!$paiement) {
            return redirect()->route('paiement.status')
                ->with('error', 'Paiement introuvable');
        }

        try {

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                'Content-Type' => 'application/json',
            ])->get("https://api.fedapay.com/v1/transactions/{$transactionId}");

            if ($response->successful()) {

                $transaction = $response->json()['v1/transaction'];

                if ($transaction['status'] === 'approved') {

                    $paiement->status = 'approved';

                    if (!$paiement->recu_envoye) {

                        $parametres = Parametre::first();

                        Mail::to($paiement->email)
                            ->bcc('maflyt26@gmail.com')
                            ->send(new RecuPaiementMail($paiement, $parametres));

                        $paiement->recu_envoye = true;
                    }
                }

                if ($transaction['status'] === 'declined') {
                    $paiement->status = 'failed';
                }

                $paiement->save();
            }
        } catch (\Exception $e) {

            Log::error('Erreur vérification FedaPay callback', [
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->route('paiement.status', $transactionId);
    }
    public function webhook(Request $request)
    {
        Log::info('🔔 Webhook FedaPay reçu', $request->all());

        // ✅ Vérification signature webhook
        $receivedSecret = $request->header('X-FedaPay-Signature');
        if ($receivedSecret !== config('services.fedapay.webhook_secret')) {
            Log::warning('❌ Signature webhook invalide');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ✅ Récupération transaction
        $transaction = $request->input('entity');
        if (!$transaction || !isset($transaction['id'])) {
            Log::error('❌ Transaction invalide', $request->all());
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $transactionId = $transaction['id'];
        $fedapayStatus = $transaction['status'] ?? null;

        // ✅ Recherche du paiement
        $paiement = PaiementInscription::where('transaction_id', $transactionId)->first();
        if (!$paiement) {
            Log::error("❌ Paiement introuvable : $transactionId");
            return response()->json(['error' => 'Paiement introuvable'], 404);
        }

        // ✅ Conversion statut FedaPay
        $status = $paiement->status;
        if (in_array($fedapayStatus, ['approved', 'paid'])) $status = 'approved';
        if (in_array($fedapayStatus, ['declined', 'canceled', 'failed'])) $status = 'pending';

        // ✅ Mise à jour du statut
        $paiement->status = $status;

        // ✅ Envoi du reçu **une seule fois** si paiement approuvé
        if ($status === 'approved' && !$paiement->recu_envoye) {
            try {
                $parametres = Parametre::first();

                // Génération du PDF avec logo et nom du site
                $pdf = Pdf::loadView('email.paiement_recu', [
                    'paiement' => $paiement,
                    'logo' => $parametres?->photo ? asset('uploads/' . $parametres->photo) : asset('uploads/default.png'),
                    'siteName' => $parametres?->website_name ?? 'MAFLYT SARL'
                ])->setPaper('A4', 'portrait');

                Log::info("📨 Envoi reçu au client et à MAFLYT");

                // ✅ Envoi au client
                Mail::to($paiement->email)
                    ->send(new RecuPaiementMail($paiement, $parametres, $pdf->output()));

                // ✅ Envoi à MAFLYT
                Mail::to('maflyt26@gmail.com')
                    ->send(new RecuPaiementMail($paiement, $parametres, $pdf->output()));

                $paiement->recu_envoye = true;

                Log::info("✅ Reçu envoyé à {$paiement->email} et à MAFLYT");
            } catch (\Exception $e) {
                Log::error("❌ Erreur envoi email : " . $e->getMessage());
            }
        }

        $paiement->save();

        Log::info("✅ Paiement $transactionId mis à jour avec statut '$status'");

        return response()->json([
            'message' => 'Webhook traité avec succès'
        ], 200);
    }

   public function success(Request $request)
{
    $reference = $request->query('ref');
    $status = $request->query('status');

    if (!$reference) {
        abort(404);
    }

    $paiement = PaiementInscription::where('reference', $reference)->firstOrFail();

    // Mise à jour du statut
    if ($status == 'approved') {
        $paiement->status = 'approved';
        $paiement->save();
    }

    $parametres = Parametre::first();

    return view('frontend.pages.paiement-success', [
        'paiement' => $paiement,
        'parametres' => $parametres,
    ]);
}
    public function status(Request $request)
    {
        // Récupère la référence dans l'URL
        $reference = $request->query('ref');
        if (!$reference) {
            abort(404, "Référence de paiement manquante.");
        }

        // Cherche le paiement correspondant
        $paiement = PaiementInscription::where('reference', $reference)->firstOrFail();

        // Récupère les paramètres de la société
        $parametres = Parametre::first();

        // Vérifie le statut du paiement auprès de FedaPay
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                'Content-Type' => 'application/json',
            ])->get("https://api.fedapay.com/v1/transactions/{$paiement->transaction_id}");

            if ($response->successful()) {
                $transaction = $response->json()['v1/transaction'];

                if ($transaction['status'] === 'approved') {
                    $paiement->status = 'approved';
                } elseif ($transaction['status'] === 'declined') {
                    $paiement->status = 'failed';
                }

                $paiement->save();
            }
        } catch (\Exception $e) {
            Log::error('Erreur vérification FedaPay', ['message' => $e->getMessage()]);
        }

        // Affiche la vue avec le paiement et les paramètres
        return view('frontend.pages.paiement-recu', [
            'paiement' => $paiement,
            'parametres' => $parametres,
        ]);
    }
    public function download(PaiementInscription $paiement)
{
    $parametres = Parametre::first();

    $pdf = Pdf::loadView('frontend.pages.paiement-recu', [
        'paiement' => $paiement,
        'parametres' => $parametres
    ]);

    return $pdf->download('recu_'.$paiement->reference.'.pdf');
}
}
