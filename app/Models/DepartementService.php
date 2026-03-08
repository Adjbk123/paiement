<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CirconscriptionService;

class DepartementService extends Model
{
    protected $fillable = ['nom'];

    /**
     * Un département a plusieurs circonscriptions
     */
    public function circonscriptionServices()
    {
        return $this->hasMany(CirconscriptionService::class, 'departement_service_id');
    }
}
