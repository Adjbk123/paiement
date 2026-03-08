@extends('layouts.app')

@section('title', 'Espace Inscription')

@section('content')

<!-- ================== Carousel ================== -->
<div class="container-fluid p-0 mb-4 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('assets/img/carousel-1.jpg') }}" alt="Bienvenue">
                <div class="carousel-caption d-flex align-items-center h-100">
                    <div class="container text-start">
                        <p class="d-inline-block border border-success rounded text-success fw-semibold py-1 px-3 animated slideInDown">
                            Bienvenue à MAFLYT Sarl
                        </p>
                        <h1 class="display-1 text-primary mb-4 animated slideInDown">
                            Familiarisez-vous avec l'outil informatique
                        </h1>
                        <a href="#inscription" class="btn btn-success py-3 px-5 animated slideInDown">
                            S'inscrire
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('assets/img/carousel-2.jpg') }}" alt="Office">
                <div class="carousel-caption d-flex align-items-center h-100">
                    <div class="container text-start">
                        <p class="d-inline-block border border-success rounded text-success fw-semibold py-1 px-3 animated slideInDown">
                            Bienvenue à MAFLYT Sarl
                        </p>
                        <h1 class="display-1 text-primary mb-4 animated slideInDown">
                            Maîtrisez les notions de base sur Office
                        </h1>
                        <a href="#inscription" class="btn btn-success py-3 px-5 animated slideInDown">
                            S'inscrire
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
</div>
<!-- ================== Carousel End ================== -->

<!-- ================== Galerie Société ================== -->
<div class="container-xxl py-5">
    <div class="container">
        <h2 class="display-5 text-center text-success mb-5">La société {{ $parametres->website_name ?? 'website name' }}</h2>
        <div id="societeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($galeries->where('type', 'societe')->where('statut', 0)->chunk(3) as $chunkIndex => $photoChunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach($photoChunk as $photo)
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm">
                                        @if($photo->image)
                                            <img src="{{ asset($photo->image) }}" alt="Photo de la société">
                                        @endif
                                        @if($photo->title || $photo->description)
                                            <div class="card-body text-center">
                                                @if($photo->title)
                                                    <h5 class="card-title text-success">{{ $photo->title }}</h5>
                                                @endif
                                                @if($photo->description)
                                                    <p class="card-text">{!! $photo->description !!}</p>
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

            <button class="carousel-control-prev" type="button" data-bs-target="#societeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#societeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>

        <!-- ================== Publicités ================== -->
        <h2 class="text-center text-success my-5">Nos publicités</h2>
        <div id="publiciteCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($galeries->where('type', 'publicite')->where('statut', 0)->chunk(3) as $chunkIndex => $photoChunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach($photoChunk as $photo)
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm">
                                        @if($photo->image)
                                            <img src="{{ asset($photo->image) }}" alt="Photo de publicité">
                                        @endif
                                        @if($photo->title || $photo->description)
                                            <div class="card-body text-center">
                                                @if($photo->title)
                                                    <h5 class="card-title">{{ $photo->title }}</h5>
                                                @endif
                                                @if($photo->description)
                                                    <p class="card-text">{!! $photo->description !!}</p>
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

            <button class="carousel-control-prev" type="button" data-bs-target="#publiciteCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#publiciteCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </div>
</div>
<!-- ================== About End ================== -->

<!-- ================== Options/Formations ================== -->
<div class="container-xxl py-2 service">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp mb-5" data-wow-delay="0.1s" style="max-width:600px;">

            <h2 class="display-5 text-primary">Options disponibles</h2>
        </div>

        <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-lg-4">
                <div class="nav nav-pills flex-column gap-3">
                    @foreach($options as $i => $option)
                        <button class="nav-link fw-semibold border p-3 {{ $i === 0 ? 'active' : '' }}"
                                data-bs-toggle="pill"
                                data-bs-target="#option-{{ $option->id }}">
                            <h5>
                                <i class="fa fa-laptop-code text-primary me-2"></i>{{ $option->nom }}
                                @if($option->option_montant)
                                    - {{ number_format($option->option_montant, 0, ',', ' ') }} XOF
                                @endif
                            </h5>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-8">
                <div class="tab-content">
                    @foreach($options as $i => $option)
                        <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="option-{{ $option->id }}">
                            <h3 class="text-primary mb-3">{{ $option->nom }}</h3>
                            <p>{{ $option->description ?? 'Description en cours de mise à jour...' }}</p>

                            @php
                                $features = isset($option->features) ? (is_array($option->features) ? $option->features : json_decode($option->features, true)) : [];
                            @endphp
                            @if(count($features))
                                <ul class="list-unstyled">
                                    @foreach($features as $feature)
                                        <li><i class="fa fa-check text-primary me-2"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <a href="#" class="btn btn-success mt-3">En savoir plus</a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================== Inscription & Paiement ================== -->
