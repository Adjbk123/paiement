<?php

namespace App\Models;

use App\Models\CirconscriptionFormation;
use Illuminate\Database\Eloquent\Model;

class DepartementFormation extends Model
{
    protected $table = 'departement_formations';

    protected $fillable = [
        'nom'
    ];

    /**
     * Un département a plusieurs circonscriptions
     */
    public function circonscriptionFormations()
    {
        return $this->hasMany(CirconscriptionFormation::class, 'departement_formation_id');
    }
}
