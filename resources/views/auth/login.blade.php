@extends('layouts.auth')
@section('title', 'Connexion')
@section('content')
<style>
    .login-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 15px;
    }

    .login-card {
        width: 100%;
        max-width: 360px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 1.4rem;
        animation: fadeInUp 0.6s ease-in-out;
    }

    .login-title {
        font-weight: 700;
        color: #1d3557;
        margin-bottom: 1rem;
        text-align: center;
        font-size: 1.3rem;
    }

    .mb-3 { margin-bottom: 0.8rem !important; }

    .form-label {
        font-size: 0.8rem;
        margin-bottom: 4px;
    }

    .input-group {
        border: 1px solid #ced4da;
        border-radius: 10px;
        height: 40px;
        overflow: hidden;
        transition: 0.2s ease;
    }

    .input-group:focus-within {
        border-color: #1d3557;
        box-shadow: 0 0 0 2px rgba(69, 123, 157, 0.15);
    }

    .form-control {
        border: none;
        font-size: 0.9rem;
        padding: 6px 12px;
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: #1d3557;
        font-size: 0.9rem;
        padding-right: 10px;
    }

    .btn-primary {
        background: #1d3557;
        border: none;
        border-radius: 10px;
        padding: 6px 16px;
        font-size: 0.9rem;
        transition: 0.2s ease;
    }

    .btn-primary:hover {
        background: #457b9d;
        transform: translateY(-1px);
    }

    .form-check-label {
        font-size: 0.8rem;
    }

    .text-center p, .text-center a {
        font-size: 0.85rem;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h3 class="login-title">Connexion</h3>

        @include('layouts.alerte')

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Adresse e-mail</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" class="form-control" required placeholder="Entrez votre e-mail">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Mot de passe</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" required placeholder="Entrez votre mot de passe">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </form>

        <div class="text-center mt-3">
            @if (Route::has('password.request'))
                <p class="mb-1"><a href="{{ route('password.request') }}">Mot de passe oublié ?</a></p>
            @endif
            <p class="mb-0"><a href="{{ route('register') }}">Créer un compte</a></p>
        </div>
    </div>
</div>
@endsection
