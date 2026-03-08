@extends('layouts.admin')
@section('title','Créer un Service')
@section('content')
<div class="container py-4">

    <h2 class="mb-4">Créer un Service</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('employer.gestservices.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom du Service <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Ex: Consulting" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description <span class="text-danger"></span></label>
                    <textarea name="description" class="form-control editor " placeholder="Description du service" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image du Service</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Formats autorisés: jpeg, png, jpg, gif</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Particularités (séparées par des virgules)</label>
                    <input type="text" name="features" class="form-control" placeholder="Ex: Secured Loans, Cash Advance">
                    <small class="text-muted">Chaque particularité sera affichée comme un item dans la card.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lien (optionnel)</label>
                    <input type="url" name="link" class="form-control" placeholder="https://example.com">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Créer le Service
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
