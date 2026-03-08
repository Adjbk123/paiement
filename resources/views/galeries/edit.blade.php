@extends('layouts.admin')
@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-3">Modifier la Galerie</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('employer.gestgaleries.galeries.update', $galerie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Titre (facultatif)</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $galerie->title) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (facultatif)</label>
                    <textarea name="description" id="description" class="form-control editor">{{ old('description', $galerie->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="societe" {{ old('type', $galerie->type) == 'societe' ? 'selected' : '' }}>Société</option>
                        <option value="publicite" {{ old('type', $galerie->type) == 'publicite' ? 'selected' : '' }}>Publicité</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control">

                    @if($galerie->image)
                        <div class="mt-2">
                            <p>Image actuelle :</p>
                            <img src="{{ asset($galerie->image) }}" alt="Image" class="img-thumbnail" width="150">
                        </div>
                    @endif
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="statut" value="0" class="form-check-input" id="statut"
                        {{ old('statut', $galerie->statut) == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="statut">Visible</label>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('employer.gestgaleries.galeries.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
