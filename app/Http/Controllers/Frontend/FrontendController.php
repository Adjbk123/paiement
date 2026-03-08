<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Galerie;
use App\Models\Option;
use App\Models\Parametre;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Page d'accueil
     */
    public function index()
    {
        $parametres = Parametre::first();
        $options = Option::where('statut', 'visible')->get();
         $galeries = Galerie::where('statut', 'visible')->get();

        return view('frontend.index', [
            'parametres' => $parametres,
            'options' => $options,
             'galeries' => $galeries
        ]);
    }
    /**
     * Page About (si tu veux une page dédiée)
     */
    public function about()
    {
        $about = About::latest()->first();

        return view('frontend.about', compact('about'));
    }

    public function services()
    {
        // Récupérer tous les services
        $services = Service::all();
        return view('frontend.service', compact('services'));
    }
}
