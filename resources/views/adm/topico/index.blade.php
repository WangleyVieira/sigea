@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

{{-- <div class="header">
    <h1 class="mt-4">Tópicos</h1>
</div> --}}

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Listagem de Tópicos</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Disciplina</th>
                        <th scope="col">Período</th>
                        <th scope="col">Código Disciplina</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                        <th scope="col">Cadastrado por</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disciplinas as $d)
                        @foreach ($d->topicos as $top)
                            <tr>
                                <td>{{ $top->id }}</td>
                                <td> {{ $top->descricao }}</td>
                                <td> {{ $top->disciplina->nome }}</td>
                                <td> {{ $d->periodo->descricao}}</td>
                                <td> {{ $top->disciplina->codigo }}</td>
                                <td>
                                    <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#updateModal{{ $top->id }}"><i class="fas fa-pen"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $top->id }}"><i class="fas fa-trash"></i></a>
                                </td>
                                <td> {{ isset($questao->cadastradoPorUsuario) ? $questao->cad_usuario->name : 'nativo do sistema' }} </td>
                                <td> {{ $top->created_at != null && $top->created_at != "" ? $top->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                                <td> {{ $top->updated_at != null && $top->updated_at != "" ? $top->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                            </tr>

                            <div class="modal fade" id="dangerModal{{ $top->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('adm.topicos.destroy', $top->id) }}" method="POST" id="delete_form">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                                <h5 class="modal-title">Tem certeza que deseja excluir tópico <b>{{ $top->descricao }}</b>?</h5>
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

                            <div class="modal fade" id="updateModal{{ $top->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('adm.topicos.update', $top->id) }}" method="POST" id="alterar_form">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-header" style="background-color: rgb(241, 187, 125)">
                                                <h5 class="modal-title">Alterar Tópico</b>?</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="topico">Tópico</label>
                                                        <input type="text" name="topico" id="topico" class="form-control" value="{{ $top->descricao}}" required>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable-responsive').dataTable({
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "searchable": false,
                    "visible": false
                }
            ],
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ registros por página",
                "sZeroRecords": "Nenhum registro encontrado",
                "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros)",
                "sSearch": "Pesquisar: ",
                "oPaginate": {
                    "sFirst": "Início",
                    "sPrevious": "Anterior",
                    "sNext": "Próximo",
                    "sLast": "Último"
                }
            },
        });
    });
</script>


@endsection
