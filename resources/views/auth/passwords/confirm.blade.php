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

    .confirm-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 100vh;
    }

    .confirm-card {
        width: 100%;
        max-width: 400px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 2rem;
        animation: fadeInUp 0.8s ease-in-out;
    }

    .confirm-title {
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
        margin-bottom: 1rem;
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
        width: 100%;
        padding: 10px;
    }

    .btn-primary:hover {
        background: #457b9d;
        transform: translateY(-2px);
    }

    .text-center a {
        color: #1d3557;
        text-decoration: none;
        font-weight: 600;
    }

    .text-center a:hover {
        color: #457b9d;
        text-decoration: underline;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="confirm-wrapper">
    <div class="confirm-card">
        <h3 class="confirm-title">Confirmer le mot de passe</h3>
        <p class="text-muted text-center mb-3">
            Veuillez confirmer votre mot de passe avant de continuer.
        </p>

        @include('layouts.alerte')

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="input-group">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password" placeholder="Entrez votre mot de passe">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Confirmer le mot de passe</button>
        </form>

        <div class="text-center mt-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            @endif
        </div>
    </div>
</div>
@endsection
