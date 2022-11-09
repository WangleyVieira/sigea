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
    <h1 class="mt-4">Cadastrar Atividade</h1>
</div>
<br>
<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{ route('adm.atividades.store') }}" id="formQuestao" method="POST" class="form_prevent_multiple_submits">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="id_disciplina">Disciplinas</label>
                        <select name="id_disciplina"  id="id_disciplina" class="form-control select2">
                            <option value="" selected disabled>-- Selecione a disciplina --</option>
                            @foreach ($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}" name="{{ $disciplina->nome }}">{{ $disciplina->nome }} - {{ $disciplina->codigo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="descricao_atividade">Descricao</label>
                        <input type="text" name="descricao_atividade" id="descricao_atividade" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="titulo_atividade">Titulo</label>
                        <input type="text" name="titulo_atividade" id="titulo_atividade" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label">*Questões</label>
                        <select name="id_questao[]" id="id_questao" class="form-control select2" multiple>

                        </select>
                    </div>
                    <div class="col-12">
                        <input type="submit" class="btn btn-primary" name="Salvar" value="Salvar">
                        <a href="{{ route('adm.atividades.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
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

        /*
         realiza a requisicao Ajax no controlador QuestaoController e realiza
         uma busca dos topicos vinculados a disciplina
        */
        $('#id_disciplina').on('change', function() {
            var verifica = true;
            var idDisciplina = $('#id_disciplina').select2("val");
            $.get("{{ route('adm.atividade_questao.busca_questao_disciplina', '') }}" + "/" + idDisciplina, function(questoes) {
                $('select[name="id_questao[]"]').empty();
                $.each(questoes,
                function(key, value) {
                    if (verifica){
                        // $('select[name="id_questao"]').append('<option value="" selected disabled>Selecione a questão</option>');
                        $('select[name="id_questao[]"]');
                    }
                    verifica = false;
                    $('select[name="id_questao[]"]').append('<option value=' + value.id +'>' + value.descricao + '</option>');
                });
            });
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
