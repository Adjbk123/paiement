<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'image_path',
        'tabs',
        'features',
       
    ];

    protected $casts = [
        'tabs' => 'array',
        'features' => 'array',
    ];
}
