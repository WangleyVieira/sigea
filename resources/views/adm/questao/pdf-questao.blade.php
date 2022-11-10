<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{$minhaQuestao->titulo_questao}}</title>

        <style>
            html{
                font-size: 0.895rem;
                font-family: 'Times New Roman', Times, serif;
            }
            h4{
                text-align: center;
            }
           
            p {
            font-family: 'Times New Roman', Times, serif;
            /* font-style: italic; */
            /* font-weight: bold; */
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

        <h2 style="text-align: center"> {{$minhaQuestao->titulo_questao}} </h2>

        <hr>
        <h3>Código Questão: {{$minhaQuestao->codigo_questao}} </h3>
        <hr>

        <p>Titulo da questão: {{ $minhaQuestao->titulo_questao }}</p>
        <p>Disciplina: {{ $minhaQuestao->disciplina->nome }}</p>
        <p>Tópico vinculado: {{ $minhaQuestao->topico->descricao }}</p>
        <p>Cadastrado por: {{ $minhaQuestao->cad_usuario->name }}</p>
        <p>Cadastrado em: {{ $minhaQuestao->created_at->format('d/m/Y H:i:s') }}</p>
        <p>Atualizado em: {{ $minhaQuestao->updated_at->format('d/m/Y H:i:s') }}</p>
        <hr>
        <p style="font-weight: bold;">
            Descrição:
        </p>

        {{ $minhaQuestao->descricao }}

        <hr>
        <p>Resposta: {{ $minhaQuestao->resposta }}</p>

    </body>
</html>
