@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')

<section class="content">
<div class="container-fluid">

{{-- ================= FILTRES ================= --}}
<div class="row mb-3">
    <div class="col-12">
        <form method="GET" class="form-inline">
            <label class="mr-2">Année :</label>
            <select name="year" class="form-control mr-3" onchange="this.form.submit()">
                @for($y = now()->year; $y >= now()->year - 2; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>

            <label class="mr-2">Semaine :</label>
            <select name="week" class="form-control" onchange="this.form.submit()">
                @for($w = 1; $w <= 53; $w++)
                    <option value="{{ $w }}" {{ $week == $w ? 'selected' : '' }}>
                        Semaine {{ $w }}
                    </option>
                @endfor
            </select>
        </form>
    </div>
</div>

{{-- ================= KPI ENSEIGNEMENTS ================= --}}
<div class="row">

    <div class="col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1">
                <i class="fas fa-school"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Maternel</span>
                <span class="info-box-number">{{ number_format($totalMaternel, 0, ',', ' ') }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1">
                <i class="fas fa-book"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Primaire</span>
                <span class="info-box-number">{{ number_format($totalPrimaire, 0, ',', ' ') }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-indigo elevation-1">
                <i class="fas fa-graduation-cap"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Secondaire</span>
                <span class="info-box-number">{{ number_format($totalSecondaire, 0, ',', ' ') }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-orange elevation-1">
                <i class="fas fa-layer-group"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Autre</span>
                <span class="info-box-number">{{ number_format($totalAutre, 0, ',', ' ') }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1">
                <i class="fas fa-check-circle"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Soldés</span>
                <span class="info-box-number">{{ $countSoldes }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1">
                <i class="fas fa-hourglass-half"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Partiels</span>
                <span class="info-box-number">{{ $countPartiels }}</span>
            </div>
        </div>
    </div>

</div>

{{-- ================= GRAPHIQUES ================= --}}
<div class="row">

    {{-- 12 MOIS --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title">
                    Recap Mensuel ({{ $year }})
                </h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    {{-- 7 JOURS --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">
                    Semaine {{ $week }}
                </h5>
            </div>
            <div class="card-body">
                <canvas id="weekChart"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- ================= FOOTER FINANCIER ================= --}}
<div class="row mt-4">

    <div class="col-md-3">
        <div class="description-block border-right">
            <h5 class="description-header text-success">
                {{ number_format($totalRevenu, 0, ',', ' ') }} FCFA
            </h5>
            <span class="description-text">TOTAL REVENUE (SEM. {{ $week }})</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="description-block border-right">
            <h5 class="description-header text-warning">
                {{ number_format($totalPending, 0, ',', ' ') }} FCFA
            </h5>
            <span class="description-text">TOTAL PENDING (SEM. {{ $week }})</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="description-block border-right">
            <h5 class="description-header text-primary">
                {{ number_format($totalApproved, 0, ',', ' ') }} FCFA
            </h5>
            <span class="description-text">TOTAL APPROVED (SEM. {{ $week }})</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="description-block">
            <h5 class="description-header text-danger">
                {{ number_format($totalFailed, 0, ',', ' ') }} FCFA
            </h5>
            <span class="description-text">TOTAL FAILED (SEM. {{ $week }})</span>
        </div>
    </div>

</div>


</div>
</section>

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {

    // GRAPH 12 MOIS
    new Chart(document.getElementById('salesChart'), {
        type: 'bar',
        data: {
            labels: @json($monthlyLabels),
            datasets: [{
                label: 'Montant encaissé (FCFA)',
                data: @json($monthlySales),
                backgroundColor: 'rgba(40,167,69,0.7)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // GRAPH 7 JOURS
    new Chart(document.getElementById('weekChart'), {
        type: 'bar',
        data: {
            labels: @json($dailyLabels),
            datasets: [{
                label: 'Revenu quotidien (FCFA)',
                data: @json($dailySales),
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

});

</script>
@endpush
