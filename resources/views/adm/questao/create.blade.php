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
    <h1 class="mt-4">Cadastrar Questão</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{ route('adm.questoes.store') }}" id="formQuestao" method="POST" class="form_prevent_multiple_submits">
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

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="codigo_questao">Código da Questão (Letras e Números)</label>
                        <input type="text" name="codigo_questao" id="codigo_questao" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="titulo_questao">Título da questão</label>
                        <input type="text" name="titulo_questao" id="titulo_questao" class="form-control">
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-12">
                        <textarea class="form-control" name="descricao" rows="2"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        {{-- <button type="submit" class="btn btn-primary">Cadastrar</button> --}}
                        <input type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">
                        <a href="{{ route('adm.questoes.index') }}" class="btn btn-danger">Cancelar</a>
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
                maxlength:1200,
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
