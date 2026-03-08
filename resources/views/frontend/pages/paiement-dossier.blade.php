@extends('layouts.app')
@section('title', 'Mon dossier — ' . $inscription->token)

@section('content')

@include('layouts.inc.frontend.breadcrumb', [
    'pageTitle'   => 'Mon dossier de paiement',
    'breadcrumbs' => [
        ['label' => 'Continuer', 'url' => route('paiement.continuer')],
        ['label' => $inscription->token, 'url' => null],
    ]
])

<div class="container py-4 mb-5">
    <div class="row justify-content-center g-4">

        {{-- ===== Colonne gauche : Résumé du dossier ===== --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    {{-- Identité --}}
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center justify-content-center bg-primary rounded-circle flex-shrink-0"
                             style="width:55px;height:55px;">
                            <i class="fas fa-user-graduate text-white fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $inscription->prenoms }} {{ $inscription->nom }}</h5>
                            <small class="text-muted">{{ $inscription->email }}</small>
                        </div>
                    </div>

                    {{-- Formation --}}
                    <div class="p-3 rounded-3 mb-3" style="background:#f8f9ff;">
                        <small class="text-muted d-block mb-1">Formation</small>
                        <strong class="text-dark">{{ $inscription->option->nom ?? 'N/A' }}</strong>
                    </div>

                    {{-- Progression de paiement --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted">Progression du paiement</small>
                            <small class="fw-bold text-primary">
                                @php $pct = $inscription->montantTotal() > 0
                                    ? round($inscription->totalPaye() / $inscription->montantTotal() * 100)
                                    : 0; @endphp
                                {{ $pct }}%
                            </small>
                        </div>
                        <div class="progress rounded-pill" style="height:10px;">
                            <div class="progress-bar bg-primary rounded-pill" style="width:{{ $pct }}%;"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-success fw-semibold">
                                Payé : {{ number_format($inscription->totalPaye(), 0, ',', ' ') }} FCFA
                            </small>
                            <small class="text-danger fw-semibold">
                                Reste : {{ number_format($inscription->resteAPayer(), 0, ',', ' ') }} FCFA
                            </small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-top border-bottom">
                        <span class="text-muted small">Total formation</span>
                        <span class="fw-bold">{{ number_format($inscription->montantTotal(), 0, ',', ' ') }} FCFA</span>
                    </div>

                    {{-- Historique des tranches --}}
                    @if($inscription->tranches->isNotEmpty())
                        <div class="mt-4">
                            <small class="text-muted fw-semibold text-uppercase d-block mb-2" style="letter-spacing:.5px;">
                                Historique des versements
                            </small>
                            @foreach($inscription->tranches->sortByDesc('created_at') as $tranche)
                                <div class="d-flex align-items-center justify-content-between py-2 border-bottom gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($tranche->status === 'approved')
                                            <i class="fas fa-check-circle text-success"></i>
                                        @elseif($tranche->status === 'failed')
                                            <i class="fas fa-times-circle text-danger"></i>
                                        @else
                                            <i class="fas fa-clock text-warning"></i>
                                        @endif
                                        <small class="text-muted">{{ $tranche->created_at->format('d/m/Y à H:i') }}</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold @if($tranche->status === 'approved') text-success @else text-muted @endif">
                                            {{ number_format($tranche->montant_tranche, 0, ',', ' ') }} FCFA
                                        </span>
                                        @if($tranche->status === 'approved')
                                            <a href="{{ route('paiement.tranche.download', $tranche->id) }}"
                                               class="btn btn-outline-success btn-sm rounded-pill px-2 py-0"
                                               title="Télécharger ce reçu">
                                                <i class="fas fa-download" style="font-size:.75rem;"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Code de suivi --}}
                    <div class="mt-4 p-3 rounded-3 text-center bg-light">
                        <small class="text-muted d-block mb-1">Code de suivi</small>
                        <strong class="text-primary" style="letter-spacing:3px;font-size:1.1rem;">
                            {{ $inscription->token }}
                        </strong>
                    </div>

                    {{-- Télécharger dossier global --}}
                    <div class="mt-3 text-center">
                        <a href="{{ route('paiement.download.dossier', $inscription->id) }}"
                           class="btn btn-outline-primary btn-sm rounded-pill px-4">
                            <i class="fas fa-file-pdf me-1"></i> Télécharger le dossier complet (PDF)
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== Colonne droite : Formulaire de paiement ===== --}}
        <div class="col-lg-5">

            @if($inscription->estPaye())
                {{-- Dossier soldé --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success rounded-circle mb-3"
                             style="width:70px;height:70px;">
                            <i class="fas fa-check-double text-white" style="font-size:1.8rem;"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Dossier entièrement soldé</h5>
                        <p class="text-muted">Félicitations ! Vous avez réglé la totalité des frais de formation.</p>
                        <div class="d-grid gap-3">
                            <a href="{{ route('paiement.download.dossier', $inscription->id) }}"
                               class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                <i class="fas fa-file-pdf me-2"></i> Télécharger le dossier complet
                            </a>
                            <a href="{{ route('paiement.download', $inscription->id) }}"
                               class="btn btn-outline-success rounded-pill px-4 py-2 fw-bold">
                                <i class="fas fa-receipt me-2"></i> Télécharger le reçu de paiement
                            </a>
                        </div>
                    </div>
                </div>
            @else
                {{-- Formulaire versement --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom p-4">
                        <h6 class="fw-bold mb-0">
                            <i class="fas fa-credit-card me-2 text-primary"></i> Effectuer un versement
                        </h6>
                    </div>
                    <div class="card-body p-4">

                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3 mb-3 small">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('paiement.continuer.process', $inscription->token) }}">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-muted small text-uppercase">
                                    Montant à verser maintenant (FCFA)
                                    <span class="text-danger">*</span>
                                </label>

                                {{-- Suggestion : payer le solde complet --}}
                                <div class="d-flex gap-2 mb-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill"
                                            onclick="setMontant({{ (int) $inscription->resteAPayer() }})">
                                        Tout solder ({{ number_format($inscription->resteAPayer(), 0, ',', ' ') }} FCFA)
                                    </button>
                                </div>

                                <input type="number" name="montant" id="montant_continuer"
                                    class="form-control form-control-lg bg-light border-0 rounded-3 fw-bold text-center fs-5 @error('montant') is-invalid @enderror"
                                    value="{{ old('montant', (int) $inscription->resteAPayer()) }}"
                                    min="1"
                                    max="{{ (int) $inscription->resteAPayer() }}"
                                    required>
                                <div class="form-text text-center mt-2">
                                    Maximum : <strong>{{ number_format($inscription->resteAPayer(), 0, ',', ' ') }} FCFA</strong>
                                </div>
                                @error('montant')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                                <i class="fas fa-credit-card me-2"></i> Payer maintenant
                            </button>

                            <p class="text-center text-muted small mt-3 mb-0">
                                <i class="fas fa-lock me-1"></i> Paiement sécurisé via FedaPay
                            </p>
                        </form>

                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
function setMontant(val) {
    document.getElementById('montant_continuer').value = val;
}
</script>
@endsection
