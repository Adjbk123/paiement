@extends('layouts.app')

@section('title', 'Paiement réussi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Paiement Réussi ✅</h3>
                </div>
                <div class="card-body">
                    <p>Merci <strong>{{ $paiement->prenoms }} {{ $paiement->nom }}</strong> pour votre paiement.</p>

                    <h5>Détails du paiement :</h5>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">
                            <strong>Référence :</strong> {{ $paiement->reference }}
                        </li>
                        <li class="list-group-item">
                            <strong>Montant :</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} XOF
                        </li>
                        <li class="list-group-item">
                            <strong>Status :</strong> {{ ucfirst($paiement->status) }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email :</strong> {{ $paiement->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Option choisie :</strong> {{ $paiement->option->nom ?? '-' }}
                        </li>
                        <li class="list-group-item">
                            <strong>Formation :</strong> {{ $paiement->formation->nom ?? '-' }}
                        </li>
                    </ul>

                    @if($paiement->status === 'approved')
                        <div class="alert alert-success">
                            Votre paiement a été validé et un reçu vous a été envoyé par email.
                        </div>

                        <a href="{{ route('paiement.download', $paiement->id) }}" class="btn btn-primary">
                            Télécharger le reçu PDF
                        </a>
                    @else
                        <div class="alert alert-warning">
                            Le paiement est en cours de validation. Veuillez vérifier votre email ultérieurement.
                        </div>
                    @endif

                    <a href="{{ route('paiement') }}" class="btn btn-secondary mt-3">Retour au formulaire</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
