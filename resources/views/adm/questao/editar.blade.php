@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.tiny.cloud/1/gtdwd51t47mdkyks6pppuhqf941qu0bqu4sxkjz9qzirr20j/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    .error{
            color:red
    }
    #codigo_questao{
        text-transform: uppercase;
    }
</style>

{{-- @include('errors.alerts')
@include('errors.errors') --}}

<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">Alterar questão</h3>
        <hr>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{ route('adm.questoes.update', $questao->id) }}" id="formQuestao" method="POST" class="form_prevent_multiple_submits">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="id_disciplina">Disciplina selecionada</label>
                        <select name="id_disciplina"  id="id_disciplina" class="form-control" disabled>
                            {{-- <option value="" selected disabled>Disciplina selecionada</option> --}}
                            @foreach ($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}" {{ $disciplina->id == $questao->id_disciplina ? 'selected' : '' }}> {{ $disciplina->nome }} - {{ $disciplina->codigo }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_topico">Tópico selecionado</label>
                        <select name="id_topico" id="id_topico" class="form-control" disabled>
                            @foreach ($topicos as $topico)
                                <option value="{{ $topico->id }}" {{ $topico->id == $questao->id_topico ? 'selected' : '' }}> {{ $topico->descricao }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="codigo_questao">Código da Questão (Letras e Números)</label>
                        <input type="text" name="codigo_questao" id="codigo_questao" value="{{ $questao->codigo_questao }}" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="titulo_questao">Título da questão</label>
                        <input type="text" name="titulo_questao" id="titulo_questao" value="{{ $questao->titulo_questao }}" class="form-control @error('titulo_questao') is-invalid @enderror">
                        @error('titulo_questao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="resposta">Resposta</label>
                        <input type="text" name="resposta" id="resposta" value="{{ $questao->resposta }}" class="form-control @error('resposta') is-invalid @enderror">
                        @error('resposta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-2 row">
                    <div class="col-sm-12">
                        <hr>
                        <span>Observações</span>
                        <ul>
                            <li>Não é necessário ordenação e não ordenação de pergunta</li>
                            <li>Seguir o modelo conforme no campo abaixo</li>
                        </ul>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" rows="2" > {{ $questao->descricao }} </textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        {{-- <button type="submit" class="btn btn-primary">Salvar</button> --}}
                        <input type="submit" class="btn btn-primary" name="Salvar" value="Salvar">
                        <a href="{{ route('adm.questoes.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script src="{{asset('../js/jquery.validate.js')}}"></script> --}}

<script>

    // $("#formQuestao").validate({
    //     rules: {
    //         descricao:{
    //             required:true,
    //             maxlength:255,
    //         },
    //         // codigo_questao:{
    //         //     required:true,
    //         //     maxlength:255,
    //         // },
    //         titulo_questao:{
    //             required:true,
    //             maxlength:255,
    //         },
    //         resposta:{
    //             required:true,
    //             maxlength:255,
    //         },
    //     },

    //     messages: {
    //         descricao:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //         // codigo_questao:{
    //         //     required:"Campo obrigatório",
    //         //     maxlength:"Máximo de 255 caracteres"
    //         // },
    //         titulo_questao:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //         resposta:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //     }
    // });

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
