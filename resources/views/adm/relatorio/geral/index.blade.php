<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>RELATÓRIO GERAL</title>

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
                                RELATÃ“RIO GERAL
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
                <h2>RelaÃ§Ã£o</h2>
                <h3>Total de Disciplinas ativas: {{ $contador }}</h3>
                <h3>Total de Tópicos vinculados a Disciplina ativas: {{ $contadorTopicos }}</h3>
                @if (Count($disciplinas) == 0)
                    <div><p>Sem cadastros</p></div>
                @else
                    @foreach ($disciplinas as $d)
                        <br>
                        <table style="text-align: left">
                            <tr>
                                <td class="titulo">Disciplina: {{ mb_strtoupper($d->nome, 'UTF-8')}}</td>
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
                <h2>RelaÃ§Ãµes de QuestÃµes</h2>
                <h3>Total de questÃµes ativas: {{ $contadorQuestoes }}</h3>
                    @if (Count($questoes) == 0)
                        <div><p>Sem cadastros</p></div>
                    @else
                        @foreach ($questoes as $questao)
                            <br>
                            <table style="text-align: left">
                                <tr>
                                    {{-- <td class="titulo" colspan="3">Disciplina: {{ $questao->disciplina->nome }}</td> --}}
                                    <td class="titulo" colspan="3">Disciplina: {{ mb_strtoupper($questao->disciplina->nome, 'UTF-8')}}</td>
                                </tr>
                                <tr>
                                    <td class="titulo">Cadastrado por: {{ $questao->cad_usuario->name }} </td>
                                    <td class="titulo">Cadastrado em: {{  date('d/m/Y H:i:s', strtotime($questao->created_at))}} </td>
                                    <td class="titulo">Atualizado em: {{  date('d/m/Y H:i:s', strtotime($questao->updated_at))}}  </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        DescriÃ§Ã£o:
                                        <div>{!! $questao->descricao != "" && $questao->descricao != null ? $questao->descricao : 'NÃ£o cadastrado' !!}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Resposta:
                                        <div>{!! $questao->resposta != "" && $questao->resposta != null ? $questao->resposta : 'NÃ£o cadastrado' !!}</div>
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    @endif
            </div>
            <br>
            <hr>
            <div style="margin-top: 5px;">
                <h2>RelaÃ§Ãµes de Atividades</h2>
                <h3>Total de atividades ativas: {{ $contadorAtividades }}</h3>
                @if (Count($atividades) == 0)
                    <div><p>Sem cadastros</p></div>
                @else
                    @foreach ($atividades as $atividade)
                        <br>
                        <table style="text-align: left">
                            <tr>
                                {{-- <td class="titulo" colspan="3">Disciplina relacionada: {{ $atividade->disciplina->nome }}</td> --}}
                                <td class="titulo" colspan="3">Disciplina relacionada: {{ mb_strtoupper($atividade->disciplina->nome, 'UTF-8') }}</td>

                            </tr>
                            <tr>
                                <td colspan="3">DescriÃ§Ã£o da atividade: {{ $atividade->descricao }}</td>

                            </tr>
                            <tr>
                                <td colspan="3">TÃ­tulo da atividade: {{ $atividade->titulo_atividade }}</td>

                            </tr>
                            <tr>
                                <td>Cadastrado por: {{ $atividade->cad_usuario->name }} </td>
                                <td>Cadastrado em: {{  date('d/m/Y H:i:s', strtotime($atividade->created_at))}} </td>
                                <td>Atualizado em: {{  date('d/m/Y H:i:s', strtotime($atividade->updated_at))}}  </td>
                            </tr>
                        </table>
                    @endforeach
                @endif
            </div>
            <br>
            <hr>
            <div style="margin-top: 5px;">
                <h2>RelaÃ§Ãµes de UsuÃ¡rios</h2>
                <h3>Total de usuÃ¡rios ativas: {{ $contadorUsuarios }}</h3>
                    @foreach ($usuarios as $usuario)
                        <br>
                        <table style="text-align: left">
                            <tr>
                                <td class="titulo" colspan="2">UsuÃ¡rio: {{ mb_strtoupper($usuario->name, 'UTF-8') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">E-mail: {{ $usuario->email }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Perfil: {{ $usuario->perfil->descricao }}</td>
                            </tr>
                            <tr>
                                <td>Cadastrado em: {{  date('d/m/Y H:i:s', strtotime( $usuario->created_at != "" && $usuario->created_at != null ? $usuario->created_at : ' - '))}} </td>
                                <td>Atualizado em: {{  date('d/m/Y H:i:s', strtotime( $usuario->updated_at != "" && $usuario->updated_at != null ? $usuario->updated_at : ' - '))}}  </td>
                            </tr>
                        </table>
                    @endforeach
            </div>
            {{-- <br>
            <hr> --}}
        </div>
        {{-- <div style="text-align: center">
            <br><br><br>
            <span>__________________________________</span><br>
            <span>ResponsÃ¡vel pela listagem</span>
        </div> --}}
    </main>
</body>

</html>




