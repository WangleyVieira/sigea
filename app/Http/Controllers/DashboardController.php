<?php

namespace App\Http\Controllers;

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
            $disciplinas = Disciplina::where('ativo', '=', 1)->count();
            $topicos = Topico::where('ativo', '=', 1)->count();
            $usuarios = User::where('ativo', '=', 1)->count();
            $questoes = Questao::where('ativo', '=', 1)->count();

            return view('home', compact('disciplinas', 'topicos', 'usuarios', 'questoes'));

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }
}
