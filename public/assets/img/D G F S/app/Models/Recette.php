<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'semaine',
        'dime' ,
        'offrande' ,
        
        'offrande_m' ,
        'offrande_j' ,
        'offrande_special' ,
        'edl'  ,
        'action_grace'  ,
        'dnam'  ,
        'autre' 
    ];
}




