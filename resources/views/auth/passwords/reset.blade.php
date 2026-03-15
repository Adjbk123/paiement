@extends('layouts.app')
@section('title', 'Réinitialiser le mot de passe')

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Réinitialisation',
    'breadcrumbs' => [
        ['label' => 'Réinitialiser le mot de passe', 'url' => null],
    ]
])

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3"
                         style="width:60px;height:60px;">
                        <i class="fas fa-unlock-alt fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Nouveau mot de passe</h5>
                    <small class="opacity-75">Veuillez saisir votre nouveau mot de passe</small>
                </div>

                <div class="card-body p-4 p-md-5">

                    @include('layouts.alerte')

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-muted small text-uppercase">
                                Adresse e-mail <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input id="email" type="email"
                                       class="form-control bg-light border-0 @error('email') is-invalid @enderror"
                                       name="email" value="{{ $email ?? old('email') }}"
                                       required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Nouveau mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-muted small text-uppercase">
                                Nouveau mot de passe <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input id="password" type="password"
                                       class="form-control bg-light border-0 @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmation -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold text-muted small text-uppercase">
                                Confirmez le mot de passe <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </span>
                                <input id="password-confirm" type="password"
                                       class="form-control bg-light border-0"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            <i class="fas fa-save me-2"></i> Réinitialiser
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
