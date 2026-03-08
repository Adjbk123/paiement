@extends('layouts.app')
@section('title', 'Candidature - ' . ($selectedOption ? $selectedOption->nom : 'Recrutement'))

@section('content')
    <div class="container py-5 mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        {{-- Colonne Information --}}


                        {{-- Colonne Formulaire --}}
                        <div class="col-lg-12 p-4 p-md-5 bg-white">
                            @if ($selectedOption)
                                <div
                                    class="bg-primary-subtle p-3 rounded-3 mb-4 d-flex align-items-center border border-primary-subtle">
                                    <div class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="fas fa-briefcase text-white small"></i>
                                    </div>
                                    <div>
                                        <small class="text-primary text-uppercase fw-bold smallest"
                                            style="letter-spacing: 1px;">Vous postulez pour :</small>
                                        <h5 class="mb-0 fw-black text-dark">{{ $selectedOption->nom }}</h5>
                                    </div>
                                </div>
                            @endif

                            {{-- Affichage des erreurs globales --}}
                            @if ($errors->any())
                                <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4 small">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Veuillez corriger les erreurs dans le
                                    formulaire.
                                </div>
                            @endif

                            <form method="POST" action="{{ route('paiement.process') }}" enctype="multipart/form-data">
                                @csrf

                                @if ($selectedOption)
                                    <input type="hidden" name="option_id" value="{{ $selectedOption->id }}">
                                @endif

                                <div class="row g-3">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Informations Personnelles</h6>

                                    <div class="col-md-12">
                                        <label class="form-label smallest fw-bold text-muted text-uppercase">Nom
                                            Complet</label>
                                        <input type="text" name="nom"
                                            class="form-control bg-light border-0 py-2 rounded-2 @error('nom') is-invalid @enderror"
                                            value="{{ old('nom') }}" required>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label smallest fw-bold text-muted text-uppercase">Prénom(s)
                                        </label>
                                        <input type="text" name="prenoms"
                                            class="form-control bg-light border-0 py-2 rounded-2 @error('prenoms') is-invalid @enderror"
                                            value="{{ old('prenoms') }}" required>
                                        @error('prenoms')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label smallest fw-bold text-muted text-uppercase">Email
                                            fonctionnel</label>
                                        <input type="email" name="email"
                                            class="form-control bg-light border-0 py-2 rounded-2 @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label
                                            class="form-label smallest fw-bold text-muted text-uppercase">Téléphone</label>
                                        <input type="text" name="phone"
                                            class="form-control bg-light border-0 py-2 rounded-2 @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="">
                                        <label class="form-label">Enseignement</label>
                                        <select name="enseignement_id" id="enseignement_id" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($enseignements as $ens)
                                                <option value="{{ $ens->id }}"
                                                    data-slug="{{ strtolower($ens->nom) }}">
                                                    {{ $ens->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" d-none" id="autre_div">
                                        <label class="form-label">Précisez</label>
                                        <input type="text" name="autre_enseignement" id="autre_input"
                                            class="form-control">
                                    </div>
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mt-4 mb-3">Localisation</h6>

                                    <div class=" groupe-departement d-none">
                                        <label class="form-label">Département de service </label>
                                        <select name="departement_id" id="departement_id" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($departements as $d)
                                                <option value="{{ $d->id }}">{{ $d->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" groupe-district d-none">
                                        <label class="form-label">Circonscription de service</label>
                                        <select name="circonscription_id" id="circonscription_id" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                        </select>
                                    </div>
                                    <div class=" groupe-district d-none">
                                        <label class="form-label">Département de formation</label>
                                        <select name="district_id" id="district_id" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($districts as $dist)
                                                <option value="{{ $dist->id }}">{{ $dist->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" groupe-district d-none">
                                        <label class="form-label">Circonscription de formation</label>
                                        <select name="formation_id" id="formation_id" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                        </select>
                                    </div>

                                    <div class=" groupe-province d-none">
                                        <label class="form-label">Département  de formation</label>
                                        <select name="province_id" id="province_id" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" groupe-province d-none">
                                        <label class="form-label">Commune de formation</label>
                                        <select name="region_id" id="region_id" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                        </select>
                                    </div>


                                    @if (!$selectedOption)
                                        <h6 class="fw-bold text-dark border-bottom pb-2 mt-4 mb-3">Option</h6>
                                        <div class="col-md-12">
                                            <label class="form-label smallest fw-bold text-muted text-uppercase">Option</label>
                                            <select name="option_id"
                                                class="form-select bg-light border-0 py-2 rounded-2 @error('option_id') is-invalid @enderror"
                                                required>
                                                <option value="">-- Choisir une Option --</option>
                                                @foreach ($options as $option)
                                                    @if ($option->statut === 'visible')
                                                        <option value="{{ $option->id }}"
                                                            {{ old('option_id') == $option->id ? 'selected' : '' }}>
                                                            {{ $option->nom }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('option_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif



                                    <div class="">
                                        <label class="form-label">Montant (XOF)</label>
                                        <input type="number" name="montant" class="form-control fw-bold text-success"
                                            value="{{ old('montant') }}" min="1">
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <button type="submit"
                                            class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm">
                                            <span class="btn-text">💳 S'inscrire et Payer <i
                                                    class="fas fa-paper-plane ms-2"></i></span>
                                            <span class="btn-loader d-none">
                                                <span class="spinner-border spinner-border-sm me-2" role="status"
                                                    aria-hidden="true"></span>
                                                Envoi en cours...
                                            </span>
                                        </button>

                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


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
                document.querySelectorAll('.groupe-departement, .groupe-district, .groupe-province').forEach(el =>
                    el.classList.add('d-none'));
                autreDiv.classList.add('d-none');
            }

            enseignement.addEventListener('change', function() {
                hideAll();

                const slug = this.selectedOptions[0]?.dataset.slug;

                if (slug === 'maternel' || slug === 'primaire') {
                    document.querySelectorAll('.groupe-departement, .groupe-district').forEach(el => el
                        .classList.remove('d-none'));
                }

                if (slug === 'secondaire') {
                    document.querySelectorAll('.groupe-province').forEach(el => el.classList.remove(
                        'd-none'));
                }

                if (slug === 'autre') {
                    document.querySelectorAll('.groupe-province').forEach(el => el.classList.remove(
                        'd-none'));
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
                        data.forEach(d => circonscription.innerHTML +=
                            `<option value="${d.id}">${d.nom}</option>`);
                    });
            });

            district.addEventListener('change', function() {
                formation.innerHTML = '<option>Chargement...</option>';
                fetch(`/formations/by-district/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        formation.innerHTML = '<option value="">-- Sélectionner --</option>';
                        data.forEach(f => formation.innerHTML +=
                            `<option value="${f.id}">${f.nom}</option>`);
                    });
            });

            province.addEventListener('change', function() {
                region.innerHTML = '<option>Chargement...</option>';
                fetch(`/regions/by-province/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        region.innerHTML = '<option value="">-- Sélectionner --</option>';
                        data.forEach(r => region.innerHTML +=
                            `<option value="${r.id}">${r.nom}</option>`);
                    });
            });

        });
    </script>
@endsection
