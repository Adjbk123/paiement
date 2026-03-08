<?php

namespace App\Models;

use App\Models\DepartementFormation;
use Illuminate\Database\Eloquent\Model;

class CirconscriptionFormation extends Model
{
    protected $fillable = [
        'nom',
        'departement_formation_id'
    ];

    /**
     * Une circonscription appartient à un département de formation
     */
    public function departement()
    {
        return $this->belongsTo(DepartementFormation::class, 'departement_formation_id');
    }
}
