<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Disciplina;
use App\Questao;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('adm.atividade.index');
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
        try {
            $questoes = Questao::where('ativo', '=', 1)->get();
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();

            return view('adm.atividade.create', compact('disciplinas', 'questoes'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    public function buscaQuestao(Request $request, $id)
    {
        try {
            if($request->ajax()){
                $questoes = Questao::where('id_topico', '=', $id)->where('ativo', '=', 1)->get();

                return response()->json($questoes);
            }

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
    public function storeAtividade(Request $request)
    {
        try {
            if($request->id_disciplina == null){
                return redirect()->back()->with('erro', 'Selecione a disciplina para cadastrar a atividade.');
            }

            $atividadeCadastrada = new Atividade();
            $atividadeCadastrada->id_disciplina = $request->id_disciplina;
            $atividadeCadastrada->descricao = $request->descricao_atividade;
            $atividadeCadastrada->titulo_atividade = $request->titulo_atividade;
            $atividadeCadastrada->cadastradoPorUsuario = auth()->user()->id;
            $atividadeCadastrada->ativo = 1;
            // $atividadeCadastrada->save();

            return redirect('/adm/atividade-questao/selecionar-questoes');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit(Atividade $atividade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atividade $atividade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atividade $atividade)
    {
        //
    }
}
