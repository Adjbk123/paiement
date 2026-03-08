@extends('layouts.admin')
@section('title','Modifier un Service')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Modifier le Service</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('employer.gestservices.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom du Service <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control editor" rows="4" required>{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image du Service</label>
                    @if($service->image_path)
                        <div class="mb-2">
                            <img src="{{ asset($service->image_path) }}" width="150" class="rounded shadow-sm">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Formats autorisés: jpeg, png, jpg, gif</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Particularités (features)</label>
                    <div id="features-container">
                        @if($service->features && is_array($service->features))
                            @foreach($service->features as $i => $feature)
                                <div class="input-group mb-2 feature-item">
                                    <input type="text" name="features[]" class="form-control" value="{{ $feature }}">
                                    <button type="button" class="btn btn-danger remove-feature"><i class="fa fa-times"></i></button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-success btn-sm" id="add-feature">
                        <i class="fa fa-plus"></i> Ajouter Feature
                    </button>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lien (optionnel)</label>
                    <input type="url" name="link" class="form-control" value="{{ old('link', $service->link) }}">
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Mettre à jour le Service
                </button>
                <a href="{{ route('employer.gestservices.services.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Retour
                </a>
            </form>
        </div>
    </div>
</div>

{{-- JS pour gérer les features dynamiques --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('features-container');
    const addBtn = document.getElementById('add-feature');

    addBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2', 'feature-item');
        div.innerHTML = `
            <input type="text" name="features[]" class="form-control" placeholder="Nouvelle feature">
            <button type="button" class="btn btn-danger remove-feature"><i class="fa fa-times"></i></button>
        `;
        container.appendChild(div);
    });

    container.addEventListener('click', function(e) {
        if(e.target.closest('.remove-feature')) {
            e.target.closest('.feature-item').remove();
        }
    });
});
</script>

{{-- CSS pour un rendu moderne --}}
<style>
.feature-item input {
    flex: 1;
}
.feature-item .remove-feature {
    border-radius: 0 0.25rem 0.25rem 0;
}
</style>
@endsection
