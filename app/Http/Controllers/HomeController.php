<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Disciplina;
use App\Questao;
use App\Topico;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // acesso adm
    public function index()
    {
        try {
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->count();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->count();
            $usuarios = User::where('ativo', '=', User::ATIVO)->count();
            $questoes = Questao::where('ativo', '=', Questao::ATIVO)->count();
            $atividades = Atividade::where('ativo', '=', Atividade::ATIVO)->count();

            $inicio = Carbon::now()->startOfMonth()->subMonths(5);
            $meses = array();
            $chavesMeses = array();
            $cursor = $inicio->copy();

            for ($i = 0; $i < 6; $i++) {
                $chave = $cursor->format('Y-m');
                $chavesMeses[] = $chave;
                $meses[] = $cursor->format('m/Y');
                $cursor->addMonth();
            }

            $questoesPorMes = $this->contarPorMes(Questao::class, $inicio, $chavesMeses);
            $atividadesPorMes = $this->contarPorMes(Atividade::class, $inicio, $chavesMeses);

            $disciplinasTop = Disciplina::where('ativo', '=', Disciplina::ATIVO)
                ->withCount('questoes')
                ->orderBy('questoes_count', 'desc')
                ->take(5)
                ->get();

            $disciplinasTopLabels = $disciplinasTop->pluck('nome')->values()->all();
            $disciplinasTopValores = $disciplinasTop->pluck('questoes_count')->values()->all();

            return view('home', compact(
                'disciplinas',
                'topicos',
                'usuarios',
                'questoes',
                'atividades',
                'meses',
                'questoesPorMes',
                'atividadesPorMes',
                'disciplinasTopLabels',
                'disciplinasTopValores'
            ));
        } catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro ao logar no sistema.');
        }
    }

    private function contarPorMes($modelClass, Carbon $inicio, array $chavesMeses)
    {
        $contagem = array();

        foreach ($chavesMeses as $chave) {
            $contagem[$chave] = 0;
        }

        $registros = $modelClass::where('created_at', '>=', $inicio)->get(['created_at']);

        foreach ($registros as $registro) {
            if (!$registro->created_at) {
                continue;
            }

            $chave = Carbon::parse($registro->created_at)->format('Y-m');
            if (isset($contagem[$chave])) {
                $contagem[$chave]++;
            }
        }

        $saida = array();
        foreach ($chavesMeses as $chave) {
            $saida[] = $contagem[$chave];
        }

        return $saida;
    }
}
