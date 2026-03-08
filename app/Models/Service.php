<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image_path', 'features', 'link'
    ];

    protected $casts = [
        'features' => 'array', // pour manipuler directement comme tableau
    ];
}
