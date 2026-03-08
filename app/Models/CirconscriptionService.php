<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DepartementService;

class CirconscriptionService extends Model
{
    protected $fillable = ['nom', 'departement_service_id'];

    /**
     * Une circonscription appartient à un département de service
     */
    public function departementService()
    {
        return $this->belongsTo(DepartementService::class, 'departement_service_id');
    }
}
