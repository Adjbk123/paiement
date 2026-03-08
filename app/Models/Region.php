<?php

namespace App\Models;

use App\Models\PaiementInscription;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'province_id',

    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function paiements()
    {
        return $this->hasMany(PaiementInscription::class);
    }
}
