<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Liste des options
     */
    public function index()
    {
        $options = Option::latest()->get();
        return view('options.index', compact('options'));
    }

    /**
     * Formulaire création
     */
    public function create()
    {
        return view('options.create');
    }

    /**
     * Enregistrement d'une option
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50|unique:options,nom',
            'description' => 'nullable|string',
            'option_montant' => 'required|numeric|min:0',
        ], [
            'nom.required' => 'Le nom de l’option est obligatoire.',
            'nom.unique' => 'Cette option existe déjà.',
            'option_montant.required' => 'Le montant est obligatoire.',
            'option_montant.numeric' => 'Le montant doit être un nombre.',
        ]);

        Option::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'option_montant' => $request->option_montant,
            'statut' => 'visible',
        ]);

        return redirect()->route('employer.gestoptions.options.index')
            ->with('success', 'Option créée avec succès.');
    }

    /**
     * Formulaire édition
     */
    public function edit(Option $option)
    {
        return view('options.edit', compact('option'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'nom' => 'required|string|max:50|unique:options,nom,' . $option->id,
            'description' => 'nullable|string',
            'option_montant' => 'required|numeric|min:0',
        ], [
            'nom.required' => 'Le nom de l’option est obligatoire.',
            'nom.unique' => 'Une autre option porte déjà ce nom.',
            'option_montant.required' => 'Le montant est obligatoire.',
            'option_montant.numeric' => 'Le montant doit être un nombre.',
        ]);

        $option->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'option_montant' => $request->option_montant,
        ]);

        return redirect()->route('employer.gestoptions.options.index')
            ->with('success', 'Option mise à jour avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('employer.gestoptions.options.index')
            ->with('success', 'Option supprimée avec succès.');
    }

    /**
     * Activer / Désactiver via AJAX
     */
    public function toggleStatut(Option $option)
    {
        $option->statut = $option->statut === 'visible' ? 'invisible' : 'visible';
        $option->save();

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès.',
            'statut' => $option->statut
        ]);
    }
}
