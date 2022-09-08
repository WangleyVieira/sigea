@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

{{-- <div class="header">
    <h1 class="mt-4">Tópicos</h1>
</div> --}}

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Listagem de Questões</h1>
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
                        {{-- <th scope="col">Atividade</th> --}}
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td> {{ $usuario->name }}</td>
                            <td> {{ $usuario->email }}</td>
                            <td> {{ $usuario->perfil->descricao }}</td>
                            <td> {{ $usuario->created_at != null && $usuario->created_at != "" ? $usuario->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td> {{ $usuario->updated_at != null && $usuario->updated_at != "" ? $usuario->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="col-12">
        <a href="{{ route('adm.questoes.create') }}" class="btn btn-primary"> Cadastrar questão</a>
    </div>
    <br>

</div>


@endsection
