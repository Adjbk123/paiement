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


<!-- Footer Start -->
<div class="container-fluid bg-dark footer  wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-4">
        <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h1 class="fw-bold text-primary mb-3"> {{$appSetting->website_name?? 'D G F S' }}<!-- G E<span class="text-secondary">S M</span>A C --></h1>
                    <p>{{$appSetting->meta_keywords?? 'Divine Grace Fifame Service' }} </p>
                    <div class="d-flex pt-2">
                        
                 
                        @if ($appSetting->twitter?? 'twitter')
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="{{$appSetting->twitter?? 'twitter'}}" target="_blank"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if ($appSetting->facebook?? 'facebook')
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="{{$appSetting->facebook?? 'facebook'}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if ($appSetting->youtube?? 'youtube')
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="{{$appSetting->youtube?? 'youtube'}}" target="_blank"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if ($appSetting->instagram?? 'instagram')
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href="{{$appSetting->instagram?? 'instagram'}}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Address</h4>
                    <p><i class="fa fa-map-marker-alt me-3"></i>{{$appSetting->address ?? 'TCHAADA' }}</p>
                    <p><i class="fa fa-phone-alt me-3"></i>{{$appSetting->phone1 ?? '01 61 39 20 29' }}</p>
                    <p><i class="fa fa-phone-alt me-3"></i>{{$appSetting->phone2 ?? '01 52 11 84 71' }}</p>
                    <p><i class="fa fa-envelope me-3"></i>{{$appSetting->email1 ?? 'divinegrace@gmail.com' }}</p>
                    
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Liens Rapides</h4>
                    <a class="btn btn-link" href="{{url('/')}}">Acueil</a>
                    <a class="btn btn-link" href="{{url('/collections')}}">Categories</a>
                    <a class="btn btn-link" href="{{url('/new-arrivals')}}">Nouvelle Arrivee</a>
                    <a class="btn btn-link" href="{{url('/featured-products')}}">Caracteristiques</a>
                    <a class="btn btn-link" href="">A-Propos</a>
                    <a class="btn btn-link" href="">Contactez-nous</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Votre email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">{{$appSetting->website_name?? 'D G F S' }}</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed By <a href="https://giorgiogbessaya33@gmail.com">G.Giorgio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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