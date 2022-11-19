<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>RELATÓRIO GERAL</title>

    <style>
        html {
            font-size: 0.895rem;
            /* font-size:1.0rem; */
            font-family: 'Times New Roman', Times, serif;
        }

        h4 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
            text-align: center;
        }

        td {
            padding: 2px;
            border: 1px solid black;
        }

        th {
            border: 1px solid black;
        }

        p {
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
            /* font-weight: bold; */
            font-size: 16px;
            line-height: 20px;
            margin: 10px 0px;
        }
        .titulo{
            font-weight: bold;
        }

        .span-header {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size: 16px;
        }

        .span-footer {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }

    </style>

</head>

<body>
    <header>
        <div style="text-align: center;">
            <div class="span-header">
                <div>
                    <table id="titulo" style="font-size: 1.2rem">
                        <tr>
                            <td>
                                RELATÓRIO GERAL
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div>
            <br>

            <div style="margin-top: 5px;">
                <h2>Relação</h2>
                <h3>Total de Disciplinas ativas: {{ $contador }}</h3>
                <h3>Total de Tópicos vinculados a Disciplina ativas: {{ $contadorTopicos }}</h3>
                @if (Count($disciplinas) == 0)
                    <div><p>Sem cadastros</p></div>
                @else
                    @foreach ($disciplinas as $d)
                        <br>
                        <table style="text-align: left">
                            <tr>
                                <td class="titulo">Disciplina: {{ $d->nome != "" && $d->nome != null ? $d->nome : 'Não cadastrado' }}</td>
                                <td class="titulo">Período: {{ $d->periodo->descricao != "" && $d->periodo->descricao != null ? $d->periodo->descricao : 'Não cadastrado' }}</td>
                                <td class="titulo">Código: {{ $d->codigo != "" && $d->codigo != null ? $d->codigo : 'Não cadastrado' }}</td>
                                <tr>
                                    <td colspan="3" class="titulo" style="text-align: center">Tópicos vinculados</td>
                                </tr>
                                @foreach ($d->topicos as $top)
                                    <tr>
                                        <td colspan="3">{{ $top->descricao }}</td>
                                    </tr>
                                @endforeach
                            </tr>
                        </table>
                    @endforeach
                @endif
            </div>
            <br><br>
            <hr>
            <div style="margin-top: 5px;">
                <h2>Relações de Questões</h2>
                {{-- <h3>Total de Disciplinas ativas: {{ $contador }}</h3>
                <h3>Total de Tópicos vinculados a Disciplina ativas: {{ $contadorTopicos }}</h3> --}}

                    @foreach ($questoes as $questao)
                        <br>
                        <table style="text-align: left">
                            <tr>
                                <td class="titulo" colspan="3">Disciplina: {{ $questao->disciplina->nome }}</td>

                            </tr>
                            <tr>
                                <td class="titulo">Cadastrado por: {{ $questao->cad_usuario->name }} </td>
                                <td class="titulo">Cadastrado em: {{  date('d/m/Y H:i:s', strtotime($questao->created_at))}} </td>
                                <td class="titulo">Atualizado em: {{  date('d/m/Y H:i:s', strtotime($questao->updated_at))}}  </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    Descrição:
                                    <p>{{ $questao->descricao != "" && $questao->descricao != null ? $questao->descricao : 'Não cadastrado' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    Resposta:
                                    <p>{{ $questao->resposta != "" && $questao->resposta != null ? $questao->resposta : 'Não cadastrado' }}</p>
                                </td>
                            </tr>
                        </table>
                    @endforeach
            </div>
            <br>
            <hr>

            {{-- <div class="" style="margin-top: 5px;">
                <h2>Relação</h2>
                <h3>Tópicos cadastrados (ativos): </h3>
                @if (Count($disciplinas) == 0)
                    <div><p>Sem cadastros</p></div>
                @else
                    @foreach ($disciplinas as $d)
                        <tr>
                            <td> {{ $d->topicos->descricao }}</td>
                        </tr>
                    @endforeach
                @endif
            </div> --}}
        </div>

        <div style="text-align: center">
            <br><br><br>
            <span>__________________________________</span><br>
            <span>Responsável pela listagem</span>
        </div>
    </main>
</body>

</html>


