@extends('layouts.admin')

@section('title', 'Liste des Inscriptions')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-clipboard-list"></i> Liste des Inscriptions</h4>
        </div>

        <div class="card-body">

            {{-- ================= FILTRES ================= --}}
            <form method="GET" action="{{ route('administrateur.gestinscriptions.inscriptions.index') }}" class="mb-4">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label>Recherche</label>
                        <input type="text" name="search" class="form-control" placeholder="Nom, Prénom, Email ou Téléphone" value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Enseignement</label>
                        <select name="enseignement" class="form-control">
                            <option value="">-- Tous --</option>
                            @foreach ($enseignements as $ens)
                                <option value="{{ $ens->id }}" {{ request('enseignement') == $ens->id ? 'selected' : '' }}>
                                    {{ $ens->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>CS du service</label>
                        <select name="circonscription" class="form-control">
                            <option value="">-- Toutes --</option>
                            @foreach ($circonscriptions as $c)
                                <option value="{{ $c->id }}" {{ request('circonscription') == $c->id ? 'selected' : '' }}>
                                    {{ $c->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>CS de Formation</label>
                        <select name="formation" class="form-control">
                            <option value="">-- Toutes --</option>
                            @foreach ($formations as $f)
                                <option value="{{ $f->id }}" {{ request('formation') == $f->id ? 'selected' : '' }}>
                                    {{ $f->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Option</label>
                        <select name="option" class="form-control">
                            <option value="">-- Toutes --</option>
                            @foreach ($options as $option)
                                <option value="{{ $option->id }}" {{ request('option') == $option->id ? 'selected' : '' }}>
                                    {{ $option->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Commune</label>
                        <select name="region" class="form-control">
                            <option value="">-- Toutes --</option>
                            @foreach ($regions as $r)
                                <option value="{{ $r->id }}" {{ request('region') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Jour de paiement</label>
                        <input type="date" name="date_paiement" class="form-control" value="{{ request('date_paiement') }}">
                    </div>

                    <div class="col-md-12 mt-3 d-flex justify-content-end gap-2">
                        <button class="btn btn-primary"><i class="fas fa-search"></i> Filtrer</button>

                        <a href="{{ route('administrateur.gestinscriptions.inscriptions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-rotate-right"></i> Réinitialiser
                        </a>

                        <a href="{{ route('administrateur.gestinscriptions.inscriptions.export.pdf', request()->all()) }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>

                        <a href="{{ route('administrateur.gestinscriptions.inscriptions.export.excel', request()->all()) }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>

                    </div>

                    {{-- Boutons supprimer --}}
                    <div class="col-md-12 mt-3 d-flex justify-content-end gap-2">
                        

                        <button type="button" class="btn btn-warning" id="deleteSelectedBtn">
                            <i class="fas fa-trash"></i> Supprimer sélectionnées
                        </button>
                    </div>

                </div>
            </form>

            {{-- ================= TABLEAU ================= --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="thead-dark">
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Contact</th>
                            <th>Enseignement</th>
                            <th>Localisation</th>
                            <th>Formation</th>
                            <th>Option</th>
                            <th>Montant</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($inscriptions as $inscription)
                        <tr>
                            <td><input type="checkbox" class="selectItem" name="ids[]" value="{{ $inscription->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inscription->nom }} {{ $inscription->prenoms }}</td>
                            <td>{{ $inscription->phone ?? '-' }}<br>{{ $inscription->email ?? '-' }}</td>
                            <td>{{ optional($inscription->enseignement)->nom == 'Autre' ? $inscription->autre_enseignement ?? 'Autre' : optional($inscription->enseignement)->nom ?? '-' }}</td>
                            <td>{{ optional($inscription->circonscription)->nom ?? optional($inscription->province)->nom ?? '-' }}</td>
                            <td>{{ optional($inscription->formation)->nom ?? optional($inscription->region)->nom ?? '-' }}</td>
                            <td>{{ optional($inscription->option)->nom ?? '-' }}</td>
                            <td>{{ number_format($inscription->montant,0,',',' ') }} FCFA</td>
                            <td>
                                @if ($inscription->status == 'approved')
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> Payé</span>
                                @elseif ($inscription->status == 'pending')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> En attente</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Échec</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('administrateur.gestinscriptions.inscriptions.show', $inscription->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                @if ($inscription->status == 'approved')
                                <a href="{{ route('administrateur.gestinscriptions.inscriptions.export.single.pdf', $inscription->id) }}" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>
                                @else
                                <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-lock"></i></button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center">Aucune inscription trouvée</td>
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
<form id="deleteAllForm" action="{{ route('administrateur.gestinscriptions.inscriptions.destroyAll') }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<form id="deleteSelectedForm" action="{{ route('administrateur.gestinscriptions.inscriptions.destroySelected') }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="ids[]" id="selectedIds">
</form>

{{-- ================= SWEETALERT ================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.selectItem').forEach(cb => cb.checked = this.checked);
});

document.getElementById('deleteSelectedBtn').addEventListener('click', function() {
    const selected = Array.from(document.querySelectorAll('.selectItem:checked')).map(cb => cb.value);
    if(selected.length === 0){
        Swal.fire('Attention', 'Veuillez sélectionner au moins une inscription.', 'warning');
        return;
    }
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action supprimera définitivement les inscriptions sélectionnées !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('selectedIds').value = selected;
            document.getElementById('deleteSelectedForm').submit();
        }
    });
});

document.getElementById('deleteAllBtn').addEventListener('click', function() {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Cette action supprimera toutes les inscriptions définitivement !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteAllForm').submit();
        }
    });
});
</script>

@endsection
