@extends('layouts.app')
@section('title','À propos de nous')
@section('content')

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="row g-4 align-items-end mb-4">

            {{-- Image --}}
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid rounded shadow-sm"
                     src="{{ $about->image_path ?? asset('assets/img/about.jpg') }}"
                     alt="Image À propos">
            </div>

            {{-- Contenu --}}
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">

                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3 mb-3">
                    {{ $about->subtitle ?? 'À propos de nous' }}
                </p>

                <h1 class="display-5 mb-4">
                    {{ $about->title ?? 'Nous aidons nos clients à développer leur activité' }}
                </h1>

                <p class="mb-4">
                    {{ $about->description ?? 'Nous accompagnons nos clients avec des solutions innovantes, fiables et adaptées à leurs besoins afin de garantir leur croissance et leur réussite.' }}
                </p>

                {{-- Tabs --}}
                <div class="border rounded p-4">
                    @php
                        $tabs = [];
                        if(!empty($about->tabs)){
                            $tabs = is_array($about->tabs) ? $about->tabs : json_decode($about->tabs, true);
                        }
                        if(empty($tabs) || !is_array($tabs)){
                            $tabs = [
                                'Histoire' => 'Notre entreprise a été créée avec la vision d’apporter des solutions professionnelles et durables.',
                                'Mission' => 'Offrir des services de qualité supérieure qui répondent aux attentes de nos clients.',
                                'Vision' => 'Devenir un leader reconnu dans notre domaine d’activité.'
                            ];
                        }
                    @endphp

                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            @foreach($tabs as $key => $content)
                                <button class="nav-link fw-semi-bold {{ $loop->first ? 'active' : '' }}"
                                        id="nav-{{ Str::slug($key) }}-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#nav-{{ Str::slug($key) }}"
                                        type="button" role="tab"
                                        aria-controls="nav-{{ Str::slug($key) }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ ucfirst($key) }}
                                </button>
                            @endforeach
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        @foreach($tabs as $key => $content)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                 id="nav-{{ Str::slug($key) }}" role="tabpanel"
                                 aria-labelledby="nav-{{ Str::slug($key) }}-tab">
                                <p>{{ $content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Features --}}
        <div class="row g-4 mt-4">
            @php
                $features = [];
                if(!empty($about->features)){
                    $features = is_array($about->features) ? $about->features : json_decode($about->features, true);
                }
                if(empty($features) || !is_array($features)){
                    $features = [
                        [
                            'icon' => 'fa-star',
                            'title' => 'Transparence totale',
                            'description' => 'Aucun coût caché, une politique claire et honnête.'
                        ],
                        [
                            'icon' => 'fa-users',
                            'title' => 'Équipe dédiée',
                            'description' => 'Une équipe professionnelle engagée à votre service.'
                        ],
                        [
                            'icon' => 'fa-phone',
                            'title' => 'Disponible 24h/24 et 7j/7',
                            'description' => 'Un support réactif pour répondre à vos besoins à tout moment.'
                        ]
                    ];
                }
            @endphp

            @foreach($features as $feature)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->index + 1 }}s">
                    <div class="card border-0 shadow-sm h-100 feature-card text-center p-4">
                        <div class="icon mb-3">
                            <div class="btn-lg-square rounded-circle bg-primary d-inline-flex align-items-center justify-content-center transition-icon">
                                <i class="fa {{ $feature['icon'] ?? 'fa-star' }} text-white fs-4"></i>
                            </div>
                        </div>
                        <h5 class="mb-2">{{ $feature['title'] ?? 'Titre de fonctionnalité' }}</h5>
                        <p class="text-muted mb-0">{{ $feature['description'] ?? 'Description de la fonctionnalité' }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

<style>
.feature-card {
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
}
.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.transition-icon {
    transition: transform 0.3s, background-color 0.3s;
}
.feature-card:hover .transition-icon {
    transform: scale(1.2);
    background-color: #ff6600 !important;
}
</style>

@endsection
