<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Disciplina;
use App\Periodo;
use App\Questao;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use PHPUnit\Framework\Constraint\Count;

class RelatorioController extends Controller
{
    public function disciplinas()
    {
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $periodos = Periodo::where('ativo', '=', 1)->get();
            $disciplinas = Disciplina::orderBy('nome', 'ASC')->where('ativo', '=', 1)->get();

            $contador = Count($disciplinas);

            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('adm.relatorio.disciplina.index', compact('periodos', 'disciplinas', 'contador'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Relatório disciplinas - ' .$dataFormatada. '.pdf', 'I');

        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu ao exibir o relatório da disciplina');
        }
    }

    public function relatorioGeral()
    {
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $periodos = Periodo::where('ativo', '=', 1)->get();

            $disciplinas = Disciplina::where('ativo', '=', 1)->orderBy('nome', 'ASC')->with('topicos')->get();
            $questoes = Questao::where('ativo', '=', 1)->get();
            $topicos = Topico::where('ativo', '=', 1)->get();
            // dd($disciplinas[0]->topicos[0]);

            $contador = Count($disciplinas);
            $contadorTopicos = Count($topicos);

            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('adm.relatorio.geral.index', compact('periodos', 'disciplinas', 'contador', 'contadorTopicos', 'questoes'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Relatório Geral - ' .$dataFormatada. '.pdf', 'I');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu ao exibir o relatório da disciplina');
        }
    }
}
