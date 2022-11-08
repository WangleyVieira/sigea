<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Disciplina;
use App\Questao;
use App\Topico;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //acesso adm
    public function index()
    {
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }
            //realiza a model e realiza a contagem (count)
            $disciplinas = Disciplina::where('ativo', '=', 1)->count();
            $topicos = Topico::where('ativo', '=', 1)->count();
            $usuarios = User::where('ativo', '=', 1)->count();
            $questoes = Questao::where('ativo', '=', 1)->count();
            $atividades = Atividade::where('ativo', '=', 1)->count();

            return view('home', compact('disciplinas', 'topicos', 'usuarios', 'questoes', 'atividades'));


        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro ao logar no sistema.');
        }
    }

    //acesso usuário externo
    // public function indexExterno()
    // {
    //     try {
    //         if(auth()->user()->id_perfil != 2){
    //             return redirect()->back()->with('erro', 'Acesso negado.');
    //         }

    //     } catch (\Exception $ex) {
    //         // $ex->getMessage();
    //         return redirect()->back()->with('erro', 'Ocorreu um erro ao logar no sistema.');
    //     }
    // }
}
