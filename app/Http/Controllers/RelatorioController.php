<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AtividadeQuestao;
use App\Disciplina;
use App\Periodo;
use App\Questao;
use App\Topico;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use PHPUnit\Framework\Constraint\Count;

class RelatorioController extends Controller
{
    public function disciplinas()
    {
        try {
            $periodos = Periodo::where('ativo', '=', Periodo::ATIVO)->get();
            $disciplinas = Disciplina::orderBy('nome', 'ASC')->where('ativo', '=', Disciplina::ATIVO)->get();
            $contador = Count($disciplinas);
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('adm.relatorio.disciplina.index', compact('periodos', 'disciplinas', 'contador'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Relatório disciplinas - ' .$dataFormatada. '.pdf', 'I');

        }
        catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu ao exibir o relatório da disciplina');
        }
    }

    public function topicos()
    {
        try {
            $topicos = Topico::orderBy('id_disciplina', 'ASC')->where('ativo', '=', Topico::ATIVO)->get();
            $contador = Count($topicos);
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('adm.relatorio.topicos.index', compact('topicos', 'contador'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Relatório tópicos - ' .$dataFormatada. '.pdf', 'I');

        }
        catch (\Exception $ex) {
            $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu ao exibir o relatório da disciplina');
        }
    }

    public function relatorioGeral()
    {
        try {
            $periodos = Periodo::where('ativo', '=', Periodo::ATIVO)->get();
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->orderBy('nome', 'ASC')->with('topicos')->get();
            $questoes = Questao::where('ativo', '=', Questao::ATIVO)->get();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->get();
            $atividades = Atividade::where('ativo', '=', Atividade::ATIVO)->get();
            $usuarios = User::where('ativo', '=', User::ATIVO)->get();

            $contador = Count($disciplinas);
            $contadorTopicos = Count($topicos);
            $contadorAtividades = Count($atividades);
            $contadorQuestoes = Count($questoes);
            $contadorUsuarios = Count($usuarios);

            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('adm.relatorio.geral.index', compact('periodos', 'disciplinas', 'contador',
                'contadorTopicos', 'questoes', 'atividades', 'contadorAtividades', 'contadorQuestoes',
                'usuarios', 'contadorUsuarios'
            ));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Relatório Geral - ' .$dataFormatada. '.pdf', 'I');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu ao exibir o relatório da disciplina');
        }
    }
}
