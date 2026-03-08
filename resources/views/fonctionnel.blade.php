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

<!-- ================== Options/Formations ================== -->
<div class="container-xxl py-2 service">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp mb-5" style="max-width:600px;">
            <h2 class="display-5 text-primary">Options disponibles</h2>
        </div>

        <div class="row g-4 wow fadeInUp">
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
            <div class="card shadow-sm rounded-4 p-4 p-sm-5 wow fadeInUp">
                <h2 class="text-center text-primary fw-bold mb-4">Inscription & Paiement</h2>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('paiement.process') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <!-- Nom / Prénoms / Email / Phone -->
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénoms</label>
                            <input type="text" name="prenoms" class="form-control" value="{{ old('prenoms') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>

                        <!-- Option / Montant -->
                        <div class="col-md-6">
                            <label class="form-label">Option</label>
                            <select name="option_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                @foreach($options as $option)
                                    <option value="{{ $option->id }}">{{ $option->nom }} - {{ number_format($option->option_montant,0,',',' ') }} XOF</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Montant (XOF)</label>
                            <input type="number" name="montant" class="form-control fw-bold text-success" value="{{ old('montant') }}" min="1">
                        </div>

                        <!-- Enseignement -->
                        <div class="col-md-6">
                            <label class="form-label">Enseignement</label>
                            <select name="enseignement_id" id="enseignement_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                @foreach($enseignements as $ens)
                                    <option value="{{ $ens->id }}" data-slug="{{ strtolower($ens->nom) }}">{{ $ens->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 d-none" id="autre_div">
                            <label class="form-label">Précisez</label>
                            <input type="text" name="autre_enseignement" id="autre_input" class="form-control">
                        </div>

                        <!-- Maternelle / Primaire -->
                        <div class="col-md-6 groupe-departement d-none">
                            <label class="form-label">Département</label>
                            <select name="departement_id" id="departement_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                @foreach($departements as $d)
                                    <option value="{{ $d->id }}">{{ $d->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 groupe-district d-none">
                            <label class="form-label">Circonscription</label>
                            <select name="circonscription_id" id="circonscription_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                            </select>
                        </div>
                        <div class="col-md-6 groupe-district d-none">
                            <label class="form-label">Département de formation</label>
                            <select name="district_id" id="district_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                @foreach($districts as $dist)
                                    <option value="{{ $dist->id }}">{{ $dist->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 groupe-district d-none">
                            <label class="form-label">Circonscription de formation</label>
                            <select name="formation_id" id="formation_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                            </select>
                        </div>

                        <!-- Secondaire / Autre -->
                        <div class="col-md-6 groupe-province d-none">
                            <label class="form-label">Province de formation</label>
                            <select name="province_id" id="province_id" class="form-select">
                                <option value="">-- Sélectionner --</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 groupe-province d-none">
                            <label class="form-label">Circonscription de formation</label>
                            <select name="region_id" id="region_id" class="form-select">
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

<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>

@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const enseignement = document.getElementById('enseignement_id');
    const departement = document.getElementById('departement_id');
    const circonscription = document.getElementById('circonscription_id');
    const district = document.getElementById('district_id');
    const formation = document.getElementById('formation_id');
    const province = document.getElementById('province_id');
    const region = document.getElementById('region_id');
    const autreInput = document.getElementById('autre_input');
    const autreDiv = document.getElementById('autre_div');

    function hideAll() {
        document.querySelectorAll('.groupe-departement, .groupe-district, .groupe-province').forEach(el => el.classList.add('d-none'));
        autreDiv.classList.add('d-none');
    }

    enseignement.addEventListener('change', function() {
        hideAll();

        const slug = this.selectedOptions[0]?.dataset.slug;

        if(slug === 'maternel' || slug === 'primaire'){
            document.querySelectorAll('.groupe-departement, .groupe-district').forEach(el => el.classList.remove('d-none'));
        }

        if(slug === 'secondaire'){
            document.querySelectorAll('.groupe-province').forEach(el => el.classList.remove('d-none'));
        }

        if(slug === 'autre'){
            document.querySelectorAll('.groupe-province').forEach(el => el.classList.remove('d-none'));
            autreDiv.classList.remove('d-none');
        }
    });

    // ================= AJAX =================
    departement.addEventListener('change', function() {
        circonscription.innerHTML = '<option>Chargement...</option>';
        fetch(`/circonscriptions/by-departement/${this.value}`)
            .then(res => res.json())
            .then(data => {
                circonscription.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(d => circonscription.innerHTML += `<option value="${d.id}">${d.nom}</option>`);
            });
    });

    district.addEventListener('change', function() {
        formation.innerHTML = '<option>Chargement...</option>';
        fetch(`/formations/by-district/${this.value}`)
            .then(res => res.json())
            .then(data => {
                formation.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(f => formation.innerHTML += `<option value="${f.id}">${f.nom}</option>`);
            });
    });

    province.addEventListener('change', function() {
        region.innerHTML = '<option>Chargement...</option>';
        fetch(`/regions/by-province/${this.value}`)
            .then(res => res.json())
            .then(data => {
                region.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(r => region.innerHTML += `<option value="${r.id}">${r.nom}</option>`);
            });
    });

});
</script>
@endsection
