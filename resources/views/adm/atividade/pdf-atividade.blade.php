<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{$atividade->titulo_atividade}}</title>

        <style>
            html{
                font-size: 0.895rem;
                font-family: 'Times New Roman', Times, serif;
            }
            h4{
                text-align: center;
            }
            table{
                border-collapse: collapse;
                width: 100%;
                border: 1px solid black;
                text-align: center;
            }
            td{
                padding: 2px;
                border: 1px solid black;
            }
            th{
                border: 1px solid black
            }
            p {
            font-family: 'Times New Roman', Times, serif;
            /* font-style: italic; */
            font-weight: bold;
            font-size: 16px;
            line-height: 20px;
            margin: 10px 0px;
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

        <h2 style="text-align: center"> {{$atividade->titulo_atividade}} </h2>

        <hr>
        <h3>Disciplina: {{$atividade->disciplina->nome}} </h3>
        <hr>

        @foreach ($atividadeQuestoes as $atvQuestao)
            <p> {{ $atvQuestao->lista_questoes->descricao }} </p>
        @endforeach

    </body>
</html>
