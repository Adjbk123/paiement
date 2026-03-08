<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class Formation extends Model
{
    protected $fillable = [
        'district_id',
        'nom'
    ];

    /**
     * Une formation appartient à un district
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
