@extends('layouts.admin')

@section('title', 'Modifier About')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h3 class="fw-bold">
            <i class="fa fa-edit text-warning"></i> Modifier About
        </h3>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('employer.gestabouts.abouts.update', $about) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Subtitle --}}
                <div class="mb-3">
                    <label class="form-label">Sous titre</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $about->subtitle) }}">
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $about->title) }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $about->description) }}</textarea>
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label class="form-label">Image</label>
                    @if($about->image_path)
                        <div class="mb-2">
                            <img src="{{ asset($about->image_path) }}" width="120" class="rounded shadow-sm">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <hr>

                {{-- Tabs --}}
                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa fa-book"></i> Tabs
                </h5>

                @php
                    $tabs = is_array($about->tabs) ? $about->tabs : json_decode($about->tabs, true) ?? [];
                @endphp

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Histoire</label>
                        <textarea name="tabs[story]" class="form-control" rows="3">{{ old('tabs.story', $tabs['story'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Mission</label>
                        <textarea name="tabs[mission]" class="form-control" rows="3">{{ old('tabs.mission', $tabs['mission'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Vision</label>
                        <textarea name="tabs[vision]" class="form-control" rows="3">{{ old('tabs.vision', $tabs['vision'] ?? '') }}</textarea>
                    </div>
                </div>

                <hr>

                {{-- Features --}}
                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa fa-star"></i> Features
                    <button type="button" class="btn btn-success btn-sm float-end" id="add-feature">
                        <i class="fa fa-plus"></i> Ajouter Feature
                    </button>
                </h5>

                <div id="features-container">
                    @php
                        $features = is_array($about->features) ? $about->features : json_decode($about->features, true) ?? [];
                    @endphp

                    @foreach($features as $i => $feature)
                        <div class="card mb-3 feature-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="card-title">Feature #{{ $i + 1 }}</h6>
                                    <button type="button" class="btn btn-danger btn-sm remove-feature">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>

                                <div class="mb-2">
                                    <label>Titre Feature</label>
                                    <input type="text" name="features[{{ $i }}][title]" value="{{ $feature['title'] ?? '' }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label>Description</label>
                                    <input type="text" name="features[{{ $i }}][description]" value="{{ $feature['description'] ?? '' }}" class="form-control">
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('employer.gestabouts.abouts.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save"></i> Mettre à jour
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- JS pour ajouter/supprimer dynamiquement --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let featureIndex = {{ count($features) }};

    // Ajouter un nouveau feature
    $('#add-feature').click(function() {
        let html = `
        <div class="card mb-3 feature-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="card-title">Feature #${featureIndex + 1}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-feature">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="mb-2">
                    <label>Titre Feature</label>
                    <input type="text" name="features[${featureIndex}][title]" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <input type="text" name="features[${featureIndex}][description]" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Icône</label>
                    <input type="text" name="features[${featureIndex}][icon]" class="form-control">
                </div>
            </div>
        </div>`;
        $('#features-container').append(html);
        featureIndex++;
    });

    // Supprimer un feature
    $(document).on('click', '.remove-feature', function() {
        $(this).closest('.feature-card').remove();
    });
});
</script>
@endsection
