@extends('admin.base')

@section('title')
    Mes Formations
@endsection

@section('page_title')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $data['titre'] }}</h3>
                <p class="text-subtitle text-muted">
                    Poursuivez votre apprentissage et obtenez votre certifications. De nouvelles aventures vous attendent.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('mes_cours') }}">Mes cours</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data['titre'] }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="page-content">
        <!-- Basic card section start -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Description de la formation</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <p class="card-text">
                                    {!! $data['description'] !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $data['titre'] }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Formateur : </label>
                                        </div>
                                        <div class="col-md-8 form-group mb-3">
                                            <label for="">{{ $data->proprio->name }}</label>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="email-horizontal">Nombre de Chapitre : </label>
                                        </div>
                                        <div class="col-md-8 form-group mb-3">
                                            <label for="">{{ $data->nbSessions() }}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Prix de la formation : </label>
                                        </div>
                                        <div class="col-md-8 form-group mb-3">
                                            <label for="">
                                                <span class="fw-bold title h4 bg-primary badge">
                                                    {{ $data['tarif'] == 0 ? 'Gratuit' : intval($data['tarif']).' F CFA'}}
                                                </span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Terminer la formation</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary">
                                            Terminer la formation
                                        </button>
                                    </div>

                                    <div class="col-6">
                                        <button class="btn btn-primary">
                                            Passer l'examen
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-7 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Chapitres</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($data->sessions as $session)
                                        <div class="col-md-6 col-lg-4 col-sm-12">
                                            <div class="card">
                                                <h4 class="card-title">
                                                    <a href="{{ route('chapitre', ['cour' => $data['titre'], 'id' => $session['id']]) }}">
                                                        {{ $session['titre'] }}</a>
                                                </h4>
                                                <p class="card-text text-justify">
                                                    {{ $session['sous-titre'] }}
                                                </p>
                                                <small
                                                    class="text-muted">{{ $session['created_at']->diffForHumans() }}.</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
