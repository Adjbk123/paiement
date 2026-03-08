<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;

class Circonscription extends Model
{
    protected $fillable = [
        'departement_id',
        'nom'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}
