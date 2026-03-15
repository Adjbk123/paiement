@extends('layouts.app')
@section('title', 'Inscription')

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Inscription',
    'breadcrumbs' => [
        ['label' => 'Inscription', 'url' => null],
    ]
])

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3"
                         style="width:60px;height:60px;">
                        <i class="fas fa-user-plus fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Créer un compte</h5>
                    <small class="opacity-75">Remplissez le formulaire pour vous inscrire</small>
                </div>

                <div class="card-body p-4 p-md-5">

                    @include('layouts.alerte')

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <!-- Nom Complet -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-muted small text-uppercase">
                                Nom et prénom(s) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-user text-primary"></i>
                                </span>
                                <input type="text" id="name" name="name"
                                       class="form-control bg-light border-0 @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       required autocomplete="name"
                                       placeholder="Entrez votre nom complet">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
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
                                       required autocomplete="email"
                                       placeholder="votre@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-muted small text-uppercase">
                                Mot de passe <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input type="password" id="password" name="password"
                                       class="form-control bg-light border-0 @error('password') is-invalid @enderror"
                                       required autocomplete="new-password"
                                       placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold text-muted small text-uppercase">
                                Confirmez le mot de passe <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control bg-light border-0"
                                       required autocomplete="new-password"
                                       placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            <i class="fas fa-user-plus me-2"></i> S'inscrire
                        </button>

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-muted small mb-2">Vous avez déjà un compte ?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 py-2 rounded-pill fw-bold">
                                <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
