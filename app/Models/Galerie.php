<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    use HasFactory;

    protected $table = 'galeries';

    protected $fillable = [
        'title',
        'description',
        'type',
        'image',
        'statut',
    ];

    /**
     * Vérifie si la galerie est visible.
     */
    public function isVisible(): bool
    {
        return $this->statut === 0;
    }

    /**
     * Vérifie si la galerie est invisible.
     */
    public function isInvisible(): bool
    {
        return $this->statut === 1;
    }
}
