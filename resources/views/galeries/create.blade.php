@extends('layouts.admin')
@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-3">Créer une nouvelle Galerie</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employer.gestgaleries.galeries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Titre (facultatif)</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (facultatif)</label>
                    <textarea name="description" id="description" class="form-control editor">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="societe" {{ old('type') == 'societe' ? 'selected' : '' }}>Société</option>
                        <option value="publicite" {{ old('type') == 'publicite' ? 'selected' : '' }}>Publicité</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="statut" value="0" class="form-check-input" id="statut"
                        {{ old('statut', 0) == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="statut">Visible</label>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('employer.gestgaleries.galeries.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
