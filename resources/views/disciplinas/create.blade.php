@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<div class="header">
    <h1 class="mt-4">Cadastrar Disciplina</h1>
</div>

@include('errors.alerts')
@include('errors.errors')

<div class="card">
    <div class="card-body">
       <form action="" method="POST">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-4">
                    <label for="disciplina">Nome disciplina</label>
                    <input type="text" name="disciplina" id="disciplina" class="form-control" required>
                </div>
                <div class="col-4">
                    <label for="codigo">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" required>
                </div>
                <div class="col-4">
                    <label for="id_periodo">Selecione o período</label>
                    <select class="form-control mb-3" name="id_periodo" required>
                        <option value="" selected disabled> -- selecione -- </option>
                        @foreach ($periodos as $p)
                            <option value="{{ $p->id }}"> {{ $p->descricao }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
       </form>
    </div>

    <div class="col-12">
        <button class="btn btn-primary"><a href=""></a> Cadastrar </button>
    </div>
    <br>

</div>

@endsection
