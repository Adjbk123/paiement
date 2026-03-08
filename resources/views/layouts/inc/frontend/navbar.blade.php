@php
    $logo = $parametres?->photo ? asset('uploads/' . $parametres->photo) : asset('uploads/default.png');
    $siteName = $parametres?->website_name ?? 'MAFLYT SARL';
@endphp

<div class="container-fluid bg-primary text-white d-none d-lg-flex">
    <div class="container py-1 d-flex align-items-center">
        <a href="{{ url('/') }}">
            <img src="{{  $logo }}"
                class="img-fluid" alt="Logo"
                style="height: 70px; width: 70px; border-radius: 50%; object-fit: cover;">
        </a>
        <div class="ms-auto d-flex align-items-center">
            <small class="ms-4">
                <i class="fa fa-map-marker-alt me-2"></i>
                {{ $parametres->address ?? 'Adresse par défaut' }}
            </small>
            <small class="ms-4">
                <i class="fa fa-envelope me-2"></i>
                <a href="mailto:{{ $parametres->email1 ?? '' }}" class="text-white footer-link">
                    {{ $parametres->email1 ?? 'Email par défaut' }}
                </a>
            </small>
            <small class="ms-4">
                <i class="fa fa-phone-alt me-2"></i>
                <a href="tel:{{ $parametres->phone1 ?? '' }}" class="text-white footer-link">
                    {{ $parametres->phone1 ?? 'Téléphone par défaut' }}
                </a>
            </small>
            <div class="ms-3 d-flex">
                @if(!empty($parametres->whatsapp))
                    <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2"
                       href="{{ $parametres->whatsapp }}" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                @endif

                @if(!empty($parametres->facebook))
                    <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2"
                       href="{{ $parametres->facebook }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif

                @if(!empty($parametres->twitter))
                    <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2"
                       href="{{ $parametres->twitter }}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                @endif

                @if(!empty($parametres->youtube))
                    <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2"
                       href="{{ $parametres->youtube }}" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid bg-white sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">

            <!-- Logo mobile -->
            <a href="{{ url('/') }}" class="navbar-brand d-lg-none">
                <img src="{{ $logo }}" style="height:40px;width:40px;border-radius:50%;object-fit:cover;">
            </a>

            <!-- Bouton menu mobile -->
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">

                <!-- Liens principaux -->
                <div class="navbar-nav me-auto">
                    <a href="{{ url('/') }}" class="nav-item nav-link active">
                        <i class="fa fa-home"></i> Accueil
                    </a>
                   

                <a href="{{ route('about') }}"
                    class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">A-Propos</a>

                <a href="{{ route('service') }}"
                    class="nav-item nav-link {{ request()->routeIs('service') ? 'active' : '' }}">Services</a>

                </div>


            </div>
        </nav>
    </div>
</div>
