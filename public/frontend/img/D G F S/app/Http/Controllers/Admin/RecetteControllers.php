<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recette;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\pdf;

class RecetteControllers extends Controller
{
    public function index()
    {
        $recettes = Recette::all();
        return view('admin.recette.index',  compact('recettes'));
    }
    public function create()
    {
       
        return view('admin.recette.create' , );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'semaine' => 'required',
        'dime' => 'required',
        'offrande' => 'required',
        'offrande_m' => 'required',
        'offrande_j' => 'required',
        'offrande_special' => 'required',
        'edl' => 'required' ,
        'action_grace' => 'required' ,
        'dnam' => 'required' ,
        'autre' => 'required',
        ]);

        Recette::create($validatedData);
        return redirect('/admin/recette')->with('success', 'Depense ajoutée avec succès.');
       
    }
    public function edit(Recette $recette)
    {
        return view('/admin/recette.edit', compact('recette'));
    }

    public function update(Request $request, Recette $recette)
    {
        $validatedData = $request->validate([
            'semaine' => 'required',
        'dime' => 'required',
        'offrande' => 'required',
        
        'offrande_m' => 'required',
        'offrande_j' => 'required',
        'offrande_special' => 'required',
        'edl' => 'required' ,
        'action_grace' => 'required' ,
        'dnam' => 'required' ,
        'autre' => 'required',
        ]);
        $recette->update($validatedData);
        return redirect('/admin/recette')->with('success', 'Recette mise à jour avec
        succès.');
    }
    


    public function destroy(int $recette_id)
    {
        $recette = Recette::findOrFail($recette_id);
        
        $recette->delete();
        return redirect()->back()->with('message' , 'recette suprimer avec Success');
    }

    public function invoice(){

        $recettes = Recette::latest()->take(5)->get()->reverse();
        return view('admin.recette.invoice',  compact('recettes'));
    }

    public function generateInvoice()
    {
        $recettes = Recette::latest()->take(5)->get()->reverse();
        $data = ['recettes'=> $recettes];
        $pdf = pdf::loadView('admin.recette.invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y-H-i-s');
        return $pdf->setPaper('A4', 'landscape')->download('recette-'. '-' .$todayDate. '.pdf');
    }

    
}
