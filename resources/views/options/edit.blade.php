@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        <div class="card shadow-sm border-0 rounded-3">
            <!-- Card Header -->
            <div class="card-header bg-warning text-white text-center">
                <h4 class="mb-0">Modifier l'Option</h4>
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
                <form action="{{ route('employer.gestoptions.options.update', $option->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nom --}}
                    <div class="mb-3">
                        <label for="nom" class="form-label small">Nom de l'option</label>
                        <input type="text" class="form-control form-control-sm" id="nom" name="nom"
                            value="{{ old('nom', $option->nom) }}" placeholder="Ex: Inscription, Formation complète"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (facultatif)</label>
                        <textarea name="description" id="description" class="form-control editor">{{ old('description', $option->description) }}</textarea>
                    </div>
                    {{-- Montant --}}
                    <div class="mb-3">
                        <label for="option_montant" class="form-label small">Montant (FCFA)</label>
                        <input type="number" step="0.01" class="form-control form-control-sm" id="option_montant"
                            name="option_montant" value="{{ old('option_montant', $option->option_montant) }}"
                            placeholder="Ex: 25000" required>
                    </div>

                    {{-- Statut --}}
                    <div class="mb-3">
                        <label for="statut" class="form-label small">Statut</label>
                        <select class="form-control form-select-sm" id="statut" name="statut" required>
                            <option value="visible" {{ old('statut', $option->statut) == 'visible' ? 'selected' : '' }}>
                                Visible</option>
                            <option value="invisible" {{ old('statut', $option->statut) == 'invisible' ? 'selected' : '' }}>
                                Invisible</option>
                        </select>
                    </div>

                    {{-- Boutons --}}
                    <div class="text-end">
                        <a href="{{ route('employer.gestoptions.options.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-solid fa-arrow-left"></i> Retour
                        </a>
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-edit "></i> Mettre à jour
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
