<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\pdf;

class SyntheseContrllers extends Controller
{

    public function index()
    {
        
        return view('admin.sythese.index');
    }

    public function invoice(){

       
        return view('admin.sythese.invoice');
    }

    public function generateInvoice()
    {
        
       
        $pdf = pdf::loadView('admin.sythese.invoice');
        $todayDate = Carbon::now()->format('d-m-Y-H-i-s');
        return $pdf->download('synthese-'. '-' .$todayDate. '.pdf');
    }
}
