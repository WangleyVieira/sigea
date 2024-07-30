<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Http\Requests\QuestaoStoreRequest;
use App\Http\Requests\QuestaoUpdateRequest;
use App\Questao;
use App\QuestaoExterno;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class QuestaoExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->get();
            $questoes = Questao::where('cadastradoPorUsuario', '!=', Auth::user()->id)->where('ativo', '=', Questao::ATIVO)->get();
            $minhasQuestoes = Questao::where('cadastradoPorUsuario', '=', Auth::user()->id)->where('ativo', '=', Questao::ATIVO)->get();

            return view('usuario-externo.questao-externa.index', compact('questoes', 'disciplinas', 'topicos', 'minhasQuestoes'));

        }
        catch (\Exception $ex) {
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
    public function store(QuestaoStoreRequest $request)
    {
        try {
           $novaQuestao = new Questao();
           $novaQuestao->descricao = $request->descricao;
           $novaQuestao->id_topico = $request->id_topico;
           $novaQuestao->resposta = $request->resposta;
           $novaQuestao->codigo_questao = strtoupper($request->codigo_questao);
           $novaQuestao->id_disciplina = $request->id_disciplina;
           $novaQuestao->titulo_questao = $request->titulo_questao;
           $novaQuestao->cadastradoPorUsuario = Auth::user()->id;
           $novaQuestao->ativo = Questao::ATIVO;
           $novaQuestao->save();

            return redirect()->route('acesso_externo.questoes.index_externo')->with('success', 'Questão cadastrado com sucesso.');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $questao = Questao::find($id);
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->get();

            return view('usuario-externo.questao-externa.edit', compact('disciplinas', 'topicos', 'questao'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(QuestaoUpdateRequest $request, $id)
    {
        try {
            $questao = Questao::find($id);
            $questao->descricao = $request->descricao;
            $questao->resposta = $request->resposta;
            $questao->titulo_questao = $request->titulo_questao;
            $questao->alteradoPorUsuario = Auth::user()->id;
            $questao->save();

            return redirect()->route('acesso_externo.questoes.index_externo')->with('success', 'Questão alterado com sucesso.');

        }
        catch (\Exception $ex) {
        //  return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro ao alterar a questão, entre em contato com Adm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $questao = Questao::find($request->id);
            $questao->dataInativado = Carbon::now();
            $questao->inativadoPorUsuario = auth()->user()->id;
            $questao->motivoInativado = $request->motivo;
            $questao->ativo = Questao::INATIVO;
            $questao->save();

            return redirect()->back()->with('success', 'Questão excluído com sucesso.');

        }
        catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu ao excluir a questão.');
        }
    }
}
