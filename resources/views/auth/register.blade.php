@extends('layouts.auth')
@section('title', 'Connexion')
@section('content')
<style>
    .register-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 15px;
    }

    .register-card {
        width: 100%;
        max-width: 360px; /* plus compact */
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 1.4rem;
        animation: fadeInUp 0.6s ease-in-out;
    }

    .register-title {
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

    .text-center small {
        font-size: 0.8rem;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="register-wrapper">
    <div class="register-card">
        <h3 class="register-title">Créer un compte</h3>

         @include('layouts.alerte')

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nom et prénom(s)</label>
                <div class="input-group">
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required placeholder="Entrez votre nom complet">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Adresse e-mail</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required placeholder="Entrez votre e-mail">
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

            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-semibold">Confirmez le mot de passe</label>
                <div class="input-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Confirmez votre mot de passe">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms" name="terms">
                    <label class="form-check-label" for="terms">
                        J’accepte les <a href="#">termes et conditions</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small class="text-muted">Vous avez déjà un compte ?</small>
            <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Se connecter</a>
        </div>
    </div>
</div>
@endsection
