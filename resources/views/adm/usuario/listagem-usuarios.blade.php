@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

@include('errors.alerts')
@include('errors.errors')

{{-- <div class="header">
    <h1 class="mt-4">Usuários ativos</h1>
</div> --}}

<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Usuários ativos</h3>
        <hr>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td> {{ $usuario->name }}</td>
                            <td> {{ $usuario->email }}</td>
                            <td> {{ $usuario->perfil->descricao }}</td>
                            <td> {{ $usuario->created_at != null && $usuario->created_at != "" ? $usuario->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td> {{ $usuario->updated_at != null && $usuario->updated_at != "" ? $usuario->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td>
                                <a href="{{ route('adm.usuario.edit', $usuario->id) }}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $usuario->id }}"><i class="fas fa-trash"></i></a>
                            </td>

                             {{-- modal de excluir --}}
                             <div class="modal fade" id="dangerModal{{ $usuario->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <form action="{{ route('adm.usuario.destroy', $usuario->id) }}" method="POST" id="delete_form">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                                <h5 class="modal-title">Tem certeza que deseja excluir a usuário <strong>{{ $usuario->name }}</strong> ?</b></h5>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Usuários inativos</h3>
        <hr>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive2">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Perfil</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Data inativado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios_inativos as $ui)
                        <tr>
                            <td> {{ $ui->name }}</td>
                            <td> {{ $ui->email }}</td>
                            <td> {{ $ui->perfil->descricao }}</td>
                            <td> {{ $ui->created_at != null && $ui->created_at != "" ? $ui->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                            <td> {{  date('d/m/Y', strtotime( $ui->dataInativado != "" && $ui->dataInativado != null ? $ui->dataInativado : ' - '))}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <a href="{{ route('adm.index_adm') }}" class="btn btn-info"> Voltar ao Dashboard</a>
        <a href="{{ route('adm.usuario.createUser') }}" class="btn btn-primary"> cadastrar usuário</a>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable-responsive').dataTable({
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "searchable": true, //false
                    "visible": true //false
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

        $('#datatable-responsive2').dataTable({
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "searchable": true, //false
                    "visible": true //false
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
