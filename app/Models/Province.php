<?php

namespace App\Models;

use App\Models\PaiementInscription;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $fillable = [
        'nom',
        
    ];

    // Relation avec les régions
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    // Relation avec les paiements si nécessaire
    public function paiements()
    {
        return $this->hasMany(PaiementInscription::class);
    }
}
