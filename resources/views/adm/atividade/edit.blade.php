@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .error{
        color:red
    }
    #codigo_questao{
        text-transform: uppercase;
    }
</style>

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Atualização de Atividade</h1>
</div>
<br>
<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{ route('adm.atividades.update', $atividade->id) }}" id="formQuestao" method="POST" class="form_prevent_multiple_submits">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="id_disciplina">Disciplina selecionada</label>
                        <select name="id_disciplina"  id="id_disciplina" class="form-control" disabled>
                            <option value="" selected disabled>-- Selecione a disciplina --</option>
                            @foreach ($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}" {{ $disciplina->id == $atividade->id_disciplina ? 'selected' : '' }}> {{ $disciplina->nome }} - {{ $disciplina->codigo }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="descricao_atividade">Descricao</label>
                        <input type="text" name="descricao_atividade" id="descricao_atividade" value="{{ $atividade->descricao }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="titulo_atividade">Titulo</label>
                        <input type="text" name="titulo_atividade" id="titulo_atividade" class="form-control" value="{{ $atividade->titulo_atividade }}">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label">*Questões</label>
                        <select name="id_questao[]" id="id_questao" class="form-control select2" multiple>
                            @foreach ($questoesArray as $qt)
                                <option value="{{ $qt->id }}"> {{ $qt->descricao }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <input type="submit" class="btn btn-success" name="Salvar" value="Salvar">
                        <a href="{{ route('adm.atividades.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
                <br>
                <hr>
            </form>
            <span>Listagem de questões relacionados à atividade <strong>{{ $atividade->titulo_atividade }}</strong></span>
            <br>
            <br>
            <div class="row">
                <div class="form-group col-md-12">
                    <table class="table table-striped" id="datatable-responsive">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th scope="col">ID Questão</th> --}}
                                <th scope="col">Descrição</th>
                                <th scope="col">Título da questão</th>
                                <th scope="col">Cadastrado por</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($atividadeQuestoes as $atvQuestao)
                                <tr>
                                    {{-- <td style="text-align: center"> {{ $atvQuestao->id }} </td> --}}
                                    <td> {{ $atvQuestao->lista_questoes->descricao }} </td>
                                    <td> {{ $atvQuestao->lista_questoes->titulo_questao }} </td>
                                    <td> {{ $atvQuestao->lista_questoes->cad_usuario->name }} </td>
                                    <td>
                                        <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $atvQuestao->id }}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                                {{-- modal de excluir --}}
                                <div class="modal fade" id="dangerModal{{ $atvQuestao->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('adm.atividade_questao.destroy', $atvQuestao->id) }}" method="POST" id="delete_form">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                                    <h5 class="modal-title">Tem certeza que deseja excluir a questão <strong>{{$atvQuestao->lista_questoes->titulo_questao }}</strong> ?</b></h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    <input type="hidden" name="id_questao" value="{{$atvQuestao->lista_questoes->id}}">
                                                </div>
                                                {{-- <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="motivo" class="form-label">Motivo</label>
                                                            <input type="text" class="form-control" name="motivo" id="">
                                                        </div>
                                                    </div>
                                                </div> --}}
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

<script src="{{asset('../js/jquery.validate.js')}}"></script>

<script>

    $("#formQuestao").validate({
        rules: {
            descricao_atividade:{
                required:true,
                maxlength:255,
            },
            titulo_atividade:{
                required:true,
                maxlength:255,
            },
            id_questao:{
                required:true,
                maxlength:255,
            },
        },

        messages: {
            descricao_atividade:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
            titulo_atividade:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
            id_questao:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
        }
    });


    $(document).ready(function() {

        $('.select2').select2({
            language: {
                noResults: function() {
                    return "Nenhum resultado encontrado";
                }
            },
            closeOnSelect: true,
            width: '100%',
        });

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

