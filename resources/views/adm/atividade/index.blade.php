@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

@include('errors.alerts')
@include('errors.errors')

{{-- <div class="header">
    <h1 class="mt-4">Listagem de atividades</h1>
</div>
<br> --}}
<div id="accordion">
    <div class="card">
        <div class="card-header" id="heading">
            <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">
                Minhas Atividades
            </button>
            </h5>
        </div>
        <div id="collapse" class="collapse show" aria-labelledby="heading" data-parent="#accordion">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable-responsive">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Descrição</th>
                                <th scope="col">Título da questão</th>
                                <th scope="col">Disciplina</th>
                                <th scope="col">Cadastrado por</th>
                                <th scope="col">Cadastrado em</th>
                                <th scope="col">Atualizado em</th>
                                <th scope="col">PDF</th>
                                <th scope="col">Respostas</th>
                                <th scope="col">Alterar</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($minhasAtividades as $mA)
                                <tr>
                                    <td> {{ $mA->descricao }} </td>
                                    <td> {{ $mA->titulo_atividade }} </td>
                                    <td> {{ $mA->disciplina->nome }} </td>
                                    <td> {{ $mA->cad_usuario->name }} </td>
                                    <td> {{ $mA->created_at != null && $mA->created_at != "" ? $mA->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                                    <td> {{ $mA->updated_at != null && $mA->updated_at != "" ? $mA->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                                    <td>
                                        <a href="{{ route('adm.atividades.atividade_pdf', $mA->id) }}" class="btn btn-outline-secondary" target="_blank"><i class="fas fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('adm.atividades.gabarito', $mA->id) }}" class="btn btn-outline-info" target="_blank"><i class="fas fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('adm.atividades.edit', $mA->id) }}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $mA->id }}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                                {{-- modal de excluir --}}
                                <div class="modal fade" id="dangerModal{{ $mA->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('adm.atividades.destroy', $mA->id) }}" method="POST" id="delete_form">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                                    <h5 class="modal-title">Tem certeza que deseja excluir a atividade <strong>{{ $mA->titulo_atividade }}</strong> ?</b></h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
    </div>
</div>

<div id="accordion2">
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Atividades cadastradas no sistema
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable-responsive2">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Descrição</th>
                                <th scope="col">Título da questão</th>
                                <th scope="col">Disciplina</th>
                                <th scope="col">Cadastrado por</th>
                                <th scope="col">Cadastrado em</th>
                                <th scope="col">Atualizado em</th>
                                <th scope="col">PDF</th>
                                <th scope="col">Respostas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($atividadesExternas as $atividade)
                                <tr>
                                    <td> {{ $atividade->descricao }} </td>
                                    <td> {{ $atividade->titulo_atividade }} </td>
                                    <td> {{ $atividade->disciplina->nome }} </td>
                                    <td> {{ $atividade->cad_usuario->name }} </td>
                                    <td> {{ $atividade->created_at != null && $atividade->created_at != "" ? $atividade->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                                    <td> {{ $atividade->updated_at != null && $atividade->updated_at != "" ? $atividade->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                                    <td>
                                        <a href="{{ route('adm.atividades.atividade_pdf', $atividade->id) }}" class="btn btn-outline-secondary" target="_blank"><i class="fas fa-file-pdf"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('adm.atividades.gabarito', $atividade->id) }}" class="btn btn-outline-info" target="_blank"><i class="fas fa-file-pdf"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

        $('#datatable-responsive2').dataTable({
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
