@extends('layouts.admin')

@section('content')
<div class="card m-3 shadow">
        <div class="card-header">
            <h3>ETAT SIMPLIFIE DES RECETTES 
                <a href="#" class="btn btn-primary btn-sm float-end m-1 ">AJOUTER</a>
                <a href="{{ url('admin/synthese/generateInvoice')}}" class="btn btn-success btn-sm float-end m-1">TELECHARGER</a>
                <a href="{{ url('admin/synthese/invoice')}}" class="btn btn-warning btn-sm float-end m-1 h6">VOIR LE RAPPORT</a>
            </h3>
        </div>
        <div class="card-body">
            
            
        </div>
    </div>
@endsection

