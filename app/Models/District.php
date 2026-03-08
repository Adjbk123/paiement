<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;

class District extends Model
{
    protected $fillable = [
        'nom'
    ];

    /**
     * Un district possède plusieurs formations
     */
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
}
