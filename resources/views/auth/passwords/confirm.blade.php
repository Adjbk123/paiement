@extends('layouts.app')
@section('title', 'Confirmer le mot de passe')

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Confirmation',
    'breadcrumbs' => [
        ['label' => 'Confirmer le mot de passe', 'url' => null],
    ]
])

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3"
                         style="width:60px;height:60px;">
                        <i class="fas fa-shield-alt fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Sécurité renforcée</h5>
                    <small class="opacity-75">Veuillez confirmer votre mot de passe avant de continuer</small>
                </div>

                <div class="card-body p-4 p-md-5">

                    @include('layouts.alerte')

                    <form action="{{ route('password.confirm') }}" method="POST">
                        @csrf

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-muted small text-uppercase">
                                Mot de passe <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input type="password" id="password" name="password"
                                       class="form-control bg-light border-0 @error('password') is-invalid @enderror"
                                       required autocomplete="current-password"
                                       placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            <i class="fas fa-check-circle me-2"></i> Confirmer
                        </button>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-4 pt-3 border-top">
                                <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none fw-bold">
                                    <i class="fas fa-question-circle me-1"></i> Mot de passe oublié ?
                                </a>
                            </div>
                        @endif

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
