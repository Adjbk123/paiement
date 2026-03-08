@extends('layouts.admin')
@section('title', 'Page Administrateur')

@section('content')

<div class="admin-bg d-flex align-items-center position-relative overflow-hidden">

    <!-- Particules -->
    <div id="particles"></div>

    <div class="container py-5 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card admin-card shadow-lg border-0">
                    <div class="card-body text-center p-">

                        <h1 class="welcome-title mb-3">
                             Bienvenue,
                            <span class="text-primary">{{ userFullName() }}</span>
                        </h1>

                        <h6 class="text-muted mb-3">Vos rôles</h6>

                        <div class="mb-4 d-flex flex-wrap justify-content-center role-container">

                            @foreach(auth()->user()->roles as $role)
                                @php
                                    switch($role->nom) {
                                        case 'administrateur': $badgeColor = 'danger'; break;
                                        case 'employer': $badgeColor = 'primary'; break;
                                        case 'comptable': $badgeColor = 'success'; break;
                                        case 'manager': $badgeColor = 'info'; break;
                                        default: $badgeColor = 'secondary';
                                    }
                                @endphp

                                <span class="role-chip bg-{{ $badgeColor }}">
                                    {{ ucfirst($role->nom) }}
                                </span>

                            @endforeach

                        </div>

                        <p class="fs-5 text-soft">
                            Cette plateforme vous permet de gérer facilement vos inscriptions et vos paiements.
                        </p>

                        <hr class="my-4">

                        <p class="text-soft">
                            Suivez vos formations, consultez vos documents et gérez vos données personnelles depuis votre espace sécurisé.
                        </p>

                        <a href="{{ url('/') }}" class="btn btn-primary btn-modern mt-3">
                             Accéder à mon espace
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

<style>

/* Background */
.admin-bg {
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    min-height: 100vh;
}

/* Carte */
.admin-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    transition: 0.3s ease;
}

.admin-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

/* Titre */
.welcome-title {
    font-weight: 700;
}

/* Container roles */
.role-container {
    gap: 12px;
}

/* Chip premium */
.role-chip {
    padding: 10px 22px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    letter-spacing: 0.5px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.role-chip:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}

/* Couleurs */
.bg-danger { background: linear-gradient(135deg, #dc3545, #ff6b6b); }
.bg-primary { background: linear-gradient(135deg, #0d6efd, #5a9bff); }
.bg-success { background: linear-gradient(135deg, #198754, #4cd98b); }
.bg-info { background: linear-gradient(135deg, #0dcaf0, #6fe7ff); }
.bg-secondary { background: linear-gradient(135deg, #6c757d, #9ea7ad); }

/* Bouton */
.btn-modern {
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-modern:hover {
    transform: scale(1.05);
}

/* Texte */
.text-soft {
    color: #6c757d;
}

/* Particules */
#particles {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 6px;
    height: 6px;
    background: white;
    opacity: 0.8;
    border-radius: 50%;
    animation: fall linear infinite;
}

@keyframes fall {
    to {
        transform: translateY(100vh);
    }
}

</style>

<script>
function createParticle() {
    const particle = document.createElement("div");
    particle.classList.add("particle");

    particle.style.left = Math.random() * window.innerWidth + "px";
    particle.style.animationDuration = (Math.random() * 5 + 4) + "s";

    document.getElementById("particles").appendChild(particle);

    setTimeout(() => {
        particle.remove();
    }, 9000);
}

setInterval(createParticle, 250);
</script>
