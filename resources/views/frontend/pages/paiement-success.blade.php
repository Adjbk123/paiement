@extends('layouts.app')
@section('title', 'Confirmation de paiement')

@section('content')

@php
    $estApprouve  = isset($tranche) ? $tranche->status === 'approved'                       : $inscription->status === 'approved';
    $estEchoue    = isset($tranche) ? in_array($tranche->status, ['failed','declined'])      : $inscription->status === 'failed';
    $estEnAttente = !$estApprouve && !$estEchoue;
    $montantVerse = isset($tranche) ? $tranche->montant_tranche                              : $inscription->montant;
@endphp

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Confirmation de paiement',
    'breadcrumbs' => [
        ['label' => 'Inscription', 'url' => route('frontend.paiement')],
        ['label' => 'Confirmation', 'url' => null],
    ]
])

<div class="container py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Bande couleur top --}}
                <div class="@if($estApprouve) bg-success @elseif($estEchoue) bg-danger @else bg-warning @endif"
                     style="height:6px;"></div>

                <div class="card-body p-4 p-md-5">

                    {{-- Icône et statut --}}
                    <div class="text-center mb-4">
                        @if($estApprouve)
                            <div class="d-inline-flex align-items-center justify-content-center bg-success rounded-circle mb-3"
                                 style="width:80px;height:80px;">
                                <i class="fas fa-check text-white" style="font-size:2rem;"></i>
                            </div>
                            <h4 class="fw-bold text-dark">Paiement confirmé !</h4>
                            <p class="text-muted">Merci <strong>{{ $inscription->prenoms }} {{ $inscription->nom }}</strong></p>
                        @elseif($estEchoue)
                            <div class="d-inline-flex align-items-center justify-content-center bg-danger rounded-circle mb-3"
                                 style="width:80px;height:80px;">
                                <i class="fas fa-times text-white" style="font-size:2rem;"></i>
                            </div>
                            <h4 class="fw-bold text-dark">Paiement échoué</h4>
                            <p class="text-muted">Le paiement n'a pas pu être complété.</p>
                        @else
                            <div class="d-inline-flex align-items-center justify-content-center bg-warning rounded-circle mb-3"
                                 style="width:80px;height:80px;">
                                <i class="fas fa-clock text-white" style="font-size:2rem;"></i>
                            </div>
                            <h4 class="fw-bold text-dark">En attente</h4>
                            <p class="text-muted">Votre paiement est en cours de traitement.</p>
                        @endif
                    </div>

                    {{-- ===== ALERTE EN ATTENTE ===== --}}
                    @if($estEnAttente)
                        <div class="alert alert-warning border-0 rounded-3 text-center mb-4">
                            <i class="fas fa-hourglass-half me-2"></i>
                            <strong>Paiement non confirmé.</strong> Votre transaction est en attente ou n'a pas abouti.
                            Aucun montant n'a été débité. Vous pouvez réessayer.
                        </div>
                    @endif

                    {{-- ===== CODE DE SUIVI (si paiement approuvé et solde non soldé) ===== --}}
                    @if($estApprouve && $inscription->token && !$inscription->estPaye())
                        <div class="p-4 rounded-3 mb-4 text-center border border-primary"
                             style="background:linear-gradient(135deg,#eef2ff,#f8f9ff);">
                            <small class="text-primary fw-bold text-uppercase d-block mb-2"
                                   style="letter-spacing:1px;">
                                <i class="fas fa-key me-1"></i> Votre code de suivi — Conservez-le !
                            </small>
                            <div class="fw-black text-dark mb-2" style="font-size:2rem;letter-spacing:4px;">
                                {{ $inscription->token }}
                            </div>
                            <button onclick="copierCode('{{ $inscription->token }}')"
                                    class="btn btn-outline-primary btn-sm rounded-pill px-3" id="btnCopier">
                                <i class="fas fa-copy me-1"></i> Copier le code
                            </button>
                            <p class="text-muted small mt-3 mb-0">
                                Ce code vous permettra de <strong>compléter votre paiement</strong> ultérieurement
                                depuis la page <a href="{{ route('paiement.continuer') }}">Continuer mon paiement</a>.
                            </p>
                        </div>
                    @endif

                    {{-- ===== SOLDE COMPLETEMENT PAYÉ ===== --}}
                    @if($estApprouve && $inscription->estPaye())
                        <div class="alert alert-success border-0 rounded-3 text-center mb-4">
                            <i class="fas fa-check-double me-2"></i>
                            <strong>Formation entièrement soldée !</strong> Votre reçu officiel vous a été envoyé par email.
                        </div>
                    @endif

                    {{-- ===== RÉCAPITULATIF ===== --}}
                    <div class="rounded-3 border overflow-hidden mb-4">
                        <table class="table table-sm mb-0">
                            <tbody>
                                <tr>
                                    <th class="bg-light ps-3 py-3 w-50 text-muted small fw-semibold">Formation</th>
                                    <td class="ps-3 py-3 fw-semibold">{{ $inscription->option->nom ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light ps-3 py-3 text-muted small fw-semibold">
                                        @if($estApprouve) Versement confirmé
                                        @elseif($estEchoue) Versement échoué
                                        @else Versement en attente
                                        @endif
                                    </th>
                                    <td class="ps-3 py-3 fw-bold fs-6
                                        @if($estApprouve) text-success
                                        @elseif($estEchoue) text-danger
                                        @else text-warning
                                        @endif">
                                        {{ number_format($montantVerse, 0, ',', ' ') }} FCFA
                                        @if($estEnAttente)
                                            <span class="badge bg-warning text-dark ms-1 small">En attente</span>
                                        @elseif($estEchoue)
                                            <span class="badge bg-danger ms-1 small">Non débité</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light ps-3 py-3 text-muted small fw-semibold">Total de la formation</th>
                                    <td class="ps-3 py-3">{{ number_format($inscription->montantTotal(), 0, ',', ' ') }} FCFA</td>
                                </tr>
                                @if($estApprouve && !$inscription->estPaye())
                                    <tr>
                                        <th class="bg-light ps-3 py-3 text-muted small fw-semibold">Reste à payer</th>
                                        <td class="ps-3 py-3 fw-bold text-danger">
                                            {{ number_format($inscription->resteAPayer(), 0, ',', ' ') }} FCFA
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th class="bg-light ps-3 py-3 text-muted small fw-semibold">Email</th>
                                    <td class="ps-3 py-3">{{ $inscription->email }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light ps-3 py-3 text-muted small fw-semibold">Référence</th>
                                    <td class="ps-3 py-3 font-monospace small">
                                        {{ isset($tranche) ? $tranche->reference : $inscription->reference }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- ===== BOUTONS ===== --}}
                    <div class="d-grid gap-3">
                        @if($estApprouve && $inscription->estPaye())
                            <a href="{{ route('paiement.download.dossier', $inscription->id) }}"
                               class="btn btn-primary rounded-pill py-2 fw-bold">
                                <i class="fas fa-file-pdf me-2"></i> Télécharger le dossier complet
                            </a>
                            <a href="{{ route('paiement.download', $inscription->id) }}"
                               class="btn btn-outline-success rounded-pill py-2 fw-bold">
                                <i class="fas fa-receipt me-2"></i> Télécharger le reçu de paiement
                            </a>
                        @endif

                        @if($estApprouve && !$inscription->estPaye())
                            <a href="{{ route('paiement.continuer.dossier', $inscription->token) }}"
                               class="btn btn-primary rounded-pill py-2 fw-bold">
                                <i class="fas fa-plus-circle me-2"></i> Compléter mon paiement
                            </a>
                        @endif

                        @if($estEchoue || $estEnAttente)
                            <a href="{{ route('frontend.paiement') }}" class="btn btn-danger rounded-pill py-2 fw-bold">
                                <i class="fas fa-redo me-2"></i> Réessayer
                            </a>
                        @endif

                        <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill py-2">
                            <i class="fas fa-home me-2"></i> Retour à l'accueil
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
function copierCode(code) {
    navigator.clipboard.writeText(code).then(function () {
        const btn = document.getElementById('btnCopier');
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copié !';
        btn.classList.replace('btn-outline-primary', 'btn-success');
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-copy me-1"></i> Copier le code';
            btn.classList.replace('btn-success', 'btn-outline-primary');
        }, 2000);
    });
}
</script>
@endsection
