@extends('layouts.app')
@section('title', 'Vérifiez votre adresse e-mail')

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Vérification',
    'breadcrumbs' => [
        ['label' => 'Vérifiez votre e-mail', 'url' => null],
    ]
])

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white p-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-25 rounded-circle mb-3"
                         style="width:60px;height:60px;">
                        <i class="fas fa-envelope-open-text fs-3"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Vérification de l'e-mail</h5>
                    <small class="opacity-75">Confirmez votre identité pour continuer</small>
                </div>

                <div class="card-body p-4 p-md-5 text-center">

                    @if (session('resent'))
                        <div class="alert alert-success rounded-3 small" role="alert">
                            <i class="fas fa-check-circle me-1"></i> Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                        </div>
                    @endif

                    <p class="text-muted small mb-4">
                        Avant de continuer, veuillez vérifier vos e-mails pour un lien de vérification.
                        <br><br>
                        Si vous n'avez pas reçu l'e-mail d'activation, vous pouvez en demander un nouveau.
                    </p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                            <i class="fas fa-paper-plane me-2"></i> Renvoyer le lien
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
