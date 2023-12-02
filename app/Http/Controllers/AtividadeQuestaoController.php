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

    public function buscaQuestaoDisciplina(Request $request, $id)
    {
        try {
            if($request->ajax()){
                $questoes = Questao::where('id_disciplina', '=', $id)->where('ativo', '=', Questao::ATIVO)->get();

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
        //
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
    public function destroy(Request $request, $id)
    {
        try {
            // desativando somente a questão vinculada a atividade
            $atvQuestao = AtividadeQuestao::find($id);
            $atvQuestao->id_questao = $request->id_questao;
            $atvQuestao->ativo = 0;
            $atvQuestao->save();

            return redirect()->back()->with('success', 'Questão excluído a atividade com sucesso.');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }
}
