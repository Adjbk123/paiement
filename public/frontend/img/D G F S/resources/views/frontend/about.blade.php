@extends('layouts.app')

@section('title', 'About')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-heade mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">A-propos</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="{{url('/')}}">Acueil</a></li>
                <li class="breadcrumb-item"><a class="text-body" href="{{url('/')}}">Categories</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="#">A-propos</li>
            </ol>
        </nav>
    </div>
</div>
    <!-- Page Header End -->

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            
            <div class="col-lg-6 wow fadeIn mx-auto" data-wow-delay="0.5s">
                <h1 class="display-5 mb-4">Chargements en cours......</h1>
                
                
            </div>
        </div>
    </div>
</div>
<!-- About End -->
    <!-- Blog End -->

    @endsection

