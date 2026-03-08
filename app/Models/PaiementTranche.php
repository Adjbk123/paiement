<?php

namespace App\Models;

use App\Models\PaiementInscription;
use Illuminate\Database\Eloquent\Model;

class PaiementTranche extends Model
{
    protected $table = 'paiement_tranches';

    protected $fillable = [
        'paiement_inscription_id',
        'montant_tranche',
        'reference',
        'transaction_id',
        'payment_url',
        'status',
    ];

    protected $casts = [
        'montant_tranche' => 'float',
    ];

    // ================= Relations =================
    public function inscription()
    {
        return $this->belongsTo(PaiementInscription::class, 'paiement_inscription_id');
    }

    // ================= Vérifications =================
    public function estPaye(): bool
    {
        return $this->status === 'approved';
    }

    // ================= Actions =================
    public function marquerCommePaye(): void
    {
        $this->status = 'approved';
        $this->save();
    }

    public function marquerCommeEchoue(): void
    {
        $this->status = 'failed';
        $this->save();
    }

    public function marquerCommeEnAttente(): void
    {
        $this->status = 'pending';
        $this->save();
    }
}
