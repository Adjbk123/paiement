{{--
    Utilisation :
    @include('layouts.inc.frontend.breadcrumb', [
        'pageTitle'   => 'À Propos',
        'breadcrumbs' => [
            ['label' => 'À Propos', 'url' => null],
        ]
    ])
--}}

<div class="page-header wow fadeIn" data-wow-delay="0.1s"
     style="
        background: linear-gradient(rgba(28, 32, 53, 0.78), rgba(28, 32, 53, 0.78)),
                    url('{{ asset('frontend/img/car5.jpeg') }}') center center / cover no-repeat;
        padding: 4rem 0;
        margin-bottom: 2.5rem;
     ">
    <div class="container text-center py-2">

        <!-- Titre de la page -->
        <h1 class="display-5 text-white fw-bold mb-3 animated slideInDown">
            {{ $pageTitle ?? 'Page' }}
        </h1>

        <!-- Fil d'Ariane -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none">
                        <i class="fa fa-home me-1"></i> Accueil
                    </a>
                </li>
                @foreach ($breadcrumbs ?? [] as $crumb)
                    @if ($crumb['url'])
                        <li class="breadcrumb-item">
                            <a href="{{ $crumb['url'] }}" class="text-white text-decoration-none">
                                {{ $crumb['label'] }}
                            </a>
                        </li>
                    @else
                        <li class="breadcrumb-item active fw-semibold text-primary-emphasis" aria-current="page">
                            {{ $crumb['label'] }}
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>

    </div>
</div>
