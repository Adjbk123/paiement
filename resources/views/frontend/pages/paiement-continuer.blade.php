@extends('layouts.app')
@section('title', 'Compléter mon paiement')

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Compléter mon paiement',
    'breadcrumbs' => [
        ['label' => 'Compléter mon paiement', 'url' => null],
    ]
])

<div class="container py-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3"
                         style="width:60px;height:60px;">
                        <i class="fas fa-key fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Retrouver mon dossier</h5>
                    <small class="opacity-75">Saisissez votre code de suivi reçu lors de votre inscription</small>
                </div>

                <div class="card-body p-4 p-md-5">

                    @if(session('info'))
                        <div class="alert alert-info border-0 rounded-3 mb-4">
                            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4 small">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ $errors->first('token') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('paiement.continuer.recherche') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small text-uppercase">
                                Code de suivi <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="token"
                                class="form-control form-control-lg bg-light border-0 rounded-3 text-center fw-bold @error('token') is-invalid @enderror"
                                value="{{ old('token') }}"
                                placeholder="MAF-2025-XXXXX"
                                style="letter-spacing:3px;font-size:1.2rem;"
                                autocomplete="off"
                                required>
                            <div class="form-text text-center mt-2">
                                <i class="fas fa-info-circle text-primary me-1"></i>
                                Ce code vous a été communiqué après votre premier versement.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            <i class="fas fa-search me-2"></i> Trouver mon dossier
                        </button>

                    </form>

                    <hr class="my-4">

                    <p class="text-center text-muted small mb-0">
                        Vous n'avez pas encore de dossier ?
                        <a href="{{ route('frontend.paiement') }}" class="text-primary fw-semibold">
                            S'inscrire à une formation
                        </a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
