<?php

namespace App\Http\Controllers\Admin;
use App\Models\Depense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\pdf;

class depenseControllers extends Controller
{
    public function index()
    {
        $depenses = Depense::select()->distinct()->get();
        
        return view('admin.depense.index',  compact('depenses'));
    }
    public function create()
    {
       
        return view('admin.depense.create' , );
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'semaine' => 'required',
        'salaire' => 'required',
        'eau' => 'required',
        'eletricite' => 'required',
        'communication' => 'required',
        'carburant' => 'required',
        'deplacement' => 'required',
        'sante' => 'required' ,
        'entretien' => 'required',
        'fourniture' => 'required',
        'amotisement' => 'required',
        'eletricite' => 'required',
        'le_20' => 'required',
        'le_15' => 'required',
        'loyer' => 'required',
        'fas' => 'required' ,
        'fospa' => 'required',
        'dnam' => 'required' ,
        'autre' => 'required',
        ]);
        Depense::create($validatedData);
        return redirect('/admin/depense')->with('success', 'Depense ajoutée avec succès.');
       
    }
    public function edit(Depense $depense)
    {
        return view('/admin/depense.edit', compact('depense'));
    }

    public function update(Request $request, Depense $depense)
    {
        $validatedData = $request->validate([
            'semaine' => 'required',
            'salaire' => 'required',
            'eau' => 'required',
            'eletricite' => 'required',
            'communication' => 'required',
            'carburant' => 'required',
            'deplacement' => 'required',
            'sante' => 'required' ,
            'entretien' => 'required',
            'fourniture' => 'required',
            'amotisement' => 'required',
            'eletricite' => 'required',
            'le_20' => 'required',
            'le_15' => 'required',
            'loyer' => 'required',
            'fas' => 'required' ,
            'fospa' => 'required',
            'dnam' => 'required' ,
            'autre' => 'required',
        ]);
        $depense->update($validatedData);
        return redirect('/admin/depense')->with('success', 'depense mise à jour avec
        succès.');
    }
    public function destroy(int $depense_id)
    {
        $depense = Depense::findOrFail($depense_id);
        
        $depense->delete();
        return redirect()->back()->with('message' , 'depense suprimer avec Success');
    }
    public function invoice(){

        $depenses = Depense::latest()->take(12)->get()->reverse();
        return view('admin.depense.invoice',  compact('depenses'));
    }

    public function generateInvoice()
    {
        $depenses = Depense::latest()->take(12)->get()->reverse();
        $data = ['depenses'=> $depenses];
       
        $pdf = pdf::loadView('admin.depense.invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y-H-i-s');
        return $pdf->download('depense-'. '-' .$todayDate. '.pdf');
    }
}



        

