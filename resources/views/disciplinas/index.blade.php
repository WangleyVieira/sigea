@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<div class="header">
    <h1 class="mt-4">Disciplinas cadastradas</h1>
</div>

@include('errors.alerts')
@include('errors.errors')

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Período</th>
                        <th scope="col">Código</th>
                        <th scope="col">Gerar questão</th>
                        <th scope="col">Cadastrar Tópico</th>
                        <th scope="col">Deletar</th>
                        <th scope="col">Alterar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disciplinas as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td> {{ $d->nome }}</td>
                            <td> {{ $d->periodo->descricao}}</td>
                            <td> {{ $d->codigo }}</td>
                            <td>
                                <a href="" class="btn btn-outline-primary"><i class="fas fa-file"></i></a>
                            </td>
                            <td>
                                <a href="" class="btn btn-outline-secondary"><i class="fas fa-tag"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $d->id }}"><i class="fas fa-trash"></i></a>
                            </td>
                            <td>
                                <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#updateModal{{ $d->id }}"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>

                        {{-- modal de delete --}}
                        <div class="modal fade" id="dangerModal{{ $d->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <form action="{{ route('adm.disciplinas.destroy', $d->id) }}" method="POST" id="delete_form">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                            <h5 class="modal-title">Tem certeza que deseja excluir disciplina <b>{{ $d->nome }}</b>?</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="motivo" class="form-label">Motivo</label>
                                                    <input type="text" class="form-control" name="motivo" id="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        {{-- modal de alterar --}}
                        <div class="modal fade" id="updateModal{{ $d->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('adm.disciplinas.update', $d->id) }}" method="POST" id="delete_form">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-header" style="background-color: rgb(241, 187, 125)">
                                            <h5 class="modal-title">Alterar disciplina</b>?</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="disciplina">Disciplina</label>
                                                    <input type="text" name="disciplina" id="disciplina" class="form-control" value="{{ $d->nome}}" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="codigo">Código</label>
                                                    <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $d->codigo}}" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="id_periodo">Selecione o período</label>
                                                    <select class="form-control mb-3" name="id_periodo">
                                                        <option value="" selected disabled> -- selecione -- </option>
                                                        @foreach ($periodos as $p)
                                                            {{-- <option value="{{ $d->id }}"
                                                                @if ($p->id == $p->descricao)
                                                                selected
                                                                @endif>
                                                               {{ $p->descricao}}
                                                            </option> --}}

                                                            <option value="{{ $p->id }}" {{ $p->id == $d->id_periodo ? 'selected' : '' }}>
                                                               {{ $p->descricao}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                            <button type="submit" class="btn btn-warning">Alterar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary"><a href=""></a> Cadastrar</button>
    </div>
    <br>

</div>

@endsection
