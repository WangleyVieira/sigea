@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Cadastrar Questão</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('adm.questoes.store') }}" id="form" method="POST" class="form_prevent_multiple_submits">
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
                    <label for="id_questao">Selecione o Tópico</label>
                    <select name="topicos[]" id="topicos[]" class="form-control select2">

                    </select>
                </div>
            </div>
            <br>
            <div class="mb-3 row">
                {{-- <label class="col-form-label col-sm-12 text-sm-right">Textarea</label> --}}
                <div class="col-sm-12">
                    <textarea class="form-control" placeholder="Digitar..." rows="5" name="descricao"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="button_prevent_multiple_submits btn btn-primary">Cadastrar</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
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
                $('select[name="topicos[]"]').empty();
                $.each(topicos,
                function(key, value) {
                    if (verifica){
                        $('select[name="topicos[]"]').append('<option value="" selected disabled>Selecione um tópico</option>');
                    }
                    verifica = false;
                    $('select[name="topicos[]"]').append('<option value=' + value.id +
                        '>' + value.descricao + '</option>');
                });
            });
        });

    });
</script>
@endsection
