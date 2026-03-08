<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';

    protected $fillable = [
        'nom',
        'description',
        'option_montant',
        'statut',
    ];

    protected $casts = [
        'option_montant' => 'float',
    ];

    // Vérifie si l’option est visible
    public function estVisible(): bool
    {
        return $this->statut === 'visible';
    }

    // Scope pour options visibles
    public function scopeVisible($query)
    {
        return $query->where('statut', 'visible');
    }
}
