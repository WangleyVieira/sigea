<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $questao->titulo_questao }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
            line-height: 1.5;
        }

        .doc-header {
            border: 1px solid #d1e7d8;
            background: #f2fbf5;
            padding: 12px 14px;
            margin-bottom: 12px;
        }

        .doc-title {
            margin: 0;
            font-size: 20px;
            color: #0f5a2d;
        }

        .doc-subtitle {
            margin: 2px 0 0;
            color: #4b5563;
            font-size: 11px;
        }

        .meta {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .meta td {
            border: 1px solid #dbe5de;
            padding: 7px 9px;
            vertical-align: top;
        }

        .label {
            display: block;
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 2px;
        }

        .value {
            font-weight: 600;
            color: #111827;
        }

        .section-title {
            margin: 14px 0 8px;
            padding: 6px 8px;
            background: #eef7f1;
            border-left: 4px solid #0f5a2d;
            font-size: 13px;
            font-weight: 700;
            color: #0f5a2d;
        }

        .panel {
            border: 1px solid #dce8df;
            padding: 10px;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <div class="doc-header">
        <h1 class="doc-title">Questão</h1>
        <p class="doc-subtitle">SIGEA - Sistema de Geração de Atividades</p>
    </div>

    <table class="meta">
        <tr>
            <td>
                <span class="label">Codigo da questão</span>
                <span class="value">{{ $questao->codigo_questao }}</span>
            </td>
            <td>
                <span class="label">Disciplina</span>
                <span class="value">{{ $questao->disciplina->nome }}</span>
            </td>
            <td>
                <span class="label">Topico</span>
                <span class="value">{{ $questao->topico->descricao }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label">Titulo</span>
                <span class="value">{{ $questao->titulo_questao }}</span>
            </td>
            <td>
                <span class="label">Cadastrado por</span>
                <span class="value">{{ $questao->cad_usuario->name }}</span>
            </td>
            <td>
                <span class="label">Atualizado em</span>
                <span class="value">{{ $questao->updated_at->format('d/m/Y H:i:s') }}</span>
            </td>
        </tr>
    </table>

    <div class="section-title">Descricao</div>
    <div class="panel">{!! $questao->descricao !!}</div>

    <div class="section-title">Resposta</div>
    <div class="panel">{!! $questao->resposta !!}</div>
</body>
</html>
