@extends('layouts.admin')
@section('title', 'Liste des Inscriptions')

@section('content')
<div class="container-fluid">

    {{-- ===== KPI STATUTS ===== --}}
    <div class="row g-3 mb-3">
        @php
            $kpis = [
                ['label' => 'Total inscriptions', 'value' => $inscriptions->total(),       'icon' => 'fa-users',         'color' => '#1d6ef5', 'bg' => 'rgba(29,110,245,0.12)'],
                ['label' => 'Soldés',             'value' => $stats['approved'] ?? 0,      'icon' => 'fa-check-double',  'color' => '#28a745', 'bg' => 'rgba(40,167,69,0.12)'],
                ['label' => 'Partiellement payés','value' => $stats['partiel']  ?? 0,      'icon' => 'fa-spinner',       'color' => '#17a2b8', 'bg' => 'rgba(23,162,184,0.12)'],
                ['label' => 'En attente',         'value' => $stats['pending']  ?? 0,      'icon' => 'fa-hourglass-half','color' => '#ffc107', 'bg' => 'rgba(255,193,7,0.12)'],
                ['label' => 'Échoués',            'value' => $stats['failed']   ?? 0,      'icon' => 'fa-times-circle',  'color' => '#dc3545', 'bg' => 'rgba(220,53,69,0.12)'],
            ];
        @endphp
        @foreach($kpis as $kpi)
        <div class="col-6 col-md">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center p-3" style="gap:12px;">
                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3"
                         style="width:46px;height:46px;background:{{ $kpi['bg'] }};">
                        <i class="fas {{ $kpi['icon'] }}" style="color:{{ $kpi['color'] }};font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div class="fw-bold" style="font-size:1.2rem;line-height:1.2;">{{ $kpi['value'] }}</div>
                        <div class="text-muted" style="font-size:.78rem;">{{ $kpi['label'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ===== KPI ENSEIGNEMENT ===== --}}
    @if($statsEnseignement->isNotEmpty())
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-3" style="gap:8px;">
                        <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                             style="width:34px;height:34px;background:rgba(29,110,245,0.12);">
                            <i class="fas fa-chalkboard-teacher" style="color:#1d6ef5;font-size:.95rem;"></i>
                        </div>
                        <span class="fw-bold" style="font-size:.9rem;">Répartition par enseignement</span>
                    </div>
                    <div class="row g-2">
                        @php $totalAll = $statsEnseignement->sum('total'); @endphp
                        @foreach($statsEnseignement as $ens)
                        @php $pctEns = $totalAll > 0 ? round($ens['total'] / $totalAll * 100) : 0; @endphp
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="p-2 rounded-2" style="background:#f8f9fa;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="fw-semibold text-truncate" style="max-width:120px;" title="{{ $ens['nom'] }}">
                                        {{ $ens['nom'] }}
                                    </small>
                                    <span class="badge" style="background:#1d6ef5;color:#fff;font-size:.7rem;">{{ $ens['total'] }}</span>
                                </div>
                                <div class="progress rounded-pill" style="height:5px;">
                                    <div class="progress-bar rounded-pill" style="width:{{ $pctEns }}%;background:#1d6ef5;"></div>
                                </div>
                                <small class="text-muted" style="font-size:.7rem;">{{ $pctEns }}% du total</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== CARD PRINCIPALE ===== --}}
    <div class="card border-0 shadow-sm rounded-3">

        <div class="card-header bg-white border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2 py-3">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-clipboard-list text-primary me-2"></i> Inscriptions
            </h5>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('administrateur.gestinscriptions.inscriptions.export.pdf', request()->all()) }}"
                   class="btn btn-sm btn-danger rounded-pill px-4">
                    <i class="fas fa-file-pdf me-2"></i> PDF
                </a>
                <a href="{{ route('administrateur.gestinscriptions.inscriptions.export.excel', request()->all()) }}"
                   class="btn btn-sm btn-success rounded-pill px-4">
                    <i class="fas fa-file-excel me-2"></i> Excel
                </a>
                <button type="button" class="btn btn-sm btn-warning rounded-pill px-4" id="deleteSelectedBtn">
                    <i class="fas fa-trash me-2"></i> Supprimer sélectionnées
                </button>
            </div>
        </div>

        <div class="card-body p-3">

            {{-- ===== FILTRES ===== --}}
            <form method="GET" action="{{ route('administrateur.gestinscriptions.inscriptions.index') }}">
                <div class="row g-2 mb-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control form-control-sm bg-light border-0 rounded-3"
                               placeholder="Nom, prénom, email, tél, token…" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select form-select-sm bg-light border-0 rounded-3">
                            <option value="">Tous les statuts</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Soldé</option>
                            <option value="partiel"  {{ request('status') == 'partiel'  ? 'selected' : '' }}>Partiel</option>
                            <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>En attente</option>
                            <option value="failed"   {{ request('status') == 'failed'   ? 'selected' : '' }}>Échec</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="option" class="form-select form-select-sm bg-light border-0 rounded-3">
                            <option value="">Toutes les formations</option>
                            @foreach ($options as $opt)
                                <option value="{{ $opt->id }}" {{ request('option') == $opt->id ? 'selected' : '' }}>{{ $opt->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="enseignement" class="form-select form-select-sm bg-light border-0 rounded-3">
                            <option value="">Tout enseignement</option>
                            @foreach ($enseignements as $ens)
                                <option value="{{ $ens->id }}" {{ request('enseignement') == $ens->id ? 'selected' : '' }}>{{ $ens->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" name="date_paiement" class="form-control form-control-sm bg-light border-0 rounded-3"
                               value="{{ request('date_paiement') }}">
                    </div>
                    <div class="col-md-1 d-flex gap-1">
                        <button class="btn btn-sm btn-primary rounded-3 flex-grow-1" title="Filtrer">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('administrateur.gestinscriptions.inscriptions.index') }}"
                           class="btn btn-sm btn-secondary rounded-3 flex-grow-1" title="Réinitialiser">
                            <i class="fas fa-rotate-right"></i>
                        </a>
                    </div>
                </div>
            </form>

            {{-- ===== TABLEAU ===== --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size:.88rem;">
                    <thead class="table-light">
                        <tr>
                            <th style="width:36px;"><input type="checkbox" id="selectAll" class="form-check-input"></th>
                            <th>#</th>
                            <th>Bénéficiaire</th>
                            <th>Formation</th>
                            <th>Paiement</th>
                            <th>Progression</th>
                            <th>Statut</th>
                            <th>Token</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inscriptions as $inscription)
                        @php
                            $total = $inscription->montantTotal();
                            $paye  = $inscription->totalPaye();
                            $pct   = $total > 0 ? round($paye / $total * 100) : 0;
                        @endphp
                        <tr>
                            <td><input type="checkbox" class="form-check-input selectItem" value="{{ $inscription->id }}"></td>
                            <td class="text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-semibold">{{ $inscription->nom }} {{ $inscription->prenoms }}</div>
                                <div class="text-muted small">{{ $inscription->email }}</div>
                                <div class="text-muted small"><i class="fas fa-phone fa-xs me-1"></i>{{ $inscription->phone ?? '—' }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ optional($inscription->option)->nom ?? '—' }}</div>
                                <div class="text-muted small">
                                    {{ optional($inscription->enseignement)->nom == 'Autre'
                                        ? ($inscription->autre_enseignement ?? 'Autre')
                                        : (optional($inscription->enseignement)->nom ?? '—') }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-success">{{ number_format($paye, 0, ',', ' ') }} FCFA</div>
                                <div class="text-muted small">/ {{ number_format($total, 0, ',', ' ') }} FCFA</div>
                                @if(!$inscription->estPaye())
                                    <div class="text-danger small">reste {{ number_format($inscription->resteAPayer(), 0, ',', ' ') }}</div>
                                @endif
                            </td>
                            <td style="min-width:90px;">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="progress flex-grow-1 rounded-pill" style="height:6px;">
                                        <div class="progress-bar
                                            @if($pct == 100) bg-success
                                            @elseif($pct > 0) bg-info
                                            @else bg-secondary @endif
                                            rounded-pill" style="width:{{ $pct }}%;"></div>
                                    </div>
                                    <small class="fw-bold" style="min-width:30px;font-size:.75rem;">{{ $pct }}%</small>
                                </div>
                            </td>
                            <td>
                                @if($inscription->status === 'approved')
                                    <span class="badge bg-success"><i class="fas fa-check-double me-2"></i> Soldé</span>
                                @elseif($inscription->status === 'partiel')
                                    <span class="badge bg-info text-dark"><i class="fas fa-spinner me-2"></i> Partiel</span>
                                @elseif($inscription->status === 'pending')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-2"></i> En attente</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times me-2"></i> Échec</span>
                                @endif
                            </td>
                            <td>
                                @if($inscription->token)
                                    <code class="small text-primary">{{ $inscription->token }}</code>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td class="text-muted small text-nowrap">
                                {{ $inscription->created_at->format('d/m/Y') }}<br>
                                {{ $inscription->created_at->format('H:i') }}
                            </td>
                            <td class="text-center text-nowrap">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('administrateur.gestinscriptions.inscriptions.show', $inscription->id) }}"
                                       class="btn btn-sm btn-primary rounded-2 px-3" title="Détail">
                                        <i class="fas fa-eye me-1"></i> Voir
                                    </a>
                                    @if($inscription->token)
                                        <a href="{{ route('paiement.download.dossier', $inscription->id) }}"
                                           target="_blank" class="btn btn-sm btn-info rounded-2 px-3" title="Dossier PDF complet">
                                            <i class="fas fa-file-pdf me-1"></i> Dossier
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Aucune inscription trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">{{ $inscriptions->appends(request()->query())->links() }}</div>

        </div>
    </div>
</div>

{{-- Formulaires DELETE cachés --}}
<form id="deleteSelectedForm" action="{{ route('administrateur.gestinscriptions.inscriptions.destroySelected') }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
    <div id="selectedIdsContainer"></div>
</form>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Select all
document.getElementById('selectAll').addEventListener('change', function () {
    document.querySelectorAll('.selectItem').forEach(cb => cb.checked = this.checked);
});

// Supprimer sélectionnées
document.getElementById('deleteSelectedBtn').addEventListener('click', function () {
    const selected = Array.from(document.querySelectorAll('.selectItem:checked')).map(cb => cb.value);
    if (selected.length === 0) {
        Swal.fire('Attention', 'Veuillez sélectionner au moins une inscription.', 'warning');
        return;
    }
    Swal.fire({
        title: `Supprimer ${selected.length} inscription(s) ?`,
        text: "Cette action est irréversible.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then(result => {
        if (result.isConfirmed) {
            const container = document.getElementById('selectedIdsContainer');
            container.innerHTML = '';
            selected.forEach(id => {
                const input = document.createElement('input');
                input.type  = 'hidden';
                input.name  = 'ids[]';
                input.value = id;
                container.appendChild(input);
            });
            document.getElementById('deleteSelectedForm').submit();
        }
    });
});

@if(session('success'))
    Swal.fire({ icon: 'success', title: 'Succès', text: {!! json_encode(session('success')) !!}, timer: 3000, showConfirmButton: false });
@endif
@if(session('error'))
    Swal.fire({ icon: 'error', title: 'Erreur', text: {!! json_encode(session('error')) !!}, timer: 3000, showConfirmButton: false });
@endif
</script>
@endsection
