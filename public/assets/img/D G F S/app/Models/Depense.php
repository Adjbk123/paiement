<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'semaine',
        'salaire',
        'eau',
        'eletricite',
        'communication',
        'carburant',
        'deplacement',
        'sante',
        'entretien',
        'fourniture',
        'amotisement',
        'le_20',
        'le_15',
        'loyer',
        'fas',
        'fospa',
        'dnam',
        'autre'
    ];
}



  
