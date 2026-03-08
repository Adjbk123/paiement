<?php

namespace App\Models;

use App\Models\Circonscription;
use App\Models\Departement;
use App\Models\District;
use App\Models\Formation;
use App\Models\Option;
use App\Models\Enseignement;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PaiementInscription extends Model
{
    protected $table = 'paiement_inscriptions';

    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'phone',
        'option_id',
        'departement_id',
        'circonscription_id',
        'district_id',
        'formation_id',
        'enseignement_id',
        'autre_enseignement',
        'province_id',
        'region_id',
        'montant',
        'status',
        'recu_envoye',
        'reference',
        'transaction_id',
        'payment_url',
        'description',
    ];

    // ================= Relations =================
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function circonscription()
    {
        return $this->belongsTo(Circonscription::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function enseignement()
    {
        return $this->belongsTo(Enseignement::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // ================= Vérifications =================
    public function estPaye(): bool
    {
        return $this->status === 'paid';
    }

    public function recuEnvoye(): bool
    {
        return (bool) $this->recu_envoye;
    }

    // ================= Actions =================
    public function marquerCommePaye(string $transactionId = null): void
    {
        $this->status = 'paid';
        if ($transactionId) {
            $this->transaction_id = $transactionId;
        }
        $this->save();
    }

    public function marquerCommeEchoue(): void
    {
        $this->status = 'failed';
        $this->save();
    }

    // ================= Vérification FedaPay =================
    public function verifierStatut(): ?string
    {
        if (!$this->transaction_id) {
            Log::warning('⚠️ verifierStatut appelé sans transaction_id', ['paiement_id' => $this->id]);
            return null;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.fedapay.secret'),
                'Content-Type' => 'application/json',
            ])->get("https://api.fedapay.com/v1/transactions/{$this->transaction_id}");

            Log::info('📡 Requête statut FedaPay', [
                'transaction_id' => $this->transaction_id,
                'http_status' => $response->status()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $transactionData = $data['v1/transaction'] ?? $data;

                if ($transactionData && isset($transactionData['status'])) {
                    $this->status = $transactionData['status'];
                    $this->save();

                    Log::info('✅ Statut paiement mis à jour', [
                        'transaction_id' => $this->transaction_id,
                        'status' => $transactionData['status']
                    ]);

                    return $transactionData['status'];
                }
            } else {
                Log::error('❌ Erreur récupération statut FedaPay', ['body' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('🔥 Exception verifierStatut', [
                'transaction_id' => $this->transaction_id,
                'message' => $e->getMessage()
            ]);
        }

        return null;
    }
}
