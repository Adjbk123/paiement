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
            'options','departements','circonscriptions','districts',
            'formations','enseignements','provinces','regions','galeries','selectedOption'
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
        // VALIDATION DE BASE
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
        if (!$enseignement) return back()->withErrors(['enseignement_id'=>'Enseignement invalide']);

        $slug = strtolower($enseignement->nom);

        // Validation selon enseignement
        if (in_array($slug, ['maternelle','primaire'])) {
            $rules['departement_id']='required|exists:departements,id';
            $rules['circonscription_id']='required|exists:circonscriptions,id';
            $rules['district_id']='required|exists:districts,id';
            $rules['formation_id']='required|exists:formations,id';
        }

        if (in_array($slug, ['secondaire','autre'])) {
            $rules['province_id']='required|exists:provinces,id';
            $rules['region_id']='required|exists:regions,id';
            if ($slug==='autre') $rules['autre_enseignement']='required|string|max:255';
        }

        $request->validate($rules);

        // Génération de référence
        $reference = uniqid('pay_');

        // Création transaction FedaPay
        $payload = [
            "description" => "Paiement D'inscription - {$request->prenoms} {$request->nom}",
            "amount" => (int)$request->montant,
            "currency" => ["iso"=>"XOF"],
            "callback_url" => route('paiement.success',['ref'=>$reference]),
            "metadata"=>["reference"=>$reference],
            "customer"=>[
                "firstname"=>$request->prenoms,
                "lastname"=>$request->nom,
                "email"=>$request->email,
                "phone_number"=>[
                    "number"=>"+229".$request->phone,
                    "country"=>"bj"
                ]
            ]
        ];

        Log::info('➡️ Création transaction FedaPay', $payload);

        try {
            $response = Http::timeout(30)->withHeaders([
                'Authorization'=>'Bearer '.config('services.fedapay.secret'),
                'Content-Type'=>'application/json',
            ])->post('https://api.fedapay.com/v1/transactions', $payload);
        } catch (\Exception $e) {
            Log::error('Exception FedaPay',['message'=>$e->getMessage()]);
            return back()->with('error','Service paiement indisponible.');
        }

        if ($response->failed()) return back()->with('error','Erreur paiement.');

        $transactionData = $response->json()['v1/transaction'] ?? null;
        if (!$transactionData) return back()->with('error','Réponse FedaPay invalide.');

        // Enregistrement paiement
        $paiement = PaiementInscription::create([
            'nom'=>$request->nom,
            'prenoms'=>$request->prenoms,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'option_id'=>$request->option_id,
            'enseignement_id'=>$request->enseignement_id,
            'departement_id'=>$request->departement_id,
            'circonscription_id'=>$request->circonscription_id,
            'district_id'=>$request->district_id,
            'formation_id'=>$request->formation_id,
            'province_id'=>$request->province_id,
            'region_id'=>$request->region_id,
            'autre_enseignement'=>$request->autre_enseignement,
            'montant'=>$request->montant,
            'reference'=>$reference,
            'transaction_id'=>$transactionData['id'],
            'payment_url'=>$transactionData['payment_url'] ?? null,
            'status'=>'pending',
        ]);

        return redirect()->away($transactionData['payment_url']);
    }

    // ================== WEBHOOK ==================
    public function webhook(Request $request)
    {
        $receivedSecret = $request->header('X-FedaPay-Signature');
        if ($receivedSecret!==config('services.fedapay.webhook_secret')) {
            Log::warning('Webhook FedaPay invalide !', $request->all());
            return response()->json(['error'=>'Unauthorized'],401);
        }

        Log::info('🔔 Webhook FedaPay reçu',$request->all());

        $transaction = $request->input('entity');
        if (!$transaction || !isset($transaction['id'])) return response()->json(['error'=>'Invalid data'],400);

        $paiement = PaiementInscription::where('transaction_id',$transaction['id'])->first();
        if (!$paiement) return response()->json(['error'=>'Paiement introuvable'],404);

        $trancheExistante = $paiement->tranches()->where('transaction_id',$transaction['id'])->first();
        if (!$trancheExistante) {
            $tranche = $paiement->tranches()->create([
                'montant_tranche'=>$transaction['amount'],
                'transaction_id'=>$transaction['id'],
                'status'=>$transaction['status']==='approved' ? 'approved' : $transaction['status'],
            ]);
        } else {
            $tranche = $trancheExistante;
            $tranche->status = $transaction['status'];
            $tranche->save();
        }

        // Mise à jour status global
        if ($paiement->totalPaye() >= ($paiement->option->option_montant ?? 0)) {
            $paiement->status = 'approved';
        } elseif ($paiement->totalPaye() > 0) {
            $paiement->status = 'partiel';
        } else {
            $paiement->status = $transaction['status'];
        }
        $paiement->save();

        // PDF et mail si approuvé
        if ($transaction['status']==='approved') {
            $parametres = Parametre::first();
            $pdf = Pdf::loadView('frontend.pages.paiement-tranche-recu',[
                'paiement'=>$paiement,
                'tranche'=>$tranche,
                'totalPaye'=>$paiement->totalPaye(),
                'reste'=>$paiement->resteAPayer(),
                'parametres'=>$parametres
            ]);
            Mail::to($paiement->email)->send(new RecuPaiementMail($paiement,$pdf));
        }

        return response()->json(['message'=>'Webhook traité avec succès'],200);
    }

    // ================== STATUS ==================
    public function status($transactionId)
    {
        $paiement = PaiementInscription::where('transaction_id',$transactionId)->firstOrFail();
        return view('frontend.pages.paiement-status',compact('paiement'));
    }

    // ================== SUCCESS ==================
    public function success(Request $request)
    {
        $reference = $request->query('ref');
        if (!$reference) abort(404);

        $paiement = PaiementInscription::where('reference',$reference)->firstOrFail();

        try {
            $response = Http::withHeaders([
                'Authorization'=>'Bearer '.config('services.fedapay.secret'),
                'Content-Type'=>'application/json',
            ])->get("https://api.fedapay.com/v1/transactions/{$paiement->transaction_id}");

            if ($response->successful()) {
                $transaction = $response->json()['v1/transaction'];

                if ($transaction['status']==='approved') $paiement->status='paid';
                elseif ($transaction['status']==='declined') $paiement->status='failed';

                $paiement->save();
            }

        } catch (\Exception $e) {
            Log::error('Erreur vérification FedaPay',['message'=>$e->getMessage()]);
        }

        return view('frontend.pages.paiement-success',compact('paiement'));
    }

    // ================== PDF ==================
    public function download(PaiementInscription $paiement)
    {
        if ($paiement->totalPaye() <= 0) abort(403,"Aucun paiement n'a été effectué pour ce reçu.");

        $tranches = $paiement->tranches()->where('status','approved')->get();
        $totalPaye = $paiement->totalPaye();
        $reste = ($paiement->option->option_montant ?? 0) - $totalPaye;

        $parametres = Parametre::first();

        $pdf = Pdf::loadView('frontend.pages.paiement-tranche-recu',[
            'paiement'=>$paiement,
            'tranches'=>$tranches,
            'totalPaye'=>$totalPaye,
            'reste'=>$reste,
            'parametres'=>$parametres
        ]);

        return $pdf->download('recu-'.$paiement->reference.'.pdf');
    }
}
