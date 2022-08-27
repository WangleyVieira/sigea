@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<div class="header">
    <h1 class="mt-4">Disciplinas cadastradas</h1>
</div>

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
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $d->id }}""><i class="fas fa-trash"></i></a>
                            </td>
                            <td>
                                <a href="" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                            </td>
                        </tr>

                        {{-- modal de delete --}}
                        <div class="modal fade" id="dangerModal{{ $d->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <form action="" method="POST" id="delete_form">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
