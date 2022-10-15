@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<style>
    input[type="checkbox"] {
        /* Add if not using autoprefixer */
        -webkit-appearance: none;
        /* Remove most all native input styles */
        appearance: none;
        /* For iOS < 15 */
        background-color: var(--form-background);
        /* Not removed via appearance */
        margin: 0;

        font: inherit;
        color: currentColor;
        width: 2.15em;
        height: 2.15em;
        border: 0.15em solid currentColor;
        border-radius: 0.15em;
        transform: translateY(-0.075em);

        display: grid;
        place-content: center;
    }

    input[type="checkbox"]::before {
        content: "";
        width: 0.65em;
        height: 0.65em;
        clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
        transform: scale(0);
        transform-origin: bottom left;
        transition: 120ms transform ease-in-out;
        box-shadow: inset 1em 1em var(--form-control-color);
        /* Windows High Contrast Mode */
        background-color: CanvasText;
    }

    input[type="checkbox"]:checked::before {
        transform: scale(1);
    }

    input[type="checkbox"]:focus {
        outline: max(2px, 0.15em) solid currentColor;
        outline-offset: max(2px, 0.15em);
    }

    input[type="checkbox"]:disabled {
        --form-control-color: var(--form-control-disabled);

        color: var(--form-control-disabled);
        cursor: not-allowed;
    }
</style>

@include('errors.alerts')
@include('errors.errors')

<div class="header">
    <h1 class="mt-4">Questões cadastradas</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="datatable-responsive">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Selecionar</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Título da questão</th>
                        <th scope="col">Cadastrado por</th>
                        <th scope="col">Cadastrado em</th>
                        <th scope="col">Atualizado em</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questoesCadastradas as $qc)
                        @foreach ($qc->questoes as $qcListagem)
                            <tr>
                                <td style="text-align: center">
                                    <label>
                                        <input type="checkbox" name="selecao[]"/>
                                    </label>
                                </td>
                                <td> {{ $qcListagem->descricao }}</td>
                                <td> {{ $qcListagem->titulo_questao }}</td>
                                <td> {{ isset($qc->cadastradoPorUsuario) ? $qcListagem->cad_usuario->name : 'nativo do sistema' }} </td>
                                <td> {{ $qcListagem->created_at != null && $qcListagem->created_at != "" ? $qcListagem->created_at->format('d/m/Y H:i:s') : '-' }} </td>
                                <td> {{ $qcListagem->updated_at != null && $qcListagem->updated_at != "" ? $qcListagem->updated_at->format('d/m/Y H:i:s') : '-' }} </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

        </div>
    <hr>
    </div>
    <div class="col-12">
        <a href="" class="btn btn-primary"> Salvar</a>
    </div>
    <br>

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
