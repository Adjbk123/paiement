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

    .reset-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }

    .reset-card {
        width: 100%;
        max-width: 400px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 2rem;
        animation: fadeInUp 0.8s ease-in-out;
    }

    .reset-title {
        font-weight: 700;
        color: #1d3557;
        margin-bottom: 1.5rem;
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
        font-size: 0.95rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .form-check-label a {
        color: #1d3557;
        text-decoration: none;
        font-weight: 600;
    }

    .form-check-label a:hover {
        color: #457b9d;
        text-decoration: underline;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="reset-wrapper">
    <div class="reset-card">
        <h3 class="reset-title">Réinitialiser le mot de passe</h3>
        <p class="text-muted">Entrez votre email et votre nouveau mot de passe.</p>

        @include('layouts.alerte')

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Adresse e-mail</label>
                <div class="input-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <!-- Nouveau mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Nouveau mot de passe</label>
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <!-- Confirmation -->
            <div class="mb-3">
                <label for="password-confirm" class="form-label fw-semibold">Confirmez le mot de passe</label>
                <div class="input-group">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required autocomplete="new-password">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Réinitialiser le mot de passe</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">← Retour à la connexion</a>
        </div>
    </div>
</div>
@endsection
