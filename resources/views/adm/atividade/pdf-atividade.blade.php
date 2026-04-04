<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $atividade->titulo_atividade }}</title>
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

        .question-item {
            border: 1px solid #dce8df;
            background: #ffffff;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .question-head {
            padding: 7px 9px;
            background: #f8fbf9;
            border-bottom: 1px solid #e4ede6;
            font-weight: 700;
            color: #0f5a2d;
        }

        .question-body {
            padding: 10px;
        }

        .empty {
            border: 1px dashed #b6c9bb;
            background: #f8faf9;
            padding: 12px;
            text-align: center;
            color: #4b5563;
        }
    </style>
</head>
<body>
    <div class="doc-header">
        <h1 class="doc-title">Atividade</h1>
        <p class="doc-subtitle">SIGEA - Sistema de Geração de Atividades</p>
    </div>

    <table class="meta">
        <tr>
            <td>
                <span class="label">Titulo da atividade</span>
                <span class="value">{{ $atividade->titulo_atividade }}</span>
            </td>
            <td>
                <span class="label">Disciplina</span>
                <span class="value">{{ $atividade->disciplina->nome }}</span>
            </td>
            <td>
                <span class="label">Emissao</span>
                <span class="value">{{ date('d/m/Y H:i') }}</span>
            </td>
        </tr>
    </table>

    <div class="section-title">Questões</div>

    @if (Count($atividadeQuestoes) == 0)
        <div class="empty">Sem questoes vinculadas.</div>
    @else
        @foreach ($atividadeQuestoes as $atvQuestao)
            <div class="question-item">
                <div class="question-head">Questão {{ $loop->iteration }}</div>
                <div class="question-body">{!! $atvQuestao->lista_questoes->descricao !!}</div>
            </div>
        @endforeach
    @endif
</body>
</html>
