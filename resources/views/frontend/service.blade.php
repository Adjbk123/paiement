@extends('layouts.app')
@section('title', 'Nos Services')
@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Nos Services',
    'breadcrumbs' => [
        ['label' => 'Services', 'url' => null],
    ]
])

<!-- Services Modernes Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
            <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Nos Services</p>
            <h1 class="display-5 mb-5">Découvrez Nos Services Professionnels</h1>
        </div>

        <div class="row g-4">

            {{-- Tabs gauche --}}
            <div class="col-lg-4">
                <div class="nav nav-pills d-flex flex-column w-100 h-100 me-4">
                    @foreach($services as $service)
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-3 mb-3 {{ $loop->first ? 'active' : '' }}"
                                data-bs-toggle="pill"
                                data-bs-target="#tab-pane-{{ $service->id }}"
                                type="button">
                            <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i>{{ $service->name }}</h5>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Contenu droite --}}
            <div class="col-lg-8">
                <div class="tab-content w-100">
                    @foreach($services as $service)
                        @php
                            $features = !empty($service->features) ? (is_array($service->features) ? $service->features : json_decode($service->features, true)) : [];
                        @endphp
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-pane-{{ $service->id }}">
                            <div class="service-card-3d shadow-sm rounded wow fadeInUp" data-wow-delay="0.{{ $loop->index + 1 }}s">
                                <div class="row g-0">
                                    {{-- Image --}}
                                    <div class="col-md-6 position-relative service-card-img">
                                        <img src="{{ $service->image_path ?? asset('assets/img/service-default.jpg') }}"
                                             class="w-100 h-100 rounded-start"
                                             style="object-fit: cover;" alt="{{ $service->name }}">
                                    </div>

                                    {{-- Texte --}}
                                    <div class="col-md-6 bg-white rounded-end">
                                        <div class="card-body d-flex flex-column h-100">
                                            <h3 class="card-title text-dark">{{ $service->name }}</h3>
                                            <p class="card-text text-secondary">{!! html_entity_decode($service->description) !!}</p>

                                            {{-- Features --}}
                                            @if($features)
                                                <ul class="list-unstyled mb-3">
                                                    @foreach($features as $i => $feature)
                                                        <li class="mb-2">
                                                            <i class="fa fa-check text-primary me-2"></i>{{ $feature }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            {{-- Read More --}}
                                            @if($service->link)
                                                <a href="{{ $service->link }}" class="btn btn-primary mt-auto" target="_blank">
                                                    En savoir plus <i class="fa fa-arrow-right ms-2"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Services Modernes End -->

{{-- CSS --}}
<style>
.service-card-3d {
    border-radius: 1rem;
    overflow: hidden;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    background-color: #fff; /* Fond clair */
}
.service-card-3d:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
.service-card-img img {
    transition: transform 0.5s ease;
    border-radius: 1rem 0 0 1rem;
}
.service-card-img:hover img {
    transform: scale(1.05);
}
.card-title {
    font-weight: 700;
    font-size: 1.8rem;
}
.card-text {
    margin-bottom: 1rem;
}
.list-unstyled li i {
    color: #0d6efd; /* Bleu primaire */
}
.nav-pills .nav-link {
    background: rgba(13,110,253,0.1);
    color: #0d6efd;
    border-radius: 0.5rem;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}
.nav-pills .nav-link.active, .nav-pills .nav-link:hover {
    background: #0d6efd;
    color: #fff;
}
body {
    background-color: #f8f9fa; /* Fond global clair */
}
</style>

{{-- JS Animations --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>

@endsection
