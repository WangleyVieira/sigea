@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<h1 class="h3 mb-3"><strong>Painel</strong> de Análises</h1>
    {{-- <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col mt-0">
                                            <h5 class="illustration-text">Seja Bem-Vindo ao SIGEA, Sigea!</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 align-self-center text-center">
                                    <img src="https://appstack.bootlab.io/img/illustrations/customer-support.png" alt="Customer Support" class="img-fluid illustration-img">
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
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Atividades ativos</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fas fa-bookmark" style="width: 100%"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"> {{ $atividades }} </h1>
                                <div class="mb-0">
                                    <button class="btn btn-info"><i class="fas fa-info"><a href=""></a></i> Ver detalhes</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <span class="text-muted"><a href="{{ route('usuario.listagem_usuarios') }}" class="btn btn-info">Ver detalhes</a></span>
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
    </div> --}}

    <div class="row">
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card illustration flex-fill">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="illustration-text p-3 m-1">
                                <h4 class="illustration-text">Seja Bem-Vindo, {{ auth()->user()->name }}!</h4>
                                <p class="mb-0">Painel Inicial</p>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="https://appstack.bootlab.io/img/illustrations/customer-support.png" alt="Customer Support" class="img-fluid illustration-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $disciplinas }}</h3>
                            <p class="mb-2">Disciplinas cadastradas (ativos)</p>
                            <div class="mb-0">
                                <span class="text-muted"><a href="{{ route('adm.relatorio.relatorio_disciplinas') }}" target="_blank">Ver detalhes</a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fas fa-bookmark" style="width: 100%"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $usuarios }}</h3>
                            <p class="mb-2">Usuários (ativos)</p>
                            <div class="mb-0">
                                <span class="text-muted"><a href="{{ route('usuario.listagem_usuarios') }}">Ver detalhes</a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fas fa-user" style="width: 100%"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $questoes }}</h3>
                            <p class="mb-2">Questões cadastradas (ativos)</p>
                            <div class="mb-0">
                                <span class="text-muted"><a href="{{ route('adm.questoes.index') }}">Ver detalhes</a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fas fa-book" style="width: 100%"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $atividades }}</h3>
                            <p class="mb-2">Atividades cadastradas (ativos)</p>
                            <div class="mb-0">
                                <span class="text-muted"><a href="{{ route('adm.atividades.index') }}">Ver detalhes</a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fas fa-user" style="width: 100%"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $topicos }}</h3>
                            <p class="mb-2">Tópicos cadastradas (ativos)</p>
                            <div class="mb-0">
                                <span class="text-muted"><a href="{{ route('adm.relatorio.relatorio_topicos') }}" target="_blank">Ver detalhes</a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fas fa-tag" style="width: 100%"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            {{-- <h3 class="mb-2">{{ $topicos }}</h3> --}}
                            <p class="mb-2">Relatório geral</p>
                            <div class="mb-0">
                                <span class="text-muted"><a href="{{ route('adm.relatorio.relatorio_geral') }}" target="_blank">Ver detalhes</a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="fas fa-file" style="width: 100%"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

