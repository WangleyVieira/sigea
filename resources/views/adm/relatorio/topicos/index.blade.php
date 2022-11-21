<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>RELATÓRIO TÓPICOS</title>

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
                                RELATÓRIO TÓPICOS
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
                <h3>Total de Tópicos ativos: {{ $contador }}</h3>
                @if (Count($topicos) == 0)
                    <div><p>Sem cadastros</p></div>
                @else
                    @foreach ($topicos as $top)
                        <br>
                        <table style="text-align: left">
                            <tr>
                                {{-- <td>Descricao: {{ $top->descricao != "" && $top->descricao != null ? $top->descricao : 'Não cadastrado' }}</td> --}}
                                <td>Descricao: {{ mb_strtoupper($top->descricao, 'UTF-8') }}</td>
                                <td>Disciplina vinculada: {{ mb_strtoupper($top->disciplina->nome, 'UTF-8') }}</td>
                            </tr>
                        </table>
                    @endforeach
                @endif
            </div>

        </div>

        {{-- <div style="text-align: center">
            <br><br><br>
            <span>__________________________________</span><br>
            <span>Responsável pela listagem</span>
        </div> --}}
    </main>
</body>

</html>


