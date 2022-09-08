@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

{{-- <div class="header">
    <h1 class="mt-4">Tópicos</h1>
</div> --}}

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Questões cadastradas</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Código questão</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Tópico</th>
                        <th scope="col">Disciplina</th>
                        {{-- <th scope="col">Cadastrado por</th> --}}
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questoes as $questao)
                        <tr>
                            <td>{{ $questao->id }}</td>
                            <td> {{ $questao->codigo_questao }}</td>
                            <td> {{ $questao->descricao }}</td>
                            <td> {{ $questao->topico->descricao }}</td>
                            <td> {{ $questao->disciplina->nome }}</td>
                            <td>
                                <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#updateModal"><i class="fas fa-pen"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal"><i class="fas fa-trash"></i></a>
                            </td>
                            {{-- <td> {{ $questao->cadastradoPorUsuario->name }}</td> --}}
                            <td> {{ $questao->created_at != null && $questao->created_at != "" ? $questao->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td> {{ $questao->updated_at != null && $questao->updated_at != "" ? $questao->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <hr>
    </div>
    <div class="col-12">
        <a href="{{ route('adm.questoes.create') }}" class="btn btn-primary"> Cadastrar questão</a>
    </div>
    <br>

</div>


@endsection
