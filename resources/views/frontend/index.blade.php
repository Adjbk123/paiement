@extends('layouts.app')
@section('title', 'Accueil')

@section('content')

    <!-- ================= CAROUSEL ================= -->
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('frontend/img/car5.jpeg') }}" alt="Formation Informatique"
                    style="height: 100vh; object-fit: cover;">
                <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 text-start">
                                <h4 class="text-white text-uppercase fw-bold mb-3 animated slideInDown">
                                    <span class="bg-primary px-3 py-2 rounded-1 shadow-sm"
                                        style="letter-spacing: 3px;">Bienvenue chez MAFLYT</span>
                                </h4>
                                <h1 class="display-1 text-white mb-4 animated slideInDown fw-black">
                                    Formation en <span class="text-primary">Informatique</span> pour Tous
                                </h1>
                                <p class="fs-5 mb-5 animated slideInDown text-white">
                                    <span class="bg-black bg-opacity-25 px-3 py-2 rounded-2 d-inline-block">
                                        Enseignants du maternel, du primaire et du secondaire, élèves, étudiants
                                        ainsi que toute personne désireuse d'apprendre l'informatique, développez
                                        vos compétences numériques grâce à nos formations adaptées.
                                    </span>
                                </p>
                                <div class="d-grid gap-3 d-sm-flex align-items-center animated slideInDown pb-5 pb-lg-0">
                                    <a href="#options" class="btn btn-primary rounded-pill py-3 px-5 shadow-lg">
                                        Explorer les Programmes
                                    </a>
                                    <a href="{{ route('frontend.paiement') }}"
                                        class="btn btn-outline-light rounded-pill py-3 px-5">
                                        Je m'inscris
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('frontend/img/caro2.jpeg') }}" alt="Formation Numérique"
                    style="height: 100vh; object-fit: cover;">
                <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-8">
                                <h4 class="text-white text-uppercase fw-bold mb-3 animated zoomIn">
                                    <span class="bg-primary px-3 py-2 rounded-1 shadow-sm"
                                        style="letter-spacing: 3px;">Inscriptions Ouvertes</span>
                                </h4>
                                <h1 class="display-1 text-white mb-4 animated zoomIn fw-black">
                                    Maîtrisez les <span class="text-primary">Outils Numériques</span>
                                </h1>
                                <p class="fs-5 mb-5 animated zoomIn text-white">
                                    <span class="bg-black bg-opacity-25 px-3 py-2 rounded-2 d-inline-block">
                                        Apprenez l'informatique pratique : bureautique, internet,
                                        outils pédagogiques numériques et compétences digitales essentielles.
                                    </span>
                                </p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-center animated zoomIn pb-5 pb-lg-0">
                                    <a href="{{ route('frontend.paiement') }}"
                                        class="btn btn-primary rounded-pill py-3 px-5 shadow-lg">
                                        Je m'inscris à la Formation
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <div class="control-btn shadow">
                <span class="carousel-control-prev-icon"></span>
            </div>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <div class="control-btn shadow">
                <span class="carousel-control-next-icon"></span>
            </div>
        </button>
    </div>

    <!-- ===== Section Avantages ===== -->
    <div class="container-fluid py-5 bg-light wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center mb-5">
                <p class="d-inline-block border rounded text-primary fw-bold py-1 px-3 mb-2">Pourquoi nous choisir</p>
                <h2 class="fw-bold">Nos <span class="text-primary">Engagements</span></h2>
            </div>
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-white rounded-4 p-4 h-100 shadow-sm">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle mb-3"
                             style="width:60px;height:60px;">
                            <i class="fas fa-laptop text-white fs-4"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Formation Pratique</h6>
                        <small class="text-muted">Apprentissage sur ordinateur avec exercices concrets</small>
                    </div>
                </div>
                <div class="col-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="bg-white rounded-4 p-4 h-100 shadow-sm">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle mb-3"
                             style="width:60px;height:60px;">
                            <i class="fas fa-user-tie text-white fs-4"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Formateurs Qualifiés</h6>
                        <small class="text-muted">Une équipe d'experts passionnés à votre service</small>
                    </div>
                </div>
                <div class="col-6 col-md-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-white rounded-4 p-4 h-100 shadow-sm">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle mb-3"
                             style="width:60px;height:60px;">
                            <i class="fas fa-certificate text-white fs-4"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Attestation Délivrée</h6>
                        <small class="text-muted">Certification reconnue à l'issue de chaque formation</small>
                    </div>
                </div>
                <div class="col-6 col-md-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="bg-white rounded-4 p-4 h-100 shadow-sm">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle mb-3"
                             style="width:60px;height:60px;">
                            <i class="fas fa-hand-holding-usd text-white fs-4"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Tarifs Accessibles</h6>
                        <small class="text-muted">Des formations adaptées à tous les profils et budgets</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== Fin Section Avantages ===== -->

    <!-- ================= Section : La Société ================= -->
    <div class="container-fluid py-5 bg-white">
        <div class="container">

            {{-- En-tête de section --}}
            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded text-primary fw-bold py-1 px-3 mb-2">
                    <i class="fas fa-building me-2"></i> Qui sommes-nous
                </p>
                <h2 class="fw-bold">
                    La société <span class="text-primary">{{ $parametres->website_name ?? 'MAFLYT SARL' }}</span>
                </h2>
                <div class="mx-auto bg-primary rounded-pill mt-3" style="width:60px;height:4px;"></div>
            </div>

            @php $societePhotos = $galeries->where('type', 'societe')->where('statut', 0); @endphp

            @if($societePhotos->count() > 0)
                <div id="societeCarousel" class="carousel slide gallery-carousel position-relative px-5" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($societePhotos->chunk(3) as $chunkIndex => $photoChunk)
                            <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                <div class="row g-4 justify-content-center">
                                    @foreach ($photoChunk as $photo)
                                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.{{ $loop->index + 1 }}s">
                                            <div class="gallery-card rounded-4 overflow-hidden shadow-sm border-0 h-100">
                                                @if ($photo->image)
                                                    <div class="gallery-img-wrap" style="height:240px;overflow:hidden;">
                                                        <img src="{{ asset($photo->image) }}"
                                                             class="w-100 h-100"
                                                             style="object-fit:cover;transition:transform .4s ease;"
                                                             alt="{{ $photo->title ?? 'Photo société' }}">
                                                    </div>
                                                @endif
                                                @if ($photo->title || $photo->description)
                                                    <div class="p-3 bg-white text-center">
                                                        @if ($photo->title)
                                                            <h6 class="fw-bold text-dark mb-1">{{ $photo->title }}</h6>
                                                        @endif
                                                        @if ($photo->description)
                                                            <p class="text-muted small mb-0">{!! $photo->description !!}</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Boutons navigation stylisés --}}
                    <button class="gallery-nav gallery-nav-prev" type="button"
                            data-bs-target="#societeCarousel" data-bs-slide="prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="gallery-nav gallery-nav-next" type="button"
                            data-bs-target="#societeCarousel" data-bs-slide="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            @endif

        </div>
    </div>
    <!-- ================= Fin Section Société ================= -->

    <!-- ================= Section : Publicités ================= -->
    <div class="container-fluid py-5" style="background-color:#f8f9ff;">
        <div class="container">

            {{-- En-tête de section --}}
            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded text-primary fw-bold py-1 px-3 mb-2">
                    <i class="fas fa-bullhorn me-2"></i> À la une
                </p>
                <h2 class="fw-bold">Nos <span class="text-primary">Publicités</span></h2>
                <div class="mx-auto bg-primary rounded-pill mt-3" style="width:60px;height:4px;"></div>
            </div>

            @php $pubPhotos = $galeries->where('type', 'publicite')->where('statut', 0); @endphp

            @if($pubPhotos->count() > 0)
                <div id="publiciteCarousel" class="carousel slide gallery-carousel position-relative px-5" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($pubPhotos->chunk(3) as $chunkIndex => $photoChunk)
                            <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                <div class="row g-4 justify-content-center">
                                    @foreach ($photoChunk as $photo)
                                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.{{ $loop->index + 1 }}s">
                                            <div class="gallery-card rounded-4 overflow-hidden shadow-sm border-0 h-100">
                                                @if ($photo->image)
                                                    <div class="gallery-img-wrap" style="height:240px;overflow:hidden;">
                                                        <img src="{{ asset($photo->image) }}"
                                                             class="w-100 h-100"
                                                             style="object-fit:cover;transition:transform .4s ease;"
                                                             alt="{{ $photo->title ?? 'Publicité' }}">
                                                    </div>
                                                @endif
                                                @if ($photo->title || $photo->description)
                                                    <div class="p-3 bg-white text-center">
                                                        @if ($photo->title)
                                                            <h6 class="fw-bold text-dark mb-1">{{ $photo->title }}</h6>
                                                        @endif
                                                        @if ($photo->description)
                                                            <p class="text-muted small mb-0">{!! $photo->description !!}</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="gallery-nav gallery-nav-prev" type="button"
                            data-bs-target="#publiciteCarousel" data-bs-slide="prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="gallery-nav gallery-nav-next" type="button"
                            data-bs-target="#publiciteCarousel" data-bs-slide="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            @endif

        </div>
    </div>
    <!-- ================= Fin Section Publicités ================= -->

    <!-- ================= Section : Formations ================= -->
    <div id="options" class="container-fluid py-5 bg-white">
        <div class="container">

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width:620px;">
                <p class="d-inline-block border rounded text-primary fw-bold py-1 px-3 mb-2">
                    <i class="fas fa-graduation-cap me-2"></i> Nos programmes
                </p>
                <h2 class="fw-bold text-dark">
                    Nos <span class="text-primary">Formations</span>
                </h2>
                <p class="text-muted mt-2 mb-0">
                    Découvrez les différentes formations en informatique adaptées aux enseignants, élèves,
                    étudiants et à toute personne souhaitant développer ses compétences numériques.
                </p>
                <div class="mx-auto bg-primary rounded-pill mt-3" style="width:60px;height:4px;"></div>
            </div>

            <div class="row g-4">
                @forelse($options as $option)
                    @if ($option->statut === 'visible')
                        <div class="col-12 col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay="0.{{ $loop->index % 3 + 1 }}s">
                            <div class="formation-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">

                                {{-- Bande couleur top --}}
                                <div class="bg-primary" style="height:6px;"></div>

                                <div class="p-4 d-flex flex-column h-100">

                                    {{-- Icône + Titre --}}
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="formation-icon d-flex align-items-center justify-content-center bg-primary rounded-3 flex-shrink-0"
                                             style="width:48px;height:48px;">
                                            <i class="fas fa-laptop-code text-white fs-5"></i>
                                        </div>
                                        <h5 class="mb-0 fw-bold text-dark lh-sm">{{ $option->nom }}</h5>
                                    </div>

                                    {{-- Description --}}
                                    <div class="flex-grow-1 mb-3">
                                        <p class="small text-secondary mb-0 list-check">
                                            {!! html_entity_decode($option->description) !!}
                                        </p>
                                    </div>

                                    {{-- Prix --}}
                                    <div class="d-flex align-items-center justify-content-between py-3 border-top border-bottom border-light mb-3">
                                        <span class="small text-muted fw-semibold text-uppercase" style="letter-spacing:.5px;">
                                            <i class="fas fa-tag me-1 text-primary"></i> Frais de formation
                                        </span>
                                        <span class="fw-bold text-primary fs-5">
                                            {{ number_format($option->option_montant, 0, ',', ' ') }}
                                            <small class="fs-6 fw-normal text-muted">FCFA</small>
                                        </span>
                                    </div>

                                    {{-- CTA --}}
                                    <a href="{{ route('frontend.paiement', ['option' => $option->id]) }}"
                                       class="btn btn-primary rounded-pill py-2 w-100 fw-bold shadow-sm formation-btn">
                                        Je m'inscris <i class="fas fa-arrow-right ms-2 small"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12 text-center py-5 wow fadeIn">
                        <div class="bg-light p-5 rounded-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Aucune formation disponible pour le moment</h5>
                            <p class="text-muted mb-0 small">Revenez bientôt pour découvrir nos nouvelles offres.</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
    <!-- ================= Fin Section Formations ================= -->

    <!-- ================= Section : Continuer paiement ================= -->
    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);">
        <div class="container">
            <div class="row align-items-center g-4 justify-content-between">

                <!-- Texte gauche -->
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <p class="d-inline-block border border-white border-opacity-50 text-white fw-bold py-1 px-3 mb-3 rounded-pill" style="font-size:.85rem;letter-spacing:1px;">
                        <i class="fas fa-key me-2"></i> Déjà inscrit ?
                    </p>
                    <h2 class="text-white fw-bold mb-3">
                        Vous avez un <span style="color:#93c5fd;">code de suivi</span> ?
                    </h2>
                    <p class="text-white mb-0" style="opacity:.85;">
                        Retrouvez votre dossier en quelques secondes et complétez votre paiement par tranche,
                        à votre rythme. Aucune connexion requise.
                    </p>
                </div>

                <!-- Formulaire rapide droite -->
                <div class="col-lg-5 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="card border-0 rounded-4 shadow-lg p-4">
                        <h6 class="fw-bold text-dark mb-1">
                            <i class="fas fa-folder-open text-primary me-2"></i> Accéder à mon dossier
                        </h6>
                        <p class="text-muted small mb-3">Saisissez votre code reçu après le premier versement</p>

                        <form method="POST" action="{{ route('paiement.continuer.recherche') }}">
                            @csrf
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-light border-0 text-primary">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="text" name="token"
                                       class="form-control border-0 bg-light fw-bold text-center"
                                       placeholder="MAF-2025-XXXXX"
                                       style="letter-spacing:2px;font-size:1rem;"
                                       autocomplete="off" required>
                                <button type="submit" class="btn btn-primary fw-bold px-4">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                            <p class="text-muted text-center mt-2 mb-0" style="font-size:.78rem;">
                                <i class="fas fa-lock me-1"></i> Accès sécurisé — aucun mot de passe requis
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ================= Fin Section Continuer paiement ================= -->

