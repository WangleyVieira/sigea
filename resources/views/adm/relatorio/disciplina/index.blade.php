<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>RELATÃ“RIO</title>

    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
        color: #1f2937;
        line-height: 1.4;
    }

    h2, h3, h4 {
        margin: 0 0 6px;
        color: #0f5a2d;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #dbe5de;
        text-align: left;
        margin-bottom: 10px;
    }

    td, th {
        padding: 6px 8px;
        border: 1px solid #dbe5de;
        vertical-align: top;
    }

    p {
        margin: 4px 0;
    }

    .titulo {
        font-weight: 700;
        background: #f4f9f6;
        color: #0f5a2d;
    }

    .span-header {
        display: block;
        font-weight: 700;
        font-size: 15px;
        color: #0f5a2d;
        text-align: center;
    }

    #titulo {
        border: 1px solid #d1e7d8;
        background: #f2fbf5;
        text-align: center;
        margin-bottom: 12px;
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
                                RELATÓRIO DISCIPLINAS
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

            <div class="" style="margin-top: 5px;">
                <h2>Relatório</h2>
                <h3>Total: {{ $contador }}</h3>
                @if (Count($disciplinas) == 0)
                    <div><p>Sem cadastros</p></div>
                @else
                    @foreach ($disciplinas as $d)
                        <br>
                        <table style="text-align: left">
                            <tr>
                                <td>Disciplina: {{ mb_strtoupper($d->nome != "" && $d->nome != null ? $d->nome : 'Não cadastrado', 'UTF-8')}} </td>
                                <td>Período: {{ $d->periodo->descricao != "" && $d->periodo->descricao != null ? $d->periodo->descricao : 'Não cadastrado' }}</td>
                                <td>Código: {{ $d->codigo != "" && $d->codigo != null ? $d->codigo : 'Não cadastrado' }}</td>
                            </tr>
                        </table>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- <div style="text-align: center">
            <br><br><br>
            <span>__________________________________</span><br>
            <span>ResponsÃ¡vel pela listagem</span>
        </div> --}}
    </main>
</body>

</html>



