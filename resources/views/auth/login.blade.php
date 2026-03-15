@extends('layouts.app')
@section('title', 'Connexion')

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Connexion',
    'breadcrumbs' => [
        ['label' => 'Connexion', 'url' => null],
    ]
])

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3"
                         style="width:60px;height:60px;">
                        <i class="fas fa-lock fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Espace Administrateur</h5>
                    <small class="opacity-75">Connectez-vous pour accéder au tableau de bord</small>
                </div>

                <div class="card-body p-4 p-md-5">

                    @include('layouts.alerte')

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

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
                                <button type="button" class="input-group-text bg-light border-0 text-muted"
                                        id="togglePassword" title="Afficher/masquer le mot de passe"
                                        style="cursor:pointer;">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember"
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                        </button>

                        @if (Route::has('register'))
                            <div class="text-center mt-4 pt-3 border-top">
                                <p class="text-muted small mb-2">Vous n'avez pas de compte ?</p>
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100 py-2 rounded-pill fw-bold">
                                    <i class="fas fa-user-plus me-2"></i> S'inscrire
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

@section('script')
<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
});
</script>
@endsection
