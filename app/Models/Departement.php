<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Circonscription;

class Departement extends Model
{
    protected $fillable = [
        'nom'
    ];

    public function circonscriptions()
    {
        return $this->hasMany(Circonscription::class);
    }
}
