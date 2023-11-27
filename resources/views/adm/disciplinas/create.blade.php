@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="header">
    <h1 class="mt-4">Cadastrar Disciplina</h1>
</div>

@include('errors.alerts')
@include('errors.errors')

<div class="card">
    <div class="card-body">
       <form action="{{ route('adm.disciplinas.store') }}" id="form" method="POST" class="form_prevent_multiple_submits">
            @csrf
            @method('POST')
            <div class="row">
                {{-- <div class="form-group col-md-4">
                    <label for="disciplina">Nome disciplina</label>
                    <input type="text" name="disciplina" id="disciplina" class="form-control @error('title') is-invalid @enderror" required>
                </div> --}}

                <div class="form-group col-md-4">
                    <label for="disciplina">Nome disciplina</label>
                    <input type="text" name="nome" id="disciplina" class="form-control @error('nome') is-invalid @enderror">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <label for="title">Post Title</label>

                <input id="title" type="text" class=""> --}}



                <div class="form-group col-md-4">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="id_periodo">Selecione o período</label>
                    <select class="form-control mb-3" name="id_periodo" required>
                        <option value="" selected disabled> -- selecione -- </option>
                        @foreach ($periodos as $p)
                            <option value="{{ $p->id }}"> {{ $p->descricao }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>

       </form>
    </div>
</div>

@endsection
