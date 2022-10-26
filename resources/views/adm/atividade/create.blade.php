@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Cadastrar Atividade</h1>
</div>

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
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" name="avancar" value="Avançar">
                    <a href="{{ route('adm.questoes.index') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('../js/jquery.validate.js')}}"></script>

<script>

    $("#formQuestao").validate({
        rules: {
            descricao:{
                required:true,
                maxlength:255,
            },
            codigo_questao:{
                required:true,
                maxlength:255,
            },
            titulo_questao:{
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

        remove = function(item) {
            var tr = $(item).closest('tr');
            tr.fadeOut(400, function () {
                tr.remove();
            })

            var lista = $('#lista');
            var count_trs = lista.find('tr').length;

            if (count_trs == 2){
                $('#nenhum').removeClass('d-none');
            }

            return false;

        }

        /*
         realiza a requisicao Ajax no controlador QuestaoController e realiza
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
                    $('select[name="id_topico"]').append('<option value=' + value.id +'>' + value.descricao + '</option>');
                });
            });
        });

        /*
         realiza a requisicao Ajax no controlador AtividadeController e realiza
         uma busca das questões vinculadas aos tópicos
        */
        // $('#id_topico').on('change', function() {
        //     var verifica = true;
        //     var idQuestao = $('#id_topico').select2("val");
        //     $.get("{{ route('adm.atividades.busca_questao', '') }}" + "/" + idQuestao, function(questoes) {
        //         $('select[name="id_questao"]').empty();
        //         $.each(questoes,
        //         function(key, value) {
        //             if (verifica){
        //                 $('select[name="id_questao"]').append('<option value="" selected disabled>Selecione a questão</option>');
        //             }
        //             verifica = false;
        //             $('select[name="id_questao"]').append('<option value=' + value.id + '>' + value.descricao + '</option>');
        //         });
        //     });
        // });
    });

</script>


@endsection
