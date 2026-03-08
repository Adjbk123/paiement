@extends('layouts.auth')
@section('title', 'Connexion')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1d3557, #457b9d, #a8dadc);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .forgot-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }

    .forgot-card {
        width: 100%;
        max-width: 400px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 2rem;
        animation: fadeInUp 0.8s ease-in-out;
    }

    .forgot-title {
        font-weight: 700;
        color: #1d3557;
        margin-bottom: 1.2rem;
        text-align: center;
    }

    .input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ced4da;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .input-group:focus-within {
        border-color: #1d3557;
        box-shadow: 0 0 0 3px rgba(69, 123, 157, 0.2);
    }

    .form-control {
        border: none;
        box-shadow: none;
        padding: 10px 15px;
        flex: 1;
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: #1d3557;
        padding-right: 12px;
        font-size: 1.1rem;
    }

    .btn-primary {
        background: #1d3557;
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #457b9d;
        transform: translateY(-2px);
    }

    .text-muted {
        color: #555 !important;
        font-size: 0.95rem;
        text-align: center;
    }

    a {
        color: #1d3557;
        font-weight: 600;
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
        color: #457b9d;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="forgot-wrapper">
    <div class="forgot-card">
        <h3 class="forgot-title">Mot de passe oublié</h3>

        <p class="text-muted mb-4">
            Entrez votre adresse e-mail pour recevoir un lien de réinitialisation.
        </p>

        @include('layouts.alerte')

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Adresse e-mail</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" class="form-control" required placeholder="Entrez votre e-mail">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                Envoyer le lien
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">← Retour à la connexion</a>
        </div>
    </div>
</div>
@endsection
