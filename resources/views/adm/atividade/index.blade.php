@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<div class="header">
    <h1 class="mt-4">Atividades cadastradas</h1>
</div>

@include('errors.alerts')
@include('errors.errors')

<div class="card">
    <div class="card-body">

    </div>
    {{-- <div class="col-12">
        <a href="{{ route('adm.disciplinas.create') }}" class="btn btn-primary"> Cadastrar</a>
    </div>
    <br> --}}

</div>

@endsection
