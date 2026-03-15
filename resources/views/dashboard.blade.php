@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')

<section class="content">
<div class="container-fluid">



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
            <div class="card-header bg-success text-white d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">
                    Recap Mensuel
                </h5>
                <form method="GET" class="m-0">
                    <input type="hidden" name="week" value="{{ $week }}">
                    <select name="year" class="form-control form-control-sm border-0 shadow-sm" style="width: 100px;" onchange="this.form.submit()">
                        @for($y = now()->year; $y >= now()->year - 2; $y--)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </form>
            </div>
            <div class="card-body">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    {{-- 7 JOURS --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">
                    Semaine {{ $week }}
                </h5>
                <form method="GET" class="m-0">
                    <input type="hidden" name="year" value="{{ $year }}">
                    <select name="week" class="form-control form-control-sm border-0 shadow-sm" style="width: 120px;" onchange="this.form.submit()">
                        @for($w = 1; $w <= 53; $w++)
                            <option value="{{ $w }}" {{ $week == $w ? 'selected' : '' }}>
                                Sem. {{ $w }}
                            </option>
                        @endfor
                    </select>
                </form>
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
        type: 'pie',
        data: {
            labels: @json($dailyLabels),
            datasets: [{
                data: @json($dailySales),
                backgroundColor: [
                    '#007bff','#dc3545','#ffc107',
                    '#28a745','#6f42c1','#fd7e14','#20c997'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });

});

</script>
@endpush
