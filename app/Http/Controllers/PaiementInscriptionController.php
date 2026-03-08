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
use App\Models\PaiementTranche;
use App\Models\Province;
use App\Models\Region;
use App\Models\Parametre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaiementInscriptionController extends Controller
{
    // ====================================================================
    //  FORMULAIRE D'INSCRIPTION
    // ====================================================================

    public function showForm(Request $request)
    {
        $options        = Option::where('statut', 'visible')->get();
        $departements   = Departement::all();
        $circonscriptions = Circonscription::all();
        $districts      = District::all();
        $formations     = Formation::all();
        $enseignements  = Enseignement::all();
        $provinces      = Province::all();
        $regions        = Region::all();
        $galeries       = Galerie::where('statut', 0)->get();
        $selectedOption = $request->has('option') ? Option::find($request->option) : null;
        $parametres     = Parametre::first();

        return view('frontend.pages.paiement', compact(
            'options', 'departements', 'circonscriptions', 'districts',
            'formations', 'enseignements', 'provinces', 'regions',
            'galeries', 'selectedOption', 'parametres'
        ));
    }

    // ====================================================================
    //  AJAX — Données géographiques
    // ====================================================================

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

    // ====================================================================
    //  TRAITEMENT — PREMIER PAIEMENT
    // ====================================================================

    public function process(Request $request)
    {
        // --- Règles de base ---
        $rules = [
            'nom'            => 'required|string|max:255',
            'prenoms'        => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => ['required', 'regex:/^(01|02)\d{8}$/'],
            'option_id'      => 'required|exists:options,id',
            'montant'        => 'required|integer|min:1',
            'enseignement_id'=> 'required|exists:enseignements,id',
        ];

        $enseignement = Enseignement::find($request->enseignement_id);
        if (!$enseignement) {
            return back()->withErrors(['enseignement_id' => 'Enseignement invalide']);
        }

        $slug = strtolower($enseignement->nom);

        if (in_array($slug, ['maternelle', 'primaire'])) {
            $rules['departement_id']    = 'required|exists:departements,id';
            $rules['circonscription_id']= 'required|exists:circonscriptions,id';
            $rules['district_id']       = 'required|exists:districts,id';
            $rules['formation_id']      = 'required|exists:formations,id';
        }

        if (in_array($slug, ['secondaire', 'autre'])) {
            $rules['province_id'] = 'required|exists:provinces,id';
            $rules['region_id']   = 'required|exists:regions,id';
            if ($slug === 'autre') {
                $rules['autre_enseignement'] = 'required|string|max:255';
            }
        }

        $request->validate($rules, [
            'phone.regex' => 'Le numéro de téléphone doit commencer par 01 ou 02 et contenir 10 chiffres (ex: 0197000000).',
        ]);

        // --- Validation montant vs option ---
        $option = Option::findOrFail($request->option_id);
        $montant = (int) $request->montant;

        if ($montant > $option->option_montant) {
            return back()->withErrors([
                'montant' => 'Le montant ne peut pas dépasser ' .
                             number_format($option->option_montant, 0, ',', ' ') . ' FCFA.'
            ])->withInput();
        }

        if ($option->hasMontantMinimum() && $montant < $option->getMontantMinimumEffectif()) {
            return back()->withErrors([
                'montant' => 'Le montant minimum du premier versement est de ' .
                             number_format($option->montant_minimum, 0, ',', ' ') . ' FCFA.'
            ])->withInput();
        }

        // --- Références ---
        $reference = 'TRN-' . strtoupper(Str::random(10));
        $token     = $this->generateToken();

        // --- Payload FedaPay ---
        $payload = [
            'description'  => "Inscription - {$request->prenoms} {$request->nom}",
            'amount'       => $montant,
            'currency'     => ['iso' => 'XOF'],
            'callback_url' => route('paiement.success', ['ref' => $reference]),
            'metadata'     => ['reference' => $reference],
            'customer'     => [
                'firstname'    => $request->prenoms,
                'lastname'     => $request->nom,
                'email'        => $request->email,
                'phone_number' => [
                    'number'  => '+229' . $request->phone,
                    'country' => 'bj',
                ],
            ],
        ];

        Log::info('Création transaction FedaPay', $payload);

        try {
            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                'Content-Type'  => 'application/json',
            ])->post('https://api.fedapay.com/v1/transactions', $payload);
        } catch (\Exception $e) {
            Log::error('Exception FedaPay', ['message' => $e->getMessage()]);
            return back()->with('error', 'Service de paiement indisponible. Réessayez.');
        }

        if ($response->failed()) {
            return back()->with('error', 'Erreur lors de la création du paiement.');
        }

        $transactionData = $response->json()['v1/transaction'] ?? null;
        if (!$transactionData) {
            return back()->with('error', 'Réponse FedaPay invalide.');
        }

        // --- Enregistrement inscription ---
        $inscription = PaiementInscription::create([
            'nom'               => $request->nom,
            'prenoms'           => $request->prenoms,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'option_id'         => $request->option_id,
            'enseignement_id'   => $request->enseignement_id,
            'departement_id'    => $request->departement_id,
            'circonscription_id'=> $request->circonscription_id,
            'district_id'       => $request->district_id,
            'formation_id'      => $request->formation_id,
            'province_id'       => $request->province_id,
            'region_id'         => $request->region_id,
            'autre_enseignement'=> $request->autre_enseignement,
            'montant'           => $montant,
            'reference'         => $reference,
            'token'             => $token,
            'transaction_id'    => $transactionData['id'],
            'payment_url'       => $transactionData['payment_url'] ?? null,
            'status'            => 'pending',
        ]);

        // --- Enregistrement tranche ---
        PaiementTranche::create([
            'paiement_inscription_id' => $inscription->id,
            'montant_tranche'         => $montant,
            'reference'               => $reference,
            'transaction_id'          => $transactionData['id'],
            'payment_url'             => $transactionData['payment_url'] ?? null,
            'status'                  => 'pending',
        ]);

        return redirect()->away($transactionData['payment_url']);
    }

    // ====================================================================
    //  PAGE CONTINUER LE PAIEMENT — Saisie du code
    // ====================================================================

    public function showContinuerForm()
    {
        $parametres = Parametre::first();
        return view('frontend.pages.paiement-continuer', compact('parametres'));
    }

    public function rechercherDossier(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ], [
            'token.required' => 'Veuillez saisir votre code de suivi.',
        ]);

        $inscription = PaiementInscription::where('token', strtoupper(trim($request->token)))
            ->with('option')
            ->first();

        if (!$inscription) {
            return back()->withErrors([
                'token' => 'Aucun dossier trouvé avec ce code. Vérifiez et réessayez.',
            ])->withInput();
        }

        if ($inscription->estPaye()) {
            return back()->with('info', 'Ce dossier est déjà soldé. Aucun paiement supplémentaire requis.');
        }

        return redirect()->route('paiement.continuer.dossier', $inscription->token);
    }

    // ====================================================================
    //  PAGE DOSSIER — Affichage et paiement de tranche
    // ====================================================================

    public function showDossier(string $token)
    {
        $inscription = PaiementInscription::where('token', $token)
            ->with(['option', 'enseignement', 'tranches'])
            ->firstOrFail();

        $parametres = Parametre::first();

        return view('frontend.pages.paiement-dossier', compact('inscription', 'parametres'));
    }

    public function processContinuer(Request $request, string $token)
    {
        $inscription = PaiementInscription::where('token', $token)
            ->with('option')
            ->firstOrFail();

        if ($inscription->estPaye()) {
            return redirect()->route('paiement.continuer.dossier', $token)
                ->with('info', 'Ce dossier est déjà soldé.');
        }

        $resteAPayer = $inscription->resteAPayer();

        $request->validate([
            'montant' => 'required|integer|min:1|max:' . (int) $resteAPayer,
        ], [
            'montant.required' => 'Veuillez saisir un montant.',
            'montant.min'      => 'Le montant minimum est 1 FCFA.',
            'montant.max'      => 'Le montant ne peut pas dépasser le solde restant (' .
                                   number_format($resteAPayer, 0, ',', ' ') . ' FCFA).',
        ]);

        $montant   = (int) $request->montant;
        $reference = 'TRN-' . strtoupper(Str::random(10));

        $payload = [
            'description'  => "Paiement complémentaire - {$inscription->prenoms} {$inscription->nom}",
            'amount'       => $montant,
            'currency'     => ['iso' => 'XOF'],
            'callback_url' => route('paiement.success', ['ref' => $reference, 'dossier' => $token]),
            'metadata'     => ['reference' => $reference],
            'customer'     => [
                'firstname'    => $inscription->prenoms,
                'lastname'     => $inscription->nom,
                'email'        => $inscription->email,
                'phone_number' => [
                    'number'  => '+229' . $inscription->phone,
                    'country' => 'bj',
                ],
            ],
        ];

        try {
            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                'Content-Type'  => 'application/json',
            ])->post('https://api.fedapay.com/v1/transactions', $payload);
        } catch (\Exception $e) {
            return back()->with('error', 'Service de paiement indisponible.');
        }

        if ($response->failed()) {
            return back()->with('error', 'Erreur lors de la création du paiement.');
        }

        $transactionData = $response->json()['v1/transaction'] ?? null;
        if (!$transactionData) {
            return back()->with('error', 'Réponse FedaPay invalide.');
        }

        PaiementTranche::create([
            'paiement_inscription_id' => $inscription->id,
            'montant_tranche'         => $montant,
            'reference'               => $reference,
            'transaction_id'          => $transactionData['id'],
            'payment_url'             => $transactionData['payment_url'] ?? null,
            'status'                  => 'pending',
        ]);

        return redirect()->away($transactionData['payment_url']);
    }

    // ====================================================================
    //  CALLBACK FEDAPAY (retour navigateur)
    // ====================================================================

    public function callback(Request $request)
    {
        $transactionId = $request->query('id');

        if (!$transactionId) {
            return redirect()->route('frontend.paiement')->with('error', 'Transaction manquante.');
        }

        // Cherche d'abord dans les tranches
        $tranche = PaiementTranche::where('transaction_id', $transactionId)->first();

        if (!$tranche) {
            return redirect()->route('frontend.paiement')->with('error', 'Paiement introuvable.');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                'Content-Type'  => 'application/json',
            ])->get("https://api.fedapay.com/v1/transactions/{$transactionId}");

            if ($response->successful()) {
                $transaction = $response->json()['v1/transaction'];

                if ($transaction['status'] === 'approved') {
                    $this->approuverTranche($tranche);
                } elseif ($transaction['status'] === 'declined') {
                    $tranche->marquerCommeEchoue();
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur callback FedaPay', ['error' => $e->getMessage()]);
        }

        return redirect()->route('paiement.success', ['ref' => $tranche->reference]);
    }

    // ====================================================================
    //  WEBHOOK FEDAPAY
    // ====================================================================

    public function webhook(Request $request)
    {
        Log::info('Webhook FedaPay reçu', $request->all());

        $receivedSecret = $request->header('X-FedaPay-Signature');
        if ($receivedSecret !== config('services.fedapay.webhook_secret')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $transaction = $request->input('entity');
        if (!$transaction || !isset($transaction['id'])) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $transactionId  = $transaction['id'];
        $fedapayStatus  = $transaction['status'] ?? null;

        // Cherche la tranche correspondante
        $tranche = PaiementTranche::where('transaction_id', $transactionId)->first();

        if (!$tranche) {
            Log::error("Tranche introuvable : {$transactionId}");
            return response()->json(['error' => 'Tranche introuvable'], 404);
        }

        if (in_array($fedapayStatus, ['approved', 'paid'])) {
            $this->approuverTranche($tranche);
        } elseif (in_array($fedapayStatus, ['declined', 'canceled', 'failed'])) {
            $tranche->marquerCommeEchoue();
        }

        return response()->json(['message' => 'Webhook traité'], 200);
    }

    // ====================================================================
    //  PAGE DE SUCCÈS
    // ====================================================================

    public function success(Request $request)
    {
        $reference = $request->query('ref');
        if (!$reference) {
            abort(404);
        }

        // Cherche la tranche par référence
        $tranche = PaiementTranche::where('reference', $reference)
            ->with(['inscription.option', 'inscription.enseignement'])
            ->first();

        if (!$tranche) {
            // Fallback: cherche directement dans l'inscription (ancien comportement)
            $inscription = PaiementInscription::where('reference', $reference)
                ->with('option')
                ->firstOrFail();
        } else {
            $inscription = $tranche->inscription;

            // Vérifier le vrai statut via FedaPay si la tranche n'est pas encore finalisée
            if ($tranche->status === 'pending' && $tranche->transaction_id) {
                try {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                        'Content-Type'  => 'application/json',
                    ])->get("https://api.fedapay.com/v1/transactions/{$tranche->transaction_id}");

                    if ($response->successful()) {
                        $fedaStatus = $response->json()['v1/transaction']['status'] ?? null;
                        if (in_array($fedaStatus, ['approved', 'paid'])) {
                            $this->approuverTranche($tranche);
                        } elseif (in_array($fedaStatus, ['declined', 'canceled', 'failed'])) {
                            $tranche->update(['status' => 'failed']);
                        }
                        $tranche->refresh();
                        $inscription->refresh();
                    }
                } catch (\Exception $e) {
                    Log::error('Erreur vérification statut FedaPay (success)', ['error' => $e->getMessage()]);
                }
            }
        }

        // Si paiement de continuation → rediriger vers le dossier
        if ($request->query('dossier') && $inscription->token) {
            return redirect()->route('paiement.continuer.dossier', $inscription->token)
                ->with('info', $tranche && $tranche->status === 'approved'
                    ? 'Votre versement a bien été enregistré.'
                    : 'Paiement non confirmé. Veuillez réessayer.');
        }

        $parametres = Parametre::first();

        return view('frontend.pages.paiement-success', compact('inscription', 'tranche', 'parametres'));
    }

    // ====================================================================
    //  STATUS (vérification FedaPay)
    // ====================================================================

    public function status(Request $request)
    {
        $reference = $request->query('ref');
        if (!$reference) abort(404);

        $paiement   = PaiementInscription::where('reference', $reference)->firstOrFail();
        $parametres = Parametre::first();

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                'Content-Type'  => 'application/json',
            ])->get("https://api.fedapay.com/v1/transactions/{$paiement->transaction_id}");

            if ($response->successful()) {
                $tx = $response->json()['v1/transaction'];
                if ($tx['status'] === 'approved') $paiement->status = 'approved';
                elseif ($tx['status'] === 'declined') $paiement->status = 'failed';
                $paiement->save();
            }
        } catch (\Exception $e) {
            Log::error('Erreur vérification FedaPay', ['message' => $e->getMessage()]);
        }

        return view('frontend.pages.paiement-recu', compact('paiement', 'parametres'));
    }

    // ====================================================================
    //  TÉLÉCHARGEMENT REÇU
    // ====================================================================

    public function download(PaiementInscription $paiement)
    {
        $parametres = Parametre::first();
        $pdf = Pdf::loadView('frontend.pages.paiement-recu', compact('paiement', 'parametres'));
        return $pdf->download('recu_' . $paiement->reference . '.pdf');
    }

    public function downloadDossier(PaiementInscription $paiement)
    {
        $parametres = Parametre::first();
        $paiement->load(['option', 'enseignement', 'tranches' => fn($q) => $q->where('status', 'approved')->orderBy('created_at')]);
        $pdf = Pdf::loadView('frontend.pages.paiement-recu-dossier', compact('paiement', 'parametres'));
        return $pdf->download('dossier_' . $paiement->token . '.pdf');
    }

    public function downloadTranche(PaiementTranche $tranche)
    {
        $parametres = Parametre::first();
        $tranche->load('inscription.option');
        $pdf = Pdf::loadView('frontend.pages.paiement-recu-tranche', compact('tranche', 'parametres'));
        return $pdf->download('recu_tranche_' . $tranche->reference . '.pdf');
    }

    // ====================================================================
    //  HELPERS PRIVÉS
    // ====================================================================

    /**
     * Approuve une tranche et met à jour le statut de l'inscription.
     */
    private function approuverTranche(PaiementTranche $tranche): void
    {
        if ($tranche->status === 'approved') return; // déjà traité

        $tranche->status = 'approved';
        $tranche->save();

        $inscription = $tranche->inscription ?? PaiementInscription::find($tranche->paiement_inscription_id);
        if (!$inscription) return;

        if ($inscription->estPaye()) {
            $inscription->status = 'approved';

            // Envoi du reçu une seule fois à solde complet
            if (!$inscription->recu_envoye) {
                $this->envoyerRecu($inscription);
            }
        } else {
            $inscription->status = 'partiel';
        }

        $inscription->save();

        Log::info("Tranche {$tranche->id} approuvée — inscription {$inscription->id} statut : {$inscription->status}");
    }

    /**
     * Envoie le reçu par email et marque l'inscription.
     */
    private function envoyerRecu(PaiementInscription $inscription): void
    {
        try {
            $parametres = Parametre::first();

            $pdf = Pdf::loadView('email.paiement_recu', [
                'paiement' => $inscription,
                'logo'     => $parametres?->photo
                    ? asset('uploads/' . $parametres->photo)
                    : asset('uploads/default.png'),
                'siteName' => $parametres?->website_name ?? 'MAFLYT SARL',
            ])->setPaper('A4', 'portrait');

            Mail::to($inscription->email)->send(new RecuPaiementMail($inscription, $parametres, $pdf->output()));
            Mail::to('maflyt26@gmail.com')->send(new RecuPaiementMail($inscription, $parametres, $pdf->output()));

            $inscription->recu_envoye = true;
            Log::info("Reçu envoyé à {$inscription->email}");
        } catch (\Exception $e) {
            Log::error('Erreur envoi reçu : ' . $e->getMessage());
        }
    }

    /**
     * Génère un token unique de suivi (ex: MAF-2025-A3F7K).
     */
    private function generateToken(): string
    {
        do {
            $token = 'MAF-' . date('Y') . '-' . strtoupper(Str::random(5));
        } while (PaiementInscription::where('token', $token)->exists());

        return $token;
    }
}
