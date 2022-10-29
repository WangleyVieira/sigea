<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AtividadeQuestao;
use App\Disciplina;
use App\Questao;
use Illuminate\Http\Request;

class AtividadeQuestaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function selectQuestao(Request $request)
    {
        try {
           $questoesCadastradas = Disciplina::where('ativo', '=', 1)->with('questoes')->get();
            dd($questoesCadastradas );
           return view('adm.atividade.listar-questoes', compact('questoesCadastradas'));

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    public function buscaQuestaoDisciplina(Request $request, $id)
    {
        try {
            if($request->ajax()){
                $questoes = Questao::where('id_disciplina', '=', $id)->where('ativo', '=', 1)->get();

                return response()->json($questoes);
            }

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {

        // } catch (\Exception $ex) {
        //     // return $ex->getMessage();
        //     return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AtividadeQuestao  $atividadeQuestao
     * @return \Illuminate\Http\Response
     */
    public function show(AtividadeQuestao $atividadeQuestao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AtividadeQuestao  $atividadeQuestao
     * @return \Illuminate\Http\Response
     */
    public function edit(AtividadeQuestao $atividadeQuestao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AtividadeQuestao  $atividadeQuestao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtividadeQuestao $atividadeQuestao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AtividadeQuestao  $atividadeQuestao
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtividadeQuestao $atividadeQuestao)
    {
        //
    }
}
