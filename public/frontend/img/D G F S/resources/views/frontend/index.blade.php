@extends('layouts.app')

@section('title', 'home page')

@section('content')
<div class="container-fluid px-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="frontend/img/car5.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7 text-start">
                                    <p class="fs-4 text-primary h6 animated slideInRight">Bienvenu à    <strong>D G F S</strong></p>
                                    <h3 class="display-5 text-white mb-4 animated slideInRight">Familiariser Vous Avec l'Outils Informatique.</h3>
                                    <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInRight">En Savoir Plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="frontend/img/caro2.jpeg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-lg-7 text-end">
                                    <p class="fs-4 text-primary animated slideInLeft">Bienvenu à  <strong>D G F S</strong></p>
                                    <h1 class="display-1 text-white mb-5 animated slideInLeft">Maitrisez les Notions de Base sur Office.</h1>
                                    <a href="service.html" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">En Savoir Plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection
