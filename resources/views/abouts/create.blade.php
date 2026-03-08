@extends('layouts.admin')

@section('title', 'Ajouter About')

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h3 class="fw-bold">
            <i class="fa fa-plus text-primary"></i> Ajouter About
        </h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('employer.gestabouts.abouts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Subtitle --}}
                <div class="mb-3">
                    <label class="form-label">Sous titre</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <hr>

                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa fa-book"></i> Tabs (Histire Mission / Vision)
                </h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Story</label>
                        <textarea name="tabs[story]" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Mission</label>
                        <textarea name="tabs[mission]" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Vision</label>
                        <textarea name="tabs[vision]" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <hr>

                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa fa-star"></i> Features
                </h5>

                @for($i = 0; $i < 3; $i++)
                <div class="border rounded p-3 mb-3">

                    <div class="mb-2">
                        <label>Titre Feature</label>
                        <input type="text" name="features[{{ $i }}][title]" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Description</label>
                        <input type="text" name="features[{{ $i }}][description]" class="form-control">
                    </div>



                </div>
                @endfor

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('employer.gestabouts.abouts.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Enregistrer
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
