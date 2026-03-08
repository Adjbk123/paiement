@php
    $parametres = $parametres ?? \App\Models\Parametre::first();
@endphp
<!-- ===== Footer ===== -->
<footer class="container-fluid bg-dark text-light pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">

            <!-- LOGO + DESCRIPTION -->
            <div class="col-lg-4 col-md-6">
                <h3 class="text-white mb-3">
                    <span class="text-primary">{{ $parametres?->website_name ?? 'MAFLYT SARL' }}</span>
                </h3>
                <p class="mb-4" style="opacity:.8;">
                    {{ $parametres?->meta_description ?? 'Entreprise spécialisée en formation informatique et vente d\'ordinateurs de qualité.' }}
                </p>
                <div class="d-flex gap-2">
                    @if($parametres?->facebook)
                        <a class="btn btn-outline-light btn-social rounded-circle" href="{{ $parametres->facebook }}" target="_blank" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if($parametres?->twitter)
                        <a class="btn btn-outline-light btn-social rounded-circle" href="{{ $parametres->twitter }}" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if($parametres?->whatsapp)
                        <a class="btn btn-outline-light btn-social rounded-circle" href="{{ $parametres->whatsapp }}" target="_blank" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                    @if($parametres?->youtube)
                        <a class="btn btn-outline-light btn-social rounded-circle" href="{{ $parametres->youtube }}" target="_blank" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- CONTACT -->
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-4 pb-2 border-bottom border-secondary">Contact</h5>
                <p class="mb-3">
                    <i class="fa fa-map-marker-alt me-3 text-primary"></i>
                    {{ $parametres?->address ?? 'Adresse non définie' }}
                </p>
                <p class="mb-3">
                    <i class="fa fa-phone-alt me-3 text-primary"></i>
                    <a href="tel:{{ $parametres?->phone1 ?? '' }}" class="text-light text-decoration-none">
                        {{ $parametres?->phone1 ?? 'Téléphone non défini' }}
                    </a>
                </p>
                <p class="mb-3">
                    <i class="fa fa-envelope me-3 text-primary"></i>
                    <a href="mailto:{{ $parametres?->email1 ?? '' }}" class="text-light text-decoration-none">
                        {{ $parametres?->email1 ?? 'Email non défini' }}
                    </a>
                </p>
            </div>

            <!-- LIENS RAPIDES -->
            <div class="col-lg-4 col-md-12">
                <h5 class="text-white mb-4 pb-2 border-bottom border-secondary">Navigation</h5>
                <div class="row">
                    <div class="col-6">
                        <a class="btn btn-link text-light ps-0" href="{{ url('/') }}">
                            <i class="fas fa-angle-right me-2 text-primary"></i> Accueil
                        </a>
                        <a class="btn btn-link text-light ps-0" href="{{ route('about') }}">
                            <i class="fas fa-angle-right me-2 text-primary"></i> À Propos
                        </a>
                        <a class="btn btn-link text-light ps-0" href="{{ route('service') }}">
                            <i class="fas fa-angle-right me-2 text-primary"></i> Services
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-link text-light ps-0" href="{{ route('frontend.paiement') }}">
                            <i class="fas fa-angle-right me-2 text-primary"></i> Inscription
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Copyright -->
    <div class="container-fluid bg-black text-center text-secondary py-3 mt-5" style="font-size:14px;">
        &copy; {{ date('Y') }}
        <strong class="text-light">{{ $parametres?->website_name ?? 'MAFLYT' }}</strong>
        — Tous droits réservés.
    </div>
</footer>
<!-- ===== Footer End ===== -->

<!-- Bouton retour en haut -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>
