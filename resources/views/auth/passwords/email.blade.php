@extends('layouts.app')
@section('title', 'Mot de passe oublié')

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Mot de passe oublié',
    'breadcrumbs' => [
        ['label' => 'Réinitialisation', 'url' => null],
    ]
])

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3"
                         style="width:60px;height:60px;">
                        <i class="fas fa-key fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Mot de passe oublié</h5>
                    <small class="opacity-75">Saisissez votre e-mail pour recevoir un lien de réinitialisation</small>
                </div>

                <div class="card-body p-4 p-md-5">

                    @include('layouts.alerte')

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-muted small text-uppercase">
                                Adresse e-mail <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input type="email" id="email" name="email"
                                       class="form-control bg-light border-0 @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       required autocomplete="email" autofocus
                                       placeholder="votre@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            <i class="fas fa-paper-plane me-2"></i> Envoyer le lien
                        </button>

                        <div class="text-center mt-4 pt-3 border-top">
                            <a href="{{ route('login') }}" class="small text-primary text-decoration-none fw-bold">
                                <i class="fas fa-arrow-left me-1"></i> Retour à la connexion
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