<div id="inscription" class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm rounded-4 p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.3s">
                <h2 class="text-center text-primary fw-bold mb-4">Inscription & Paiement</h2>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('paiement.process') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénoms</label>
                            <input type="text" name="prenoms" class="form-control" value="{{ old('prenoms') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Option</label>
                            <select name="option_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($options as $option)
                                    <option value="{{ $option->id }}">{{ $option->nom }} - {{ number_format($option->option_montant,0,',',' ') }} XOF</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Montant (XOF)</label>
                            <input type="number" name="montant" class="form-control fw-bold text-success" value="{{ old('montant') }}" required min="1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Département</label>
                            <select name="departement_id" id="departement_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($departements as $d)
                                    <option value="{{ $d->id }}">{{ $d->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Circonscription</label>
                            <select name="circonscription_id" id="circonscription_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Département de formation</label>
                            <select name="district_id" id="district_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                @foreach($districts as $dist)
                                    <option value="{{ $dist->id }}">{{ $dist->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Circonscription de formation</label>
                            <select name="formation_id" id="formation_id" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                            </select>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-success fw-bold py-2 px-4">
                                💳 S'inscrire et Payer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ================== Back to Top ================== -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>

@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion dynamique des selects
    const departementSelect = document.getElementById('departement_id');
    const circonscriptionSelect = document.getElementById('circonscription_id');
    const districtSelect = document.getElementById('district_id');
    const formationSelect = document.getElementById('formation_id');

    departementSelect.addEventListener('change', function() {
        circonscriptionSelect.innerHTML = '<option>Chargement...</option>';
        fetch(`/circonscriptions/by-departement/${this.value}`)
            .then(res => res.json())
            .then(data => {
                circonscriptionSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(d => circonscriptionSelect.innerHTML += `<option value="${d.id}">${d.nom}</option>`);
            });
    });

    districtSelect.addEventListener('change', function() {
        formationSelect.innerHTML = '<option>Chargement...</option>';
        fetch(`/formations/by-district/${this.value}`)
            .then(res => res.json())
            .then(data => {
                formationSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(f => formationSelect.innerHTML += `<option value="${f.id}">${f.nom}</option>`);
            });
    });

    // ================== Effet tilt sur images ==================
    const cards = document.querySelectorAll('.card img, .carousel-inner img');

    cards.forEach(img => {
        img.addEventListener('mousemove', (e) => {
            const rect = img.getBoundingClientRect();
            const x = e.clientX - rect.left; // position souris X
            const y = e.clientY - rect.top;  // position souris Y

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * 5; // max 5deg
            const rotateY = ((x - centerX) / centerX) * -5;

            img.style.transform = `perspective(600px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
        });

        img.addEventListener('mouseleave', () => {
            img.style.transform = 'perspective(600px) rotateX(0deg) rotateY(0deg) scale(1)';
        });
    });
});
</script>
@endsection

@section('styles')
<style>
/* ================== Tilt + zoom ================== */
.carousel-inner img,
.card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 0.5rem;
    transition: transform 0.2s ease, box-shadow 0.3s ease;
}

/* ================== Cards ================== */
.card {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}

/* ================== Tabs Options ================== */
.nav-pills .nav-link {
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
    color: #198754;
}
.nav-pills .nav-link.active,
.nav-pills .nav-link:hover {
    background-color: #198754;
    color: #fff;
}

/* ================== Back to Top ================== */
.back-to-top {
    position: fixed;
    bottom: 25px;
    right: 25px;
    display: none;
    z-index: 999;
    border-radius: 50%;
    padding: 0.6rem 0.75rem;
}

/* ================== Responsive ================== */
@media (max-width: 768px) {
    .carousel-inner img {
        height: 250px;
    }
}
</style>
@endsection
