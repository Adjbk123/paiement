@extends('layouts.app')

@section('title')
{{$category->meta_title}}
@endsection

@section('meta_keyword')
{{$category->meta_keyword}}
@endsection

@section('meta_descripion')
{{$category->meta_descripion}}
@endsection


@section('content')

    <div class="py-3 py-md-5 tout"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-3">
                        Les Produits
                    </h3>
                    <hr>
                </div>
                    <livewire:frontend.product.index :category="$category"/>
            </div>
        </div>
    </div>
@endsection


















