<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaiementInscription extends Model
{
     use SoftDeletes; // <-- activer Soft Delete
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
        'token',
        'transaction_id',
        'payment_url',
        'description',
    ];

    protected $casts = [
        'montant' => 'float',
        'recu_envoye' => 'boolean',
    ];

    protected $dates = ['deleted_at']; // <-- colonne pour Soft Delete



    /* =====================================================
        RELATIONS
    ===================================================== */

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

    public function tranches()
    {
        return $this->hasMany(PaiementTranche::class);
    }

    /* =====================================================
        LOGIQUE METIER
    ===================================================== */

    public function totalPaye(): float
    {
        if ($this->relationLoaded('tranches')) {
            return (float) $this->tranches
                ->where('status', 'approved')
                ->sum('montant_tranche');
        }

        return (float) $this->tranches()
            ->where('status', 'approved')
            ->sum('montant_tranche');
    }

    public function montantTotal(): float
    {
        return (float) ($this->option->option_montant ?? 0);
    }

    public function resteAPayer(): float
    {
        return max(0, $this->montantTotal() - $this->totalPaye());
    }

    public function estPaye(): bool
    {
        return $this->totalPaye() >= $this->montantTotal();
    }

    public function estPartiel(): bool
    {
        return $this->totalPaye() > 0 && !$this->estPaye();
    }

    public function recuEnvoye(): bool
    {
        return $this->recu_envoye === true;
    }

    /* =====================================================
        ACTIONS
    ===================================================== */

    public function marquerCommePaye(?string $transactionId = null): void
    {
        $this->status = 'paid';

        if ($transactionId) {
            $this->transaction_id = $transactionId;
        }

        $this->save();
    }

    public function marquerCommePartiel(): void
    {
        $this->status = 'partiel';
        $this->save();
    }

    public function marquerCommeEchoue(): void
    {
        $this->status = 'failed';
        $this->save();
    }
}
