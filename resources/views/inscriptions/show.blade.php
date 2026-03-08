{{-- resources/views/admin/inscriptions/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Détails de l’inscription')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📋 Détails de l’inscription</h4>
        </div>

        <div class="card-body">

            <h5>Informations générales</h5>
            <p><strong>Nom :</strong> {{ $inscription->nom }} {{ $inscription->prenoms }}</p>
            <p><strong>Email :</strong> {{ $inscription->email }}</p>
            <p><strong>Phone :</strong> {{ $inscription->phone }}</p>
            <p><strong>Option :</strong> {{ optional($inscription->option)->nom }}</p>
            <p><strong>Montant total :</strong> {{ number_format($inscription->option->option_montant ?? 0, 0, ',', ' ') }} FCFA</p>
            <p><strong>Total payé :</strong> {{ number_format($inscription->totalPaye(), 0, ',', ' ') }} FCFA</p>
            <p><strong>Reste à payer :</strong> {{ number_format($inscription->resteAPayer(), 0, ',', ' ') }} FCFA</p>

            <hr>

            <h5>Historique des tranches</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Montant tranche</th>
                        <th>Status</th>
                        <th>Transaction ID</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscription->tranches as $tranche)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ number_format($tranche->montant_tranche, 0, ',', ' ') }} FCFA</td>
                            <td>
                                @if($tranche->status == 'approved')
                                    <span class="badge badge-success">Payé</span>
                                @elseif($tranche->status == 'pending')
                                    <span class="badge badge-warning">En attente</span>
                                @else
                                    <span class="badge badge-danger">Échec</span>
                                @endif
                            </td>
                            <td>{{ $tranche->transaction_id }}</td>
                            <td>{{ $tranche->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune tranche payée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
