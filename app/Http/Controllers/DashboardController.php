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
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->count();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->count();
            $usuarios = User::where('ativo', '=', User::ATIVO)->count();
            $questoes = Questao::where('ativo', '=', Questao::ATIVO)->count();
            $atividades = Atividade::where('ativo', '=', Atividade::ATIVO)->count();

            return view('home', compact('disciplinas', 'topicos', 'usuarios', 'questoes', 'atividades'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }
}
