<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AtividadeExterno;
use App\Disciplina;
use App\Questao;
use Illuminate\Http\Request;

class AtividadeExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if(auth()->user()->id != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $atividades = Atividade::where('ativo', '=', 1)->get();

            return view('usuario-externo.atividade-externo.index', compact('atividades'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if(auth()->user()->id != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $questoes = Questao::where('ativo', '=', 1)->get();
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();

            return view('usuario-externo.atividade-externo.create', compact('disciplinas', 'questoes'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AtividadeExterno  $atividadeExterno
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AtividadeExterno  $atividadeExterno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AtividadeExterno  $atividadeExterno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
