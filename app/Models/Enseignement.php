<?php

namespace App\Models;

use App\Models\PaiementInscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignement extends Model
{
    use HasFactory;

    protected $table = 'enseignements';

    protected $fillable = [
        'nom',
        'statut',
    ];

    // Relation avec les paiements
    public function paiements()
    {
        return $this->hasMany(PaiementInscription::class);
    }
}
