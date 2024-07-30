<?php

namespace App\Http\Controllers;

use App\AtividadeQuestao;
use App\Questao;
use Illuminate\Http\Request;

class AtividadeQuestaoController extends Controller
{
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
