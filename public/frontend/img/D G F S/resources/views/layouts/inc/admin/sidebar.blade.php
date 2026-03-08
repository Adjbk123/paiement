<section>
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>A B I F A</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="images/faces/6.png" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{url('admin/dashboard')}}" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{ url('admin/orders')}}" class="nav-item nav-link ">
                    <i class="fa fa-table me-2"></i>
                      Commandes
                    </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i> Categories</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ url('admin/category/create')}}" class="dropdown-item">Ajouter Categories</a>
                            <a href="{{ url('admin/category')}}" class="dropdown-item">Voir Categories</a>
                        </div>
                    </div>
                    <a href="{{ url('admin/brand')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Marques</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> Produites</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ url('admin/products/create')}}" class="dropdown-item">Ajouter Productes</a>
                            <a href="{{ url('admin/products')}}" class="dropdown-item">Voir Produites</a>
                        </div>
                    </div>

                    <a href="{{ url('admin/sliders')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Home </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> Utilisateurs</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ url('admin/users/create')}}" class="dropdown-item">Ajouter Utilisateurs</a>
                            <a href="{{ url('admin/users')}}" class="dropdown-item">Voir Utilisateurs</a>
                        </div>
                    </div>
                    <a href="{{ url('admin/settings')}}" class="nav-item nav-link">
                    <i class="fa fa-cog me-2"></i>
                      Parametres
                    </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


</section>









