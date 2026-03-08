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
        'montant_minimum',
        'statut',
    ];

    protected $casts = [
        'option_montant'   => 'float',
        'montant_minimum'  => 'float',
    ];

    /**
     * Retourne le montant minimum du 1er versement.
     * Si non défini, retourne 0 (aucun minimum = montant libre).
     */
    public function getMontantMinimumEffectif(): float
    {
        return $this->montant_minimum ?? 0;
    }

    /**
     * Indique si un montant minimum de premier versement est défini.
     */
    public function hasMontantMinimum(): bool
    {
        return !is_null($this->montant_minimum) && $this->montant_minimum > 0;
    }

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
