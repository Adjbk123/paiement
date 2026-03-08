<?php

namespace App\Models;

use App\Models\DepartementService;
use Illuminate\Database\Eloquent\Model;

class CommuneService extends Model
{
    protected $fillable = ['nom', 'departement_id'];

    public function departement_service()
    {
        return $this->belongsTo(DepartementService::class);
    }
}
