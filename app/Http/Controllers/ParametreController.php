<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index()
    {
        $parametres = Parametre::first();
        return view('parametres.index', compact('parametres'));
    }

    public function store(Request $request)
    {
        $parametres = Parametre::first();

        // Suppression de l'ancienne photo si demandé
        if ($request->has('delete_photo') && $parametres && $parametres->photo) {
            $oldPhotoPath = public_path('uploads/' . $parametres->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
            $parametres->photo = null;
        }

        // Upload d'une nouvelle photo
        $photoName = $parametres ? $parametres->photo : null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // Supprimer l'ancien fichier si existant
            if ($photoName) {
                $oldPhotoPath = public_path('uploads/' . $photoName);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Enregistrement dans public/uploads
            $photoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $photoName);
        }

        // Préparer les données
        $data = [
            'website_name'     => $request->website_name,
            'website_url'      => $request->website_url,
            'meta_description' => $request->meta_description, // gardé

            'address' => $request->address,
            'phone1'  => $request->phone1,
            'phone2'  => $request->phone2,
            'email1'  => $request->email1,
            'email2'  => $request->email2,

            'facebook' => $request->facebook,
            'twitter'  => $request->twitter,
            'whatsapp' => $request->whatsapp, // remplacé
            'youtube'  => $request->youtube,

            'photo' => $photoName,
        ];

        // Création ou mise à jour
        if ($parametres) {
            $parametres->update($data);
            return redirect()->back()->with('success', 'Paramètre modifié avec succès');
        } else {
            Parametre::create($data);
            return redirect()->back()->with('success', 'Paramètre créé avec succès');
        }
    }
}
