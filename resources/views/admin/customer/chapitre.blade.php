@extends('admin.base')

@section('title')
    {{ $data['titre'] }}
@endsection

@section('page_title')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $data->formation['titre'] }}</h3>
                {{-- <p class="text-subtitle text-muted">
                    {!! Str::substr($data->formation['description'], 0, 30) !!}
                </p> --}}
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
                            <h3 class="card-title">{{ $data['titre'] }}</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <p class="card-text title h3">
                                    {{ $data['sous-titre'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row match-height">
                <div class="col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <p class="card-text">
                                    {!! nl2br($data['contenu']) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ressources du chapitre</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach ($data['ressources'] as $file)
                                        <div class="col-6 text-center  mb-5">
                                            <a href="{{ Storage::url($file) }}">
                                                <div class="me-3 mb-1">
                                                    <i class="bi bi-download text-primary" style="font-size: 28px"></i>
                                                </div>
                                                <h>{{ Str::substr($file, 11)}}</h3>
                                            </a>
                                        </div>
                                        @php
                                            $n++;
                                        @endphp
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
