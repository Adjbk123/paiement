@php
    // Si le controller n'a pas passé $parametres, on le charge ici
    $parametres = $parametres ?? \App\Models\Parametre::first();
    $logo       = $parametres?->photo ? asset('uploads/' . $parametres->photo) : asset('uploads/default.png');
    $siteName   = $parametres?->website_name ?? 'MAFLYT SARL';
@endphp

<!-- ===== Topbar ===== -->
<div class="container-fluid bg-primary text-white d-none d-lg-block">
    <div class="container py-2 d-flex align-items-center">

        <!-- Coordonnées -->
        <div class="d-flex align-items-center me-auto gap-4">
            <small>
                <i class="fa fa-map-marker-alt me-1"></i>
                {{ $parametres->address ?? 'Adresse par défaut' }}
            </small>
            <small>
                <i class="fa fa-envelope me-1"></i>
                <a href="mailto:{{ $parametres->email1 ?? '' }}" class="text-white text-decoration-none">
                    {{ $parametres->email1 ?? 'Email' }}
                </a>
            </small>
            <small>
                <i class="fa fa-phone-alt me-1"></i>
                <a href="tel:{{ $parametres->phone1 ?? '' }}" class="text-white text-decoration-none">
                    {{ $parametres->phone1 ?? 'Téléphone' }}
                </a>
            </small>
        </div>

        <!-- Réseaux sociaux -->
        <div class="d-flex gap-2">
            @if(!empty($parametres->whatsapp))
                <a class="btn btn-sm-square btn-light text-primary rounded-circle"
                   href="{{ $parametres->whatsapp }}" target="_blank" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            @endif
            @if(!empty($parametres->facebook))
                <a class="btn btn-sm-square btn-light text-primary rounded-circle"
                   href="{{ $parametres->facebook }}" target="_blank" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            @endif
            @if(!empty($parametres->twitter))
                <a class="btn btn-sm-square btn-light text-primary rounded-circle"
                   href="{{ $parametres->twitter }}" target="_blank" title="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            @endif
            @if(!empty($parametres->youtube))
                <a class="btn btn-sm-square btn-light text-primary rounded-circle"
                   href="{{ $parametres->youtube }}" target="_blank" title="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            @endif
        </div>
    </div>
</div>
<!-- ===== Topbar End ===== -->

<!-- ===== Navbar ===== -->
<div class="container-fluid bg-white sticky-top shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light p-0">

            <!-- Brand : logo + nom -->
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center py-3 py-lg-0 me-4">
                <img src="{{ $logo }}" alt="Logo {{ $siteName }}"
                     style="height:48px;width:48px;border-radius:50%;object-fit:cover;"
                     class="me-2 border border-2 border-primary">
                <span class="fw-bold text-dark lh-sm d-none d-sm-block" style="font-size:1.05rem;">
                    {{ $siteName }}
                </span>
            </a>

            <!-- Bouton mobile -->
            <button type="button" class="navbar-toggler border-0 me-0"
                    data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">

                <!-- Liens de navigation (centrés) -->
                <div class="navbar-nav mx-auto">
                    <a href="{{ url('/') }}"
                       class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fa fa-home me-1"></i> Accueil
                    </a>
                    <a href="{{ route('about') }}"
                       class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                        À Propos
                    </a>
                    <a href="{{ route('service') }}"
                       class="nav-item nav-link {{ request()->routeIs('service') ? 'active' : '' }}">
                        Services
                    </a>
                </div>

                <!-- Bouton CTA -->
                <div class="py-2 py-lg-0">
                    <a href="{{ route('frontend.paiement') }}"
                       class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                        <i class="fa fa-pen me-2"></i> S'inscrire
                    </a>
                </div>

            </div>
        </nav>
    </div>
</div>
<!-- ===== Navbar End ===== -->
