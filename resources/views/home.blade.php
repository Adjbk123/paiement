@extends('layouts.admin')
@section('title', 'Accueil')

@section('content')

<div class="row">
    <!-- Colonne Principale -->
    <div class="col-lg-12">
        
        <!-- Welcome Banner -->
        <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #0d6efd 0%, #00d4ff 100%);">
            <div class="card-body text-white p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="font-weight-bold mb-3">
                            <i class="fas fa-hand-sparkles mr-2 text-warning"></i> 
                            Bienvenue sur votre espace, {{ userFullName() }} !
                        </h2>
                        <p class="lead mb-0 text-white-50">
                            Gérez vos inscriptions, suivez les paiements et accédez rapidement à toutes les fonctionnalités de la plateforme depuis ce tableau de bord.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-4 mt-md-0">
                        <a href="{{ url('/') }}" class="btn btn-light btn-lg rounded-pill shadow-sm px-4 text-primary font-weight-bold">
                            <i class="fas fa-globe mr-2"></i> Voir le site public
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <!-- Vos Accès et Rôles -->
    <div class="col-lg-6">
        <div class="card card-outline card-primary shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pb-0">
                <h5 class="card-title text-primary font-weight-bold">
                    <i class="fas fa-user-shield mr-2"></i> Vos Accès et Rôles
                </h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">
                    Assurez-vous d'avoir les bonnes autorisations pour effectuer vos opérations courantes. Voici la liste de vos accès actuels :
                </p>

                <div class="d-flex flex-wrap gap-2 mb-4 role-container">
                    @forelse(auth()->user()->roles as $role)
                        @php
                            switch($role->nom) {
                                case 'administrateur': $badgeColor = 'danger'; $icon = 'fa-user-cog'; break;
                                case 'employer': $badgeColor = 'primary'; $icon = 'fa-user-tie'; break;
                                case 'comptable': $badgeColor = 'success'; $icon = 'fa-file-invoice-dollar'; break;
                                case 'manager': $badgeColor = 'info'; $icon = 'fa-user-tie'; break;
                                default: $badgeColor = 'secondary'; $icon = 'fa-user';
                            }
                        @endphp
                        
                        <span class="badge badge-{{ $badgeColor }} px-3 py-2 text-uppercase mb-2 mr-2 elevation-1" style="font-size: 14px;">
                            <i class="fas {{ $icon }} mr-1"></i> {{ $role->nom }}
                        </span>
                    @empty
                        <span class="badge badge-secondary px-3 py-2 text-uppercase mb-2 elevation-1" style="font-size: 14px;">
                            <i class="fas fa-user-times mr-1"></i> Aucun rôle assigné
                        </span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pb-0">
                <h5 class="card-title text-dark font-weight-bold">
                    <i class="fas fa-bolt text-warning mr-2"></i> Actions Rapides
                </h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <p class="text-muted mb-4">
                    Passez directement à la gestion avancée si vous possédez les droits nécessaires.
                </p>

                @if(auth()->user()->hasRole('administrateur'))
                    <a href="{{ route('administrateur.dashboard') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm px-4 mb-3" style="width: 100%; max-width: 300px;">
                        <i class="fas fa-chart-pie mr-2"></i> Dashboard Administration
                    </a>
                @endif
                
                <a href="{{ route('administrateur.gestinscriptions.inscriptions.index') }}" class="btn btn-outline-info btn-lg rounded-pill shadow-sm px-4" style="width: 100%; max-width: 300px;">
                    <i class="fas fa-users mr-2"></i> Voir les inscriptions
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<style>
    /* Légers ajustements AdminLTE Custom */
    .callout {
        border-left-width: 5px;
        padding: 2rem;
    }
    .callout-info {
        border-left-color: #17a2b8 !important;
    }
    .rounded-lg {
        border-radius: 0.5rem !important;
    }
    .rounded-pill {
        border-radius: 50rem !important;
    }
    .btn {
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .badge {
        letter-spacing: 0.5px;
    }
</style>
@endpush
