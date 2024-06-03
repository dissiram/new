@extends('home')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{ $data['titre'] }}</h1>
                    <h5 class="display-6 text-white animated slideInDown">{{ $data->nbSessions() }} chapitre(s)</h5>
                    <nav aria-label="bredcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('cours') }}">Cours</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{ $data['titre'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">D&eacute;couvrir notre formation sur</h6>
                <h1 class="mb-2">{{ $data['titre'] }}</h1>
            </div>
            <div class="row g-3 text-center" style="font-size: 22px">
                <p class="mb-5">
                    {!! $data['description'] !!}
                </p>
            </div>



            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Contenu de la formation</h6>
                <h3 class="mb-5">Chapitres</h3>
            </div>
            <div class="row g-4 justify-content-center fadeInUp wow" data-wow-delay="0.3s">
                @forelse ($data->sessions as $chapitre)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light">

                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-3 text-primary">{{ $chapitre['titre'] }}</h3>
                                <p class="mb-3">{{ Str::substr($chapitre['sous-titre'], 0, 50) }} ...</p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-file text-primary me-2"></i>{{ count($chapitre['ressources']) }}
                                    ressource(s)</small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-clock text-primary me-2"></i>{{ $chapitre->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <P class="text-center">
                        Pas de chaiptres enregistrer...
                    </P>
                @endforelse
            </div>
        </div>
    </div>
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container  text-center">
            <div class="row g-5">
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <a class="btn btn-primary py-3 px-5 mt-2" href="{{ route('souscrire', ['id' => $data['id']]) }}">Souscrire &agrave; cette formation</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
