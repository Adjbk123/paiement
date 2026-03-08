<link href="/frontend/img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="/frontend/lib/animate/animate.min.css" rel="stylesheet">
<link href="/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="/frontend/css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="/frontend/css/style.css" rel="stylesheet">


<!-- FOOTER START -->
<footer class="container-fluid bg-dark text-light pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-5">

            <!-- LOGO + DESCRIPTION -->
            <div class="col-lg-4 col-md-6">
                <h2 class="text-white mb-3">
                    <span class="text-primary">{{ $parametres?->website_name ?? 'MAFLYT SARL' }}</span>
                </h2>
                <p class="mb-4" style="opacity: 0.8;">
                    {{ $parametres?->meta_description ?? 'Entreprise spécialisée en formation informatique et vente d’ordinateurs de qualité.' }}
                </p>

                <div class="d-flex gap-2">
                    @if($parametres?->facebook)
                        <a class="btn btn-outline-light btn-social" href="{{ $parametres->facebook }}" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif

                    @if($parametres?->twitter)
                        <a class="btn btn-outline-light btn-social" href="{{ $parametres->twitter }}" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif

                    @if($parametres?->whatsapp)
                        <a class="btn btn-outline-light btn-social" href="{{ $parametres->whatsapp }}" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif

                    @if($parametres?->youtube)
                        <a class="btn btn-outline-light btn-social" href="{{ $parametres->youtube }}" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- CONTACT -->
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white mb-4 border-bottom pb-2">Contact</h4>

                <p><i class="fa fa-map-marker-alt me-3 text-primary"></i>{{ $parametres?->address ?? 'Adresse non définie' }}</p>

                <p>
                    <i class="fa fa-phone-alt me-3 text-primary"></i>
                    <a href="tel:{{ $parametres?->phone1 ?? '' }}" class="text-light">
                        {{ $parametres?->phone1 ?? 'Téléphone non défini' }}
                    </a>
                </p>

                <p>
                    <i class="fa fa-envelope me-3 text-primary"></i>
                    <a href="mailto:{{ $parametres?->email1 ?? '' }}" class="text-light">
                        {{ $parametres?->email1 ?? 'Email non défini' }}
                    </a>
                </p>
            </div>

            <!-- LIENS RAPIDES -->
            <div class="col-lg-4 col-md-12">
                <h4 class="text-white mb-4 border-bottom pb-2">Navigation</h4>
                <div class="row">
                    <div class="col-6">
                        <a class="btn btn-link text-light ps-0" href="{{ url('/') }}">Accueil</a>
                        <a class="btn btn-link text-light ps-0" href="#">Services</a>
                        <a class="btn btn-link text-light ps-0" href="#">Contact</a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-link text-light ps-0" href="#">Formations</a>
                        <a class="btn btn-link text-light ps-0" href="#">Vente PC</a>
                        <a class="btn btn-link text-light ps-0" href="#">Support</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- COPYRIGHT BAR -->
    <div class="container-fluid bg-black text-center text-light py-3 mt-5" style="font-size: 14px;">
        &copy; {{ date('Y') }}
        <strong>{{ $parametres?->website_name ?? 'MAFLYT' }}</strong> — Tous droits réservés.
    </div>
</footer>
<!-- FOOTER END -->


    <!-- Copyright End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- Footer End -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
 <!-- JavaScript Libraries -->
    <script src="/frontend/lib/wow/wow.min.js"></script>
    <script src="/frontend/lib/easing/easing.min.js"></script>
    <script src="/frontend/lib/waypoints/waypoints.min.js"></script>
    <script src="/frontend/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/frontend/js/main.js"></script>
