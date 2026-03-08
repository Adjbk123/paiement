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
        $galeries = Galerie::where('statut', 0)->get();
        return view('paiement', compact(
            'options',
            'departements',
            'circonscriptions',
            'districts',
            'formations',
            'galeries'
        ));
    }

    public function getCirconscriptions($id)
    {
        return response()->json(
            Circonscription::where('departement_id', $id)->orderBy('nom')->get()
        );
    }

    public function getFormations($id)
    {
        return response()->json(
            Formation::where('district_id', $id)->orderBy('nom')->get()
        );
    }

    public function process(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'option_id' => 'required|exists:options,id',
            'departement_id' => 'required|exists:departements,id',
            'circonscription_id' => 'required|exists:circonscriptions,id',
            'district_id' => 'required|exists:districts,id',
            'formation_id' => 'required|exists:formations,id',
            'montant' => 'required|integer|min:1',
        ]);

        $reference = uniqid('pay_');

        $payload = [
            "description" => "Paiement scolarité - {$request->prenoms} {$request->nom}",
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
            ])->post('https://sandbox-api.fedapay.com/v1/transactions', $payload);
        } catch (\Exception $e) {

            Log::error('🔥 Exception FedaPay', ['message' => $e->getMessage()]);
            return back()->with('error', 'Service paiement indisponible.');
        }

        if ($response->failed()) {

            Log::error('❌ Erreur FedaPay', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return back()->with('error', 'Erreur paiement : ' . $response->body());
        }

        $transactionData = $response->json()['v1/transaction'] ?? null;

        if (!$transactionData) {
            return back()->with('error', 'Réponse FedaPay invalide.');
        }

        $paiement = PaiementInscription::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'phone' => $request->phone,
            'option_id' => $request->option_id,
            'departement_id' => $request->departement_id,
            'circonscription_id' => $request->circonscription_id,
            'district_id' => $request->district_id,
            'formation_id' => $request->formation_id,
            'montant' => $request->montant,
            'reference' => $reference,
            'transaction_id' => $transactionData['id'],
            'status' => 'pending',
        ]);

        $paymentUrl = $transactionData['payment_url'] ?? $transactionData['url'] ?? null;

        if (!$paymentUrl) {
            return back()->with('error', 'Lien paiement indisponible.');
        }

        return redirect()->away($paymentUrl);
    }

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

    public function success(Request $request)
    {
        $reference = $request->query('ref');

        $paiement = PaiementInscription::where('reference', $reference)->firstOrFail();

        return view('paiement-success', compact('paiement'));
    }

    public function download(PaiementInscription $paiement)
    {
        if ($paiement->status !== 'approved') {
            abort(403, "Paiement non validé.");
        }

        $pdf = Pdf::loadView('paiement-recu', ['paiement' => $paiement]);

        return $pdf->download('recu-' . $paiement->transaction_id . '.pdf');
    }
}
