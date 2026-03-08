@extends('layouts.admin')
@section('title', 'Détail inscription — ' . $inscription->nom . ' ' . $inscription->prenoms)

@section('content')
<div class="container-fluid">

    {{-- Breadcrumb admin --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="fw-bold mb-0">
                <i class="fas fa-user-circle text-primary me-2"></i>
                {{ $inscription->prenoms }} {{ $inscription->nom }}
            </h5>
            <small class="text-muted">Détail du dossier d'inscription</small>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('administrateur.gestinscriptions.inscriptions.index') }}"
               class="btn btn-sm btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
            @if($inscription->token)
                <a href="{{ route('paiement.download.dossier', $inscription->id) }}"
                   target="_blank" class="btn btn-sm btn-primary rounded-pill px-4">
                    <i class="fas fa-file-pdf me-2"></i> Dossier PDF
                </a>
            @endif
            @if($inscription->status === 'approved')
                <a href="{{ route('administrateur.gestinscriptions.inscriptions.export.single.pdf', $inscription->id) }}"
                   target="_blank" class="btn btn-sm btn-danger rounded-pill px-4">
                    <i class="fas fa-file-pdf me-2"></i> Reçu PDF
                </a>
            @endif
        </div>
    </div>

    @php
        $total = $inscription->montantTotal();
        $paye  = $inscription->totalPaye();
        $reste = $inscription->resteAPayer();
        $pct   = $total > 0 ? round($paye / $total * 100) : 0;
    @endphp

    <div class="row g-4">

        {{-- ===== COLONNE GAUCHE ===== --}}
        <div class="col-lg-4">

            {{-- IDENTITÉ --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center justify-content-center bg-primary rounded-circle flex-shrink-0"
                             style="width:56px;height:56px;">
                            <i class="fas fa-user-graduate text-white fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $inscription->prenoms }} {{ $inscription->nom }}</h6>
                            <small class="text-muted">{{ $inscription->email }}</small>
                        </div>
                    </div>

                    <div class="list-group list-group-flush small">
                        <div class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted"><i class="fas fa-phone me-2"></i> Téléphone</span>
                            <span class="fw-semibold">{{ $inscription->phone ?? '—' }}</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted"><i class="fas fa-chalkboard-teacher me-2"></i> Enseignement</span>
                            <span class="fw-semibold">
                                {{ optional($inscription->enseignement)->nom == 'Autre'
                                    ? ($inscription->autre_enseignement ?? 'Autre')
                                    : (optional($inscription->enseignement)->nom ?? '—') }}
                            </span>
                        </div>
                        @if($inscription->circonscription)
                        <div class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted"><i class="fas fa-map-marker-alt me-2"></i> CS service</span>
                            <span class="fw-semibold">{{ $inscription->circonscription->nom }}</span>
                        </div>
                        @endif
                        @if($inscription->formation)
                        <div class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted"><i class="fas fa-school me-2"></i> CS formation</span>
                            <span class="fw-semibold">{{ $inscription->formation->nom }}</span>
                        </div>
                        @endif
                        @if($inscription->region)
                        <div class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted"><i class="fas fa-city me-2"></i> Commune</span>
                            <span class="fw-semibold">{{ $inscription->region->nom }}</span>
                        </div>
                        @endif
                        <div class="list-group-item px-0 d-flex justify-content-between">
                            <span class="text-muted"><i class="fas fa-calendar me-2"></i> Inscrit le</span>
                            <span class="fw-semibold">{{ $inscription->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOKEN --}}
            @if($inscription->token)
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="background:linear-gradient(135deg,#eef2ff,#f8f9ff);">
                <div class="card-body p-4 text-center">
                    <small class="text-primary fw-bold text-uppercase d-block mb-1" style="letter-spacing:1px;">
                        <i class="fas fa-key me-2"></i> Code de suivi
                    </small>
                    <div class="fw-bold text-dark" style="font-size:1.4rem;letter-spacing:4px;">
                        {{ $inscription->token }}
                    </div>
                </div>
            </div>
            @endif

        </div>

        {{-- ===== COLONNE DROITE ===== --}}
        <div class="col-lg-8">

            {{-- FORMATION + PROGRESSION --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="fas fa-graduation-cap text-primary me-2"></i> Formation
                        </h6>
                        @if($inscription->status === 'approved')
                            <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fas fa-check-double me-2"></i> Soldé</span>
                        @elseif($inscription->status === 'partiel')
                            <span class="badge bg-info text-dark px-3 py-2 rounded-pill"><i class="fas fa-spinner me-2"></i> Partiel</span>
                        @elseif($inscription->status === 'pending')
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="fas fa-hourglass-half me-2"></i> En attente</span>
                        @else
                            <span class="badge bg-danger px-3 py-2 rounded-pill"><i class="fas fa-times me-2"></i> Échec</span>
                        @endif
                    </div>

                    <div class="p-3 rounded-3 mb-4" style="background:#f8f9ff;">
                        <div class="fw-bold text-dark">{{ optional($inscription->option)->nom ?? '—' }}</div>
                        @if($inscription->option?->montant_minimum)
                            <small class="text-muted">Minimum requis : {{ number_format($inscription->option->montant_minimum, 0, ',', ' ') }} FCFA</small>
                        @endif
                    </div>

                    {{-- Progression --}}
                    <div class="mb-2 d-flex justify-content-between">
                        <small class="text-muted">Progression du paiement</small>
                        <small class="fw-bold text-primary">{{ $pct }}%</small>
                    </div>
                    <div class="progress rounded-pill mb-3" style="height:10px;">
                        <div class="progress-bar
                            @if($pct == 100) bg-success
                            @elseif($pct > 0) bg-primary
                            @else bg-secondary @endif
                            rounded-pill" style="width:{{ $pct }}%;"></div>
                    </div>

                    <div class="row g-3">
                        <div class="col-4">
                            <div class="p-3 rounded-3 text-center" style="background:#f0fdf4;">
                                <div class="fw-bold text-success fs-6">{{ number_format($paye, 0, ',', ' ') }}</div>
                                <small class="text-muted">Versé (FCFA)</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-3 text-center bg-light">
                                <div class="fw-bold fs-6">{{ number_format($total, 0, ',', ' ') }}</div>
                                <small class="text-muted">Total (FCFA)</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-3 text-center" style="background:#fff5f5;">
                                <div class="fw-bold text-danger fs-6">{{ number_format($reste, 0, ',', ' ') }}</div>
                                <small class="text-muted">Reste (FCFA)</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- HISTORIQUE TRANCHES --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <h6 class="fw-bold mb-0">
                        <i class="fas fa-history text-primary me-2"></i> Historique des versements
                        <span class="badge bg-light text-dark ms-2">{{ $inscription->tranches->count() }}</span>
                    </h6>
                </div>
                <div class="card-body p-0">
                    @forelse($inscription->tranches->sortByDesc('created_at') as $tranche)
                    <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0
                                @if($tranche->status === 'approved') bg-success
                                @elseif($tranche->status === 'failed') bg-danger
                                @else bg-warning @endif"
                                style="width:36px;height:36px;">
                                @if($tranche->status === 'approved')
                                    <i class="fas fa-check text-white small"></i>
                                @elseif($tranche->status === 'failed')
                                    <i class="fas fa-times text-white small"></i>
                                @else
                                    <i class="fas fa-clock text-white small"></i>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold small">{{ $tranche->created_at->format('d/m/Y à H:i') }}</div>
                                <div class="text-muted" style="font-size:.75rem;font-family:monospace;">{{ $tranche->reference }}</div>
                                @if($tranche->transaction_id)
                                    <div class="text-muted" style="font-size:.7rem;">ID: {{ $tranche->transaction_id }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-end">
                                <div class="fw-bold @if($tranche->status === 'approved') text-success @elseif($tranche->status === 'failed') text-danger @else text-warning @endif">
                                    {{ number_format($tranche->montant_tranche, 0, ',', ' ') }} FCFA
                                </div>
                                <div class="small">
                                    @if($tranche->status === 'approved')
                                        <span class="badge bg-success">Confirmé</span>
                                    @elseif($tranche->status === 'failed')
                                        <span class="badge bg-danger">Échoué</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @endif
                                </div>
                            </div>
                            @if($tranche->status === 'approved')
                                <a href="{{ route('paiement.tranche.download', $tranche->id) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-success rounded-pill px-3" title="Reçu tranche PDF">
                                    <i class="fas fa-download me-1"></i> PDF
                                </a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                        Aucun versement enregistré
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
