<aside class="main-sidebar sidebar-dark-primary elevation-4">

    @php
        $logo = $parametres?->photo ? asset('uploads/' . $parametres->photo) : asset('uploads/default.png');
        $siteName = $parametres?->website_name ?? 'MAFLYT';
    @endphp

    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ $logo }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.8">
        <span class="brand-text font-weight-light">{{ $siteName }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-modern" data-widget="treeview" role="menu">

                <!-- Accueil -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ setMenuClass('home', 'active') }}">
                        <i class="nav-icon fas fa-home"></i>
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
                                    <i class="fas fa-chart-line nav-icon"></i>
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
                                    <i class="fas fa-clipboard nav-icon text-info"></i>
                                    <p>Inscriptions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrateur.gestparametres.parametres.index') }}"
                                    class="nav-link {{ setMenuClass('administrateur.gestparametres.', 'active') }}">
                                    <i class="fas fa-cogs nav-icon"></i>
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
                                    <i class="fas fa-image nav-icon text-warning"></i>
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
