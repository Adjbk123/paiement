<link href="/frontend/img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 

<!-- Icon Font Stylesheet -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="/frontend/lib/animate/animate.min.css" rel="stylesheet">
<link href="/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="/frontend/css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="/frontend/css/style.css" rel="stylesheet">
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary text-white d-none d-lg-flex">
        <div class="container py-1" style="object-fit: cover;">
            <div class="d-flex align-items-center">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block ">
                    <a href="{{url('/')}}">
                        <h3 class="brand-name "><span class="text-danger">D  </span class="text-light">G F<span class="text-warning">   S</span> </h3>
                    </a>
                </div>
                <div class="ms-auto d-flex align-items-center">
                    <small class="ms-4"><i class="fa fa-map-marker-alt me-3"></i>TCHAADA</small>
                    <small class="ms-4"><i class="fa fa-envelope me-3"></i>divinegrace@gmail.com</small>
                    <small class="ms-4"><i class="fa fa-phone-alt me-3"></i>+229 01 61 39 20 29</small>
                    <div class="ms-3 d-flex">
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href=""><i class="fab fa-whatsapp"></i></a>
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">
                <a href="{{('/')}}" class="navbar-brand d-lg-none">
                <h6 class="text-primary"><i class="fa fa-user-edit me-2"></i><span class="text-danger"> D </span>  <span class="text-success">G F </span> <span class="text-warning"> S</span></h6>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="{{url('/')}}" class="nav-item nav-link active"><i class="fa fa-home"></i> Home</a> 
                        <a class="nav-link" href="{{url('/collections')}}"> <i class="fa fa-list"></i> Categories</a>                      
                        <a class="nav-link" href="{{ url('cart')}}">
                                <i class="fa fa-shopping-cart"></i> Panier (<livewire:frontend.cart.cartcount/>)
                                </a>                   
                        <a href="{{url('/connexion')}}" class="nav-item nav-link"><i  class="fa fa-volume-control-phone"></i> Contactez-Nous</a>
                    </div>
                    @guest
                    @if (Route::has('login'))
                    <div class="ms-auto d-none d-lg-block">                       
                        <a href="{{ route('login') }}" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4"><i class="bi bi-box-arrow-in-right"></i> Connectez-vous</a>
                        @endif

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill text-white py-2 px-4"> <i class="bi bi-box-arrow-in-right"> </i>Inscrivez-Vous</a>
                        @endif
                        @else
                        <ul class="nav justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }} 
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('/profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa fa-list"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="{{url('wishlist')}}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                <li><a class="dropdown-item" href="{{ url('cart')}}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                <li>
                                
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                       <i class="bi bi-box-arrow-in-left "></i> {{ __('Deconneixion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form> 

                                </li>
                                </ul>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
    

    
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
 <!-- JavaScript Libraries -->
    <script src="/frontend/lib/wow/wow.min.js"></script>
    <script src="/frontend/lib/easing/easing.min.js"></script>
    <script src="/frontend/lib/waypoints/waypoints.min.js"></script>
    <script src="/frontend/lib/owlcarousel/owl.carousel.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="/frontend/js/main.js"></script>
    
</body>
</html>