@endsection

<style>
    /* ===== Carousel Hero ===== */
    @media (max-width: 768px) {
        #header-carousel .carousel-item,
        #header-carousel img { height: 70vh !important; }
        #header-carousel h1  { font-size: 2.2rem !important; line-height: 1.2; }
        #header-carousel p   { font-size: 1rem !important; margin-bottom: 2rem !important; }
        #header-carousel .btn { padding: 12px 25px !important; font-size: .9rem !important; }
    }
    @media (max-width: 576px) {
        #header-carousel h1 { font-size: 1.8rem !important; }
        .carousel-caption   { padding-bottom: 80px; }
    }

    /* ===== Galerie : boutons navigation ===== */
    .gallery-carousel { padding-bottom: 10px; }

    .gallery-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid var(--primary);
        background: #fff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .9rem;
        transition: all .3s ease;
        cursor: pointer;
    }
    .gallery-nav:hover {
        background: var(--primary);
        color: #fff;
    }
    .gallery-nav-prev { left: 0; }
    .gallery-nav-next { right: 0; }

    /* ===== Galerie : cards ===== */
    .gallery-card {
        transition: transform .35s ease, box-shadow .35s ease;
        border: 1px solid rgba(0,0,0,.06) !important;
    }
    .gallery-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,.1) !important;
    }
    .gallery-card:hover .gallery-img-wrap img {
        transform: scale(1.06);
    }

    /* ===== Cards Formation ===== */
    .formation-card {
        border: 1px solid rgba(0,0,0,.06) !important;
        transition: transform .4s cubic-bezier(.165,.84,.44,1), box-shadow .4s ease;
    }
    .formation-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 45px rgba(0,0,0,.12) !important;
    }
    .formation-card .formation-icon {
        transition: transform .3s ease, background-color .3s ease;
    }
    .formation-card:hover .formation-icon {
        transform: rotate(8deg) scale(1.1);
        background-color: var(--dark) !important;
    }
    .formation-card .formation-btn {
        transition: all .3s ease;
    }
    .formation-card:hover .formation-btn {
        background-color: var(--dark) !important;
        border-color: var(--dark) !important;
    }

    /* Listes dans les descriptions de formation */
    .list-check ul, .list-check ol {
        padding-left: 0;
        list-style: none;
        margin-bottom: 0;
    }
    .list-check li {
        position: relative;
        padding-left: 1.4rem;
        margin-bottom: .4rem;
        line-height: 1.5;
    }
    .list-check li::before {
        content: "\f00c";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        color: var(--primary);
        font-size: .75rem;
        top: 3px;
    }

    .bg-primary-subtle {
        background-color: rgba(71, 97, 255, .1) !important;
    }
</style>
