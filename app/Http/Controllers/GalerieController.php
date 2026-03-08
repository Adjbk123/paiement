<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use Illuminate\Http\Request;
//use Illuminate\Support\Str;

class GalerieController extends Controller
{
    // Liste toutes les galeries
    public function index()
    {
        $galeries = Galerie::latest()->paginate(10);

        return view('galeries.index', compact('galeries'));
    }

    // Formulaire de création
    public function create()
    {
        return view('galeries.create');
    }

    // Stocker une nouvelle galerie
    public function store(Request $request)
    {
        $data = $this->validateGalerie($request);

        $data['statut'] = $request->has('statut') ? 0 : 1; // 0 = Visible, 1 = Invisible

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadPhoto($request->image, 'uploads/galeries');
        }

        Galerie::create($data);

        return redirect()->route('employer.gestgaleries.galeries.index')
                         ->with('message', 'Galerie créée avec succès !');
    }

    // Formulaire d'édition
    public function edit(Galerie $galerie)
    {
        return view('galeries.edit', compact('galerie'));
    }

    // Mettre à jour une galerie
    public function update(Request $request, Galerie $galerie)
    {
        $data = $this->validateGalerie($request);

        $data['statut'] = $request->has('statut') ? 0 : 1;

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($galerie->image && file_exists(public_path($galerie->image))) {
                unlink(public_path($galerie->image));
            }
            $data['image'] = $this->uploadPhoto($request->image, 'uploads/galeries');
        }

        $galerie->update($data);

        return redirect()->route('employer.gestgaleries.galeries.index')
                         ->with('message','Galerie mise à jour avec succès !');
    }

    // Supprimer une galerie
    public function destroy(Galerie $galerie)
    {
        if ($galerie->image && file_exists(public_path($galerie->image))) {
            unlink(public_path($galerie->image));
        }

        $galerie->delete();

        return redirect()->route('employer.gestgaleries.galeries.index')
                         ->with('message','Galerie supprimée avec succès !');
    }

    // Toggle du statut Visible / Invisible
    public function toggleStatut(Galerie $galerie)
    {
        $galerie->statut = $galerie->statut == 0 ? 1 : 0;
        $galerie->save();

        $label = $galerie->statut == 0 ? 'Visible' : 'Invisible';

        return response()->json([
            'success' => true,
            'label'   => $label
        ]);
    }

   private function validateGalerie(Request $request)
{
    return $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'type' => 'required|in:societe,publicite',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    ], [
        'image.max' => 'La taille de l’image ne doit pas dépasser 5 Mo.',
        'image.image' => 'Le fichier doit être une image valide.',
        'image.mimes' => 'Formats autorisés : jpg, jpeg, png, webp.',
    ]);
}

    // Upload d'une image et retour du chemin
    private function uploadPhoto($file, $path)
    {
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path($path), $filename);
        return $path.'/'.$filename;
    }
}
