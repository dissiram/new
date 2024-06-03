@extends('admin.base')

@section('title')
    Mes Formations
@endsection

@section('page_title')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mes cours</h3>
                <p class="text-subtitle text-muted">
                    Poursuivez votre apprentissage et obtenez votre certifications. De nouvelles aventures vous attendent.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mes cours</li>
                    </ol>
                </nav>
            </div>
        </div>
        @if (Session()->has('success'))
            <p class="text-success text-center h2">{{Session()->get('success')}}</p>
        @endif
    </div>
@endsection

@section('content')
    <div class="page-content">
        <!-- Basic card section start -->
        <section id="content-types">
            <div class="row">

                @forelse ($data as $cour)
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $cour['titre'] }}</h4>
                                    
                                </div>
                                <img class="img-fluid w-100" src="{{ asset('assets/compiled/png/form.png') }}"
                                    alt="capture de formation">
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <span>{{ $cour->proprio['name'] }}</span>
                                <a href="{{ route('detail', ['id' => $cour['id']]) }}" class="btn btn-light-primary">Voir la formation</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center h2 mb-5">Vous n'avez souscrit &agrave; aucune formation. </p>
                @endforelse

            </div>
        </section>
    </div>
@endsection
