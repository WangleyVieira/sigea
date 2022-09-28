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
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Código questão</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Título da questão</th>
                        <th scope="col">Tópico</th>
                        <th scope="col">Disciplina</th>
                        <th scope="col">Cadastrado por</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questoes as $questao)
                        <tr>
                            <td>{{ $questao->id }}</td>
                            <td> {{ $questao->codigo_questao }}</td>
                            <td> {{ $questao->descricao }}</td>
                            <td> {{ $questao->topico->descricao }}</td>
                            <td> {{ $questao->titulo_questao }}</td>
                            <td> {{ $questao->disciplina->nome }}</td>
                            <td> {{ isset($questao->cadastradoPorUsuario) ? $questao->cad_usuario->name : 'nativo do sistema' }} </td>
                            <td> {{ $questao->created_at != null && $questao->created_at != "" ? $questao->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td> {{ $questao->updated_at != null && $questao->updated_at != "" ? $questao->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td>
                                <a href="{{route('adm.questoes.edit', $questao->id)}}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $questao->id }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                        {{-- modal de excluir --}}
                        <div class="modal fade" id="dangerModal{{ $questao->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <form action="{{ route('adm.questoes.destroy', $questao->id) }}" method="POST" id="delete_form">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                            <h5 class="modal-title">Tem certeza que deseja excluir a questão?</b></h5>
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
    <hr>
    </div>
    <div class="col-12">
        <a href="{{ route('adm.questoes.create') }}" class="btn btn-primary"> Cadastrar questão</a>
    </div>
    <br>

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
