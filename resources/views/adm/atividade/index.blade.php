@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Atividades cadastradas</h1>
</div>
<br>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID Atividade</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Título da questão</th>
                        <th scope="col">Disciplina</th>
                        <th scope="col">Cadastrado por</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                        <th scope="col">PDF</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($atividades as $atividade)
                        <tr>
                            <td style="text-align: center"> {{ $atividade->id }} </td>
                            <td> {{ $atividade->descricao }} </td>
                            <td> {{ $atividade->titulo_atividade }} </td>
                            <td> {{ $atividade->disciplina->nome }} </td>
                            <td> {{ $atividade->cad_usuario->name }} </td>
                            <td> {{ $atividade->created_at != null && $atividade->created_at != "" ? $atividade->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td> {{ $atividade->updated_at != null && $atividade->updated_at != "" ? $atividade->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td>
                                <a href="{{ route('adm.atividades.atividade_pdf', $atividade->id) }}" class="btn btn-outline-secondary"><i class="fas fa-file-pdf"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('adm.atividades.edit', $atividade->id) }}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $atividade->id }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                        {{-- modal de excluir --}}
                        {{-- <div class="modal fade" id="dangerModal{{ $atividade->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <form action="{{ route('adm.atividades.destroy', $atividade->id) }}" method="POST" id="delete_form">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                            <h5 class="modal-title">Tem certeza que deseja excluir a atividade <strong>{{ $atividade->id }}</strong> ?</b></h5>
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
                        </div> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable-responsive').dataTable({
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
