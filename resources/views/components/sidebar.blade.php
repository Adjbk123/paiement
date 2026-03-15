<style>
    /* Premium Sidebar Styling */
    .main-sidebar {
        background: #112236 !important; /* Bleu très foncé élégant */
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1) !important;
    }

    .brand-link {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        padding: 1.2rem 0.5rem !important;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .brand-link:hover {
        background: rgba(255,255,255,0.02);
    }

    .brand-link .brand-text {
        font-weight: 700 !important;
        letter-spacing: 0.5px;
        color: #fff !important;
    }

    .nav-sidebar .nav-item {
        margin-bottom: 4px;
    }

    .nav-sidebar .nav-link {
        border-radius: 10px !important;
        margin: 0 10px;
        color: #a0aec0 !important;
        transition: all 0.3s ease;
        padding: 10px 15px;
        display: flex;
        align-items: center;
    }

    .nav-sidebar .nav-link p {
        margin-left: 8px;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .nav-sidebar .nav-link i.nav-icon {
        font-size: 1.1rem;
        width: 25px;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* Hover State */
    .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.05) !important;
        color: #fff !important;
        transform: translateX(3px);
    }
    
    .nav-sidebar .nav-link:hover i.nav-icon {
        color: #457b9d !important;
    }

    /* Active State (Dégradé Premium) */
    .nav-sidebar .nav-item.menu-open > .nav-link,
    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, #1d3557, #457b9d) !important;
        box-shadow: 0 4px 10px rgba(29, 53, 87, 0.4) !important;
        color: #fff !important;
        font-weight: 600 !important;
    }

    .nav-sidebar .nav-link.active i.nav-icon {
        color: #fff !important;
    }

    /* Treeview (Sous-menus) */
    .nav-treeview {
        padding-left: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        position: relative;
    }
    
    .nav-treeview::before {
        content: '';
        position: absolute;
        left: 22px;
        top: 0;
        bottom: 10px;
        width: 1px;
        background: rgba(255,255,255,0.1);
    }

    .nav-treeview .nav-item .nav-link {
        margin: 2px 10px 2px 20px;
        padding: 8px 15px;
        font-size: 0.9rem;
        border-radius: 8px !important;
    }

    .nav-treeview .nav-item .nav-link i.nav-icon {
        font-size: 0.9rem;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    @php
        $logo = $parametres?->photo ? asset('uploads/' . $parametres->photo) : asset('uploads/default.png');
        $siteName = $parametres?->website_name ?? 'MAFLYT';
    @endphp

    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ $logo }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.9">
        <span class="brand-text font-weight-light">{{ $siteName }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-modern" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Accueil -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ setMenuClass('home', 'active') }}">
                        <i class="nav-icon fas fa-home text-white-50"></i>
                        <p>Accueil</p>
                    </a>
                </li>

                <!-- Administration -->
                @can('administrateur')
                    <li class="nav-item has-treeview {{ setMenuClass('administrateur.', 'menu-open') }}">
                        <a href="#" class="nav-link {{ setMenuClass('administrateur.', 'active') }}"
                            aria-expanded="{{ setMenuClass('administrateur.', 'true') }}">
                            <i class="nav-icon fas fa-user-shield text-info"></i>
                            <p>Administration <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('administrateur.dashboard') }}"
                                    class="nav-link {{ setMenuClass('administrateur.dashboard', 'active') }}">
                                    <i class="fas fa-chart-pie nav-icon"></i>
                                    <p>Tableau de bord</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrateur.gestutilisateurs.users.index') }}"
                                    class="nav-link {{ setMenuClass('administrateur.gestutilisateurs.', 'active') }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Utilisateurs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrateur.gestinscriptions.inscriptions.index') }}"
                                    class="nav-link {{ setMenuClass('administrateur.gestinscriptions.', 'active') }}">
                                    <i class="fas fa-clipboard-list nav-icon text-info"></i>
                                    <p>Inscriptions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrateur.gestparametres.parametres.index') }}"
                                    class="nav-link {{ setMenuClass('administrateur.gestparametres.', 'active') }}">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Paramètres</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <!-- Employer -->
                @can('employer')
                    <li class="nav-item has-treeview {{ setMenuClass('employer.', 'menu-open') }}">
                        <a href="#" class="nav-link {{ setMenuClass('employer.', 'active') }}">
                            <i class="nav-icon fas fa-user-tie text-warning"></i>
                            <p>Gestion RH <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">

                            <!-- Options -->
                            <li class="nav-item">
                                <a href="{{ route('employer.gestoptions.options.index') }}"
                                    class="nav-link {{ setMenuClass('employer.gestoptions.', 'active') }}">
                                    <i class="fas fa-file-signature nav-icon"></i>
                                    <p>Options</p>
                                </a>
                            </li>

                            <!-- À propos -->
                            <li class="nav-item">
                                <a href="{{ route('employer.gestabouts.abouts.index') }}"
                                    class="nav-link {{ setMenuClass('employer.gestabouts.', 'active') }}">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>À propos</p>
                                </a>
                            </li>

                            <!-- Services -->
                            <li class="nav-item">
                                <a href="{{ route('employer.gestservices.services.index') }}"
                                    class="nav-link {{ setMenuClass('employer.gestservices.', 'active') }}">
                                    <i class="fas fa-briefcase nav-icon"></i>
                                    <p>Services</p>
                                </a>
                            </li>

                            <!-- Galeries -->
                            <li class="nav-item">
                                <a href="{{ route('employer.gestgaleries.galeries.index') }}"
                                    class="nav-link {{ setMenuClass('manager.gestgaleries.galeries.index', 'active') }}">
                                    <i class="fas fa-images nav-icon text-warning"></i>
                                    <p>Galeries</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan

            </ul>
        </nav>
    </div>
</aside>
