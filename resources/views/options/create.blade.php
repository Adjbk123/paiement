@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        <div class="card shadow-sm border-0 rounded-3">
            <!-- Card Header -->
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Ajouter une nouvelle Option</h4>
            </div>

            <!-- Card Body -->
            <div class="card-body">

                {{-- Messages d'erreurs --}}
                @if ($errors->any())
                    <div class="alert alert-danger p-2 mb-3">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulaire --}}
                <form action="{{ route('employer.gestoptions.options.store') }}" method="POST">
                    @csrf

                    {{-- Nom --}}
                    <div class="mb-3">
                        <label for="nom" class="form-label small">Nom de l'option</label>
                        <input type="text" class="form-control form-control-sm" id="nom" name="nom"
                            value="{{ old('nom') }}" placeholder="Ex: Inscription, Formation complète" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (facultatif)</label>
                        <textarea name="description" id="description" class="form-control editor">{{ old('description') }}</textarea>
                    </div>
                    {{-- Montant total --}}
                    <div class="mb-3">
                        <label for="option_montant" class="form-label small fw-semibold">
                            Montant total (FCFA) <span class="text-danger">*</span>
                        </label>
                        <input type="number" step="1" min="0" class="form-control form-control-sm @error('option_montant') is-invalid @enderror"
                            id="option_montant" name="option_montant"
                            value="{{ old('option_montant') }}" placeholder="Ex: 32000" required>
                        @error('option_montant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Montant minimum premier versement --}}
                    <div class="mb-3">
                        <label for="montant_minimum" class="form-label small fw-semibold">
                            Montant minimum du 1<sup>er</sup> versement (FCFA)
                            <span class="text-muted fw-normal">— facultatif</span>
                        </label>
                        <input type="number" step="1" min="0" class="form-control form-control-sm @error('montant_minimum') is-invalid @enderror"
                            id="montant_minimum" name="montant_minimum"
                            value="{{ old('montant_minimum') }}" placeholder="Ex: 10000">
                        <div class="form-text">
                            <i class="fas fa-info-circle text-primary me-1"></i>
                            Laisser vide pour autoriser n'importe quel montant comme premier versement.
                            Si renseigné, doit être inférieur au montant total.
                        </div>
                        @error('montant_minimum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Statut --}}
                    <div class="mb-3">
                        <label for="statut" class="form-label small">Statut</label>
                        <select class="form-control form-select-sm" id="statut" name="statut" required>
                            <option value="visible" {{ old('statut') == 'visible' ? 'selected' : '' }}>Visible</option>
                            <option value="invisible" {{ old('statut') == 'invisible' ? 'selected' : '' }}>Invisible
                            </option>
                        </select>
                    </div>

                    {{-- Boutons --}}
                    <div class="text-end">
                        <a href="{{ route('employer.gestoptions.options.index') }}" class="btn btn-secondary me-2">
                            <i class="fa-solid fa-arrow-left"></i> Retour
                        </a>
                        <button class="btn btn-success" type="submit">
                            <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
