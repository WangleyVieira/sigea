@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<h1 class="h3 mb-3"><strong>Painel</strong> de Análises</h1>
    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Usuários ativos</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fas fa-user" style="width: 100%"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"> {{ $usuarios }} </h1>
                                <div class="mb-0">
                                    {{-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span> --}}
                                    {{-- <span class="text-muted"><a>Ver detalhes</a></span> --}}
                                    <button class="btn btn-info"><i class="fas fa-info"><a href=""></a></i> Ver detalhes</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Questões ativos</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fas fa-book" style="width: 100%"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"> {{ $questoes }} </h1>
                                <div class="mb-0">
                                    {{-- <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span> --}}
                                    <button class="btn btn-info"><i class="fas fa-info"><a href="#"></a></i> Ver detalhes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Disciplinas ativos</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fas fa-bookmark" style="width: 100%"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"> {{ $disciplinas }} </h1>
                                <div class="mb-0">
                                    <button class="btn btn-info"><i class="fas fa-info"><a href="{{ route('adm.disciplinas.index') }}"></a></i> Ver detalhes</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Tópicos ativos</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fas fa-tag" style="width: 100%"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"> {{ $topicos }} </h1>
                                <div class="mb-0">
                                    <button class="btn btn-info"><i class="fas fa-info"><a href=""></a></i> Ver detalhes</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-7">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Recentemente adicionado</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

