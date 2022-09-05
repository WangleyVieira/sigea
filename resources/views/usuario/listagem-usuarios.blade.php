@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<div class="header">
    <h1 class="mt-4">Usuários ativos</h1>
</div>

@include('errors.alerts')
@include('errors.errors')

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive">
                <thead>
                    <tr>
                        {{-- <th scope="col">ID</th> --}}
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            {{-- <td>{{ $usuario->id }}</td> --}}
                            <td> {{ $usuario->name }}</td>
                            <td> {{ $usuario->email }}</td>
                            <td> {{ $usuario->perfil->descricao }}</td>
                            <td> {{ $usuario->created_at != null && $usuario->created_at != "" ? $usuario->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td> {{ $usuario->updated_at != null && $usuario->updated_at != "" ? $usuario->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12">
        <a href="{{ route('dashboard') }}" class="btn btn-info"> Voltar ao Dashboard</a>
    </div>
    <br>

</div>

@yield('scripts')
@endsection
