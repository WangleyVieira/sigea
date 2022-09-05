<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Disciplina;
use App\Questao;
use App\Topico;
use App\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            //realiza a model e realiza a contagem (count)
            $disciplinas = Disciplina::where('ativo', '=', 1)->count();
            $topicos = Topico::where('ativo', '=', 1)->count();
            $usuarios = User::where('ativo', '=', 1)->count();
            $questoes = Questao::where('ativo', '=', 1)->count();
            $atividades = Atividade::where('ativo', '=', 1)->count();

            // $ultAtualdisciplinas = Disciplina::where('ativo', '=', 1)->orderBy('created_at', 'desc')->first();

            return view('home', compact('disciplinas', 'topicos', 'usuarios', 'questoes', 'atividades'));

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }
}
