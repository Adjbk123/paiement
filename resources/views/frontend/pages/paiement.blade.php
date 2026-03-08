@extends('layouts.app')
@section('title', 'Inscription - ' . ($selectedOption ? $selectedOption->nom : 'Formation'))

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Inscription & Paiement',
    'breadcrumbs' => [
        ['label' => 'Inscription', 'url' => null],
    ]
])

<div class="container py-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            {{-- Alerte erreurs --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 mb-4 small border-0 shadow-sm">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Veuillez corriger les erreurs ci-dessous.
                </div>
            @endif

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- En-tête de la card --}}
                <div class="card-header bg-primary text-white p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle"
                             style="width:50px;height:50px;">
                            <i class="fas fa-graduation-cap fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">
                                @if($selectedOption)
                                    {{ $selectedOption->nom }}
                                @else
                                    Inscription à une formation
                                @endif
                            </h5>
                            @if($selectedOption)
                                <small class="opacity-75">Formation sélectionnée</small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">

                    {{-- Récapitulatif du montant si option sélectionnée --}}
                    @if($selectedOption)
                        <div class="p-3 rounded-3 mb-4 border" style="background:#f8f9ff;">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <small class="text-muted d-block">Montant total de la formation</small>
                                    <span class="fw-bold text-dark fs-5">
                                        {{ number_format($selectedOption->option_montant, 0, ',', ' ') }} FCFA
                                    </span>
                                </div>
                                @if($selectedOption->hasMontantMinimum())
                                    <div class="col-6 text-end">
                                        <small class="text-muted d-block">1<sup>er</sup> versement minimum</small>
                                        <span class="fw-bold text-primary fs-5">
                                            {{ number_format($selectedOption->montant_minimum, 0, ',', ' ') }} FCFA
                                        </span>
                                    </div>
                                @else
                                    <div class="col-6 text-end">
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Paiement flexible
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <hr class="my-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1 text-primary"></i>
                                Vous pouvez payer en plusieurs fois. Votre <strong>code de suivi</strong>
                                vous sera remis après le premier versement.
                            </small>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('paiement.process') }}" enctype="multipart/form-data">
                        @csrf
                        @if($selectedOption)
                            <input type="hidden" name="option_id" value="{{ $selectedOption->id }}">
                        @endif

                        {{-- === SECTION 1 : Informations personnelles === --}}
                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                            <i class="fas fa-user me-2 text-primary"></i> Informations personnelles
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted text-uppercase">
                                    Nom <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nom"
                                    class="form-control bg-light border-0 rounded-2 @error('nom') is-invalid @enderror"
                                    value="{{ old('nom') }}" placeholder="Votre nom de famille" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted text-uppercase">
                                    Prénom(s) <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="prenoms"
                                    class="form-control bg-light border-0 rounded-2 @error('prenoms') is-invalid @enderror"
                                    value="{{ old('prenoms') }}" placeholder="Vos prénoms" required>
                                @error('prenoms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted text-uppercase">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email"
                                    class="form-control bg-light border-0 rounded-2 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="votre@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted text-uppercase">
                                    Téléphone <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="phone"
                                    class="form-control bg-light border-0 rounded-2 @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" placeholder="Ex: 0197000000" pattern="(01|02)[0-9]{8}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- === SECTION 2 : Enseignement === --}}
                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                            <i class="fas fa-chalkboard-teacher me-2 text-primary"></i> Niveau d'enseignement
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label small fw-semibold text-muted text-uppercase">
                                    Type d'enseignement <span class="text-danger">*</span>
                                </label>
                                <select name="enseignement_id" id="enseignement_id"
                                    class="form-select bg-light border-0 rounded-2 @error('enseignement_id') is-invalid @enderror">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach ($enseignements as $ens)
                                        <option value="{{ $ens->id }}"
                                            data-slug="{{ strtolower($ens->nom) }}"
                                            {{ old('enseignement_id') == $ens->id ? 'selected' : '' }}>
                                            {{ $ens->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('enseignement_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-none" id="autre_div">
                                <label class="form-label small fw-semibold text-muted text-uppercase">Précisez</label>
                                <input type="text" name="autre_enseignement" id="autre_input"
                                    class="form-control bg-light border-0 rounded-2">
                            </div>
                        </div>

                        {{-- === SECTION 3 : Localisation (conditionnelle) === --}}
                        <div id="section-localisation" class="d-none">
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i> Localisation
                            </h6>
                            <div class="row g-3 mb-4">
                                {{-- Maternelle / Primaire --}}
                                <div class="col-md-6 groupe-departement d-none">
                                    <label class="form-label small fw-semibold text-muted text-uppercase">Département de service</label>
                                    <select name="departement_id" id="departement_id" class="form-select bg-light border-0 rounded-2">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach ($departements as $d)
                                            <option value="{{ $d->id }}">{{ $d->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 groupe-district d-none">
                                    <label class="form-label small fw-semibold text-muted text-uppercase">Circonscription de service</label>
                                    <select name="circonscription_id" id="circonscription_id" class="form-select bg-light border-0 rounded-2">
                                        <option value="">-- Sélectionner --</option>
                                    </select>
                                </div>
                                <div class="col-md-6 groupe-district d-none">
                                    <label class="form-label small fw-semibold text-muted text-uppercase">Département de formation</label>
                                    <select name="district_id" id="district_id" class="form-select bg-light border-0 rounded-2">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach ($districts as $dist)
                                            <option value="{{ $dist->id }}">{{ $dist->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 groupe-district d-none">
                                    <label class="form-label small fw-semibold text-muted text-uppercase">Circonscription de formation</label>
                                    <select name="formation_id" id="formation_id" class="form-select bg-light border-0 rounded-2">
                                        <option value="">-- Sélectionner --</option>
                                    </select>
                                </div>

                                {{-- Secondaire / Autre --}}
                                <div class="col-md-6 groupe-province d-none">
                                    <label class="form-label small fw-semibold text-muted text-uppercase">Département de formation</label>
                                    <select name="province_id" id="province_id" class="form-select bg-light border-0 rounded-2">
                                        <option value="">-- Sélectionner --</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 groupe-province d-none">
                                    <label class="form-label small fw-semibold text-muted text-uppercase">Commune de formation</label>
                                    <select name="region_id" id="region_id" class="form-select bg-light border-0 rounded-2">
                                        <option value="">-- Sélectionner --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- === SECTION 4 : Option (si pas pré-sélectionnée) === --}}
                        @if (!$selectedOption)
                            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                <i class="fas fa-list-alt me-2 text-primary"></i> Option de formation
                            </h6>
                            <div class="mb-4">
                                <label class="form-label small fw-semibold text-muted text-uppercase">
                                    Choisir une formation <span class="text-danger">*</span>
                                </label>
                                <select name="option_id" id="option_select"
                                    class="form-select bg-light border-0 rounded-2 @error('option_id') is-invalid @enderror" required>
                                    <option value="">-- Sélectionner une formation --</option>
                                    @foreach ($options as $opt)
                                        @if ($opt->statut === 'visible')
                                            <option value="{{ $opt->id }}"
                                                data-montant="{{ $opt->option_montant }}"
                                                data-minimum="{{ $opt->montant_minimum ?? 0 }}"
                                                {{ old('option_id') == $opt->id ? 'selected' : '' }}>
                                                {{ $opt->nom }} — {{ number_format($opt->option_montant, 0, ',', ' ') }} FCFA
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('option_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                {{-- Récapitulatif dynamique --}}
                                <div id="recapOption" class="d-none mt-3 p-3 rounded-3 border" style="background:#f8f9ff;">
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted">Montant total</small>
                                            <div class="fw-bold" id="recapMontantTotal">—</div>
                                        </div>
                                        <div class="col-6 text-end" id="recapMinimumWrap">
                                            <small class="text-muted">Minimum 1<sup>er</sup> versement</small>
                                            <div class="fw-bold text-primary" id="recapMinimum">—</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- === SECTION 5 : Montant à payer === --}}
                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                            <i class="fas fa-money-bill-wave me-2 text-primary"></i> Montant à payer maintenant
                        </h6>
                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-muted text-uppercase">
                                Montant (FCFA) <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="montant" id="montant_input"
                                class="form-control bg-light border-0 rounded-2 fw-bold fs-5 @error('montant') is-invalid @enderror"
                                value="{{ old('montant', $selectedOption ? $selectedOption->option_montant : '') }}"
                                min="1" placeholder="Saisir le montant" required>
                            <div class="form-text mt-2" id="montant_aide">
                                <i class="fas fa-info-circle text-primary me-1"></i>
                                Vous pouvez payer la totalité ou une partie.
                                @if($selectedOption && $selectedOption->hasMontantMinimum())
                                    Minimum : <strong>{{ number_format($selectedOption->montant_minimum, 0, ',', ' ') }} FCFA</strong>.
                                @endif
                            </div>
                            @error('montant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- === BOUTON SOUMETTRE === --}}
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm fs-6">
                            <span class="btn-text">
                                <i class="fas fa-credit-card me-2"></i> Valider et payer
                            </span>
                            <span class="btn-loader d-none">
                                <span class="spinner-border spinner-border-sm me-2"></span>
                                Redirection en cours...
                            </span>
                        </button>

                        <p class="text-center text-muted small mt-3 mb-0">
                            <i class="fas fa-lock me-1"></i> Paiement sécurisé via FedaPay
                        </p>

                    </form>
                </div>

            </div>

            {{-- Lien continuer paiement --}}
            <div class="text-center mt-4">
                <p class="text-muted small">
                    Vous avez déjà un code de suivi ?
                    <a href="{{ route('paiement.continuer') }}" class="text-primary fw-semibold">
                        Compléter mon paiement <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ======= Champs conditionnels selon enseignement =======
    const enseignement     = document.getElementById('enseignement_id');
    const departement      = document.getElementById('departement_id');
    const circonscription  = document.getElementById('circonscription_id');
    const district         = document.getElementById('district_id');
    const formation        = document.getElementById('formation_id');
    const province         = document.getElementById('province_id');
    const region           = document.getElementById('region_id');
    const autreDiv         = document.getElementById('autre_div');
    const sectionLoc       = document.getElementById('section-localisation');

    function hideAll() {
        document.querySelectorAll('.groupe-departement, .groupe-district, .groupe-province')
            .forEach(el => el.classList.add('d-none'));
        autreDiv.classList.add('d-none');
        sectionLoc.classList.add('d-none');
    }

    enseignement.addEventListener('change', function () {
        hideAll();
        const slug = this.selectedOptions[0]?.dataset.slug || '';

        if (slug === 'maternel' || slug === 'primaire' || slug === 'maternelle') {
            sectionLoc.classList.remove('d-none');
            document.querySelectorAll('.groupe-departement, .groupe-district')
                .forEach(el => el.classList.remove('d-none'));
        }
        if (slug === 'secondaire') {
            sectionLoc.classList.remove('d-none');
            document.querySelectorAll('.groupe-province')
                .forEach(el => el.classList.remove('d-none'));
        }
        if (slug === 'autre') {
            sectionLoc.classList.remove('d-none');
            document.querySelectorAll('.groupe-province')
                .forEach(el => el.classList.remove('d-none'));
            autreDiv.classList.remove('d-none');
        }
    });

    // ======= AJAX géographique =======
    departement.addEventListener('change', function () {
        circonscription.innerHTML = '<option>Chargement...</option>';
        fetch(`/circonscriptions/by-departement/${this.value}`)
            .then(r => r.json())
            .then(data => {
                circonscription.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(d => circonscription.innerHTML += `<option value="${d.id}">${d.nom}</option>`);
            });
    });
    district.addEventListener('change', function () {
        formation.innerHTML = '<option>Chargement...</option>';
        fetch(`/formations/by-district/${this.value}`)
            .then(r => r.json())
            .then(data => {
                formation.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(f => formation.innerHTML += `<option value="${f.id}">${f.nom}</option>`);
            });
    });
    province.addEventListener('change', function () {
        region.innerHTML = '<option>Chargement...</option>';
        fetch(`/regions/by-province/${this.value}`)
            .then(r => r.json())
            .then(data => {
                region.innerHTML = '<option value="">-- Sélectionner --</option>';
                data.forEach(r => region.innerHTML += `<option value="${r.id}">${r.nom}</option>`);
            });
    });

    // ======= Sélection dynamique option (si pas pré-sélectionnée) =======
    const optionSelect = document.getElementById('option_select');
    if (optionSelect) {
        const recapBox     = document.getElementById('recapOption');
        const recapTotal   = document.getElementById('recapMontantTotal');
        const recapMin     = document.getElementById('recapMinimum');
        const recapMinWrap = document.getElementById('recapMinimumWrap');
        const montantInput = document.getElementById('montant_input');

        optionSelect.addEventListener('change', function () {
            const opt = this.selectedOptions[0];
            const montant  = parseFloat(opt.dataset.montant || 0);
            const minimum  = parseFloat(opt.dataset.minimum || 0);

            if (montant > 0) {
                recapBox.classList.remove('d-none');
                recapTotal.textContent = montant.toLocaleString('fr-FR') + ' FCFA';
                montantInput.value = montant;
                montantInput.max   = montant;

                if (minimum > 0) {
                    recapMin.textContent = minimum.toLocaleString('fr-FR') + ' FCFA';
                    recapMinWrap.classList.remove('d-none');
                    montantInput.min = minimum;
                } else {
                    recapMinWrap.classList.add('d-none');
                    montantInput.min = 1;
                }
            } else {
                recapBox.classList.add('d-none');
            }
        });
    }

    // ======= Spinner sur soumission =======
    document.querySelector('form').addEventListener('submit', function () {
        const btn    = this.querySelector('button[type=submit]');
        const text   = btn.querySelector('.btn-text');
        const loader = btn.querySelector('.btn-loader');
        if (text && loader) {
            text.classList.add('d-none');
            loader.classList.remove('d-none');
        }
    });
});
</script>
@endsection
