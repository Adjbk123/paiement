@extends('layouts.app')

@section('title', 'thank you  for shopping')

@section('content')

<div class="py-3 pyt-md-12 tout">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5">
                @if(session('message'))
                    <h5 class="alert alert-success">{{session('message')}}</h5>
                @endif
                <div class="p-4 shadow bg-white">
                    
                    <h4 class="p-4 text)success">Opération effectué avec Succès </h4>
                    <a href="{{ url('admin/orders')}}" class="btn btn-primary">Généré une facture</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection