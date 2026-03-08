@extends('layouts.admin')

@section('title', 'Paramètres du site')

@section('content')
<div class="container-fluid py-4">
    <form action="{{ route('administrateur.gestparametres.parametres.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Section Informations générales --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Informations générales du site</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom du site *</label>
                        <input type="text" name="website_name" 
                               value="{{ old('website_name', $parametres->website_name ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL du site *</label>
                        <input type="url" name="website_url" 
                               value="{{ old('website_url', $parametres->website_url ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description (Meta Description)</label>
                        <textarea name="meta_description" rows="3" 
                                  class="form-control">{{ old('meta_description', $parametres->meta_description ?? '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Photo du site</label>
                        <input type="file" name="photo" class="form-control">
                        @if($parametres && $parametres->photo)
                            <div class="mt-2">
                                <img src="{{ asset('uploads/'.$parametres->photo) }}" 
                                     alt="Photo actuelle" width="150" class="border p-2 rounded">
                                
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Informations de contact --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Informations de contact</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Téléphone N°1 *</label>
                        <input type="tel" name="phone1" 
                               value="{{ old('phone1', $parametres->phone1 ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone N°2</label>
                        <input type="tel" name="phone2" 
                               value="{{ old('phone2', $parametres->phone2 ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email 1 *</label>
                        <input type="email" name="email1" 
                               value="{{ old('email1', $parametres->email1 ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email 2</label>
                        <input type="email" name="email2" 
                               value="{{ old('email2', $parametres->email2 ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Adresse *</label>
                        <textarea name="address" rows="3" class="form-control">{{ old('address', $parametres->address ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Réseaux sociaux --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Réseaux sociaux</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Facebook</label>
                        <input type="url" name="facebook" 
                               value="{{ old('facebook', $parametres->facebook ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Twitter</label>
                        <input type="url" name="twitter" 
                               value="{{ old('twitter', $parametres->twitter ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">WhatsApp</label>
                        <input type="url" name="whatsapp" 
                               value="{{ old('whatsapp', $parametres->whatsapp ?? '') }}" 
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">YouTube</label>
                        <input type="url" name="youtube" 
                               value="{{ old('youtube', $parametres->youtube ?? '') }}" 
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success btn-lg">Enregistrer</button>
        </div>
    </form>
</div>

{{-- Messages flash SweetAlert --}}
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: {!! json_encode(session('success')) !!},
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: true
    });
});
</script>
@endif
@endsection
