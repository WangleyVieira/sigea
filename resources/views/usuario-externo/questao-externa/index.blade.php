@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')
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
    <h1 class="mt-4">Questões cadastradas</h1>
</div>
<br>
<div id="accordion">
    <div class="card">
        <div class="card-header" id="heading">
            <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">
                Cadastro de Questão
            </button>
            </h5>
        </div>
        <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('acesso_externo.questoes.store') }}" id="formQuestao" method="POST" class="form_prevent_multiple_submits">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="id_disciplina">Disciplinas</label>
                            <select name="id_disciplina"  id="id_disciplina" class="form-control select2">
                                <option value="" selected disabled>-- Selecione a disciplina --</option>
                                @foreach ($disciplinas as $disciplina)
                                    <option value="{{ $disciplina->id }}">{{ $disciplina->nome }} - {{ $disciplina->codigo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_topico">Selecione o Tópico</label>
                            <select name="id_topico" id="id_topico" class="form-control select2">
                                <option value="" selected disabled>-- Selecione --</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="codigo_questao">Código da Questão (Letras e Números)</label>
                            <input type="text" name="codigo_questao" id="codigo_questao" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="titulo_questao">Título da questão</label>
                            <input type="text" name="titulo_questao" id="titulo_questao" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="resposta">Resposta</label>
                            <input type="text" name="resposta" id="resposta" class="form-control">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-sm-12">
                            <textarea class="form-control" name="descricao" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">
                            <a href="{{ route('acesso_externo.questoes.index_externo') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="accordion3">
    <div class="card">
        <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Minhas questões
                </button>
            </h5>
        </div>
        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable-responsive">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Código questão</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Título da questão</th>
                                <th scope="col">Tópico</th>
                                <th scope="col">Disciplina</th>
                                <th scope="col">Cadastrado por</th>
                                <th scope="col">Cadastrado em</th>
                                <th scope="col">Cadastrado em</th>
                                {{-- <th scope="col">PDF</th> --}}
                                <th scope="col">Alterar</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($minhasQuestoes as $mQ)
                                <tr>
                                    <td> {{ $mQ->codigo_questao }}</td>
                                    <td> {{ $mQ->descricao }}</td>
                                    <td> {{ $mQ->titulo_questao }}</td>
                                    <td> {{ $mQ->topico->descricao }}</td>
                                    <td> {{ $mQ->disciplina->nome }}</td>
                                    <td> {{ isset($mQ->cadastradoPorUsuario) ? $mQ->cad_usuario->name : 'nativo do sistema' }} </td>
                                    <td> {{ $mQ->created_at != null && $mQ->created_at != "" ? $mQ->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                                    <td> {{ $mQ->updated_at != null && $mQ->updated_at != "" ? $mQ->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                                    <td>
                                        <a href="{{ route('acesso_externo.questoes.edit', $mQ->id) }}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $mQ->id }}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                                {{-- modal de excluir --}}
                                <div class="modal fade" id="dangerModal{{ $mQ->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('acesso_externo.questoes.destroy', $mQ->id) }}" method="POST" id="delete_form">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                                    <h5 class="modal-title">Tem certeza que deseja excluir a questão <strong>{{ $mQ->titulo_questao }}</strong> ?</b></h5>
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
    </div>
</div>

<div id="accordion2">
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Questões cadastradas no sistema
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable-responsive2">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Código questão</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Título da questão</th>
                                <th scope="col">Tópico</th>
                                <th scope="col">Disciplina</th>
                                <th scope="col">Cadastrado por</th>
                                <th scope="col">Cadastrado em</th>
                                <th scope="col">Atualizado em</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questoes as $questao)
                                <tr>
                                    <td> {{ $questao->codigo_questao }}</td>
                                    <td> {{ $questao->descricao }}</td>
                                    <td> {{ $questao->titulo_questao }}</td>
                                    <td> {{ $questao->topico->descricao }}</td>
                                    <td> {{ $questao->disciplina->nome }}</td>
                                    <td> {{ isset($questao->cadastradoPorUsuario) ? $questao->cad_usuario->name : 'nativo do sistema' }} </td>
                                    <td> {{ $questao->created_at != null && $questao->created_at != "" ? $questao->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                                    <td> {{ $questao->updated_at != null && $questao->updated_at != "" ? $questao->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                                </tr>
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
            descricao:{
                required:true,
                maxlength:1200,
            },
            codigo_questao:{
                required:true,
                maxlength:255,
            },
            titulo_questao:{
                required:true,
                maxlength:255,
            },
            resposta:{
                required:true,
                maxlength:255,
            },
        },

        messages: {
            descricao:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
            codigo_questao:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
            titulo_questao:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
            respota:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
        }
    });


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

        $('.select2').select2({
            language: {
                noResults: function() {
                    return "Nenhum resultado encontrado";
                }
            },
            closeOnSelect: true,
            width: '100%',
        });

        /*
         realiza a requisicao no controlador questao e realiza
         uma busca dos topicos vinculados a disciplina
        */
        $('#id_disciplina').on('change', function() {
            var verifica = true;
            var idDisciplina = $('#id_disciplina').select2("val");
            $.get("{{ route('adm.questoes.busca_topico', '') }}" + "/" + idDisciplina, function(topicos) {
                $('select[name="id_topico"]').empty();
                $.each(topicos,
                function(key, value) {
                    if (verifica){
                        $('select[name="id_topico"]').append('<option value="" selected disabled>Selecione um tópico</option>');
                    }
                    verifica = false;
                    $('select[name="id_topico"]').append('<option value=' + value.id +
                        '>' + value.descricao + '</option>');
                });
            });
        });

    });
</script>


@endsection
