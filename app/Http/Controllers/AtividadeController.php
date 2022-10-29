<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AtividadeQuestao;
use App\Disciplina;
use App\Questao;
use Carbon\Carbon;
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
            $atividades = AtividadeQuestao::get();

            return view('adm.atividade.index', compact('atividades'));
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

            // return view('adm.atividade.create', compact('disciplinas', 'questoes'));
            return view('adm.atividade.listar-questoes', compact('disciplinas', 'questoes'));

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

            if($request->id_questao == null){
                return redirect()->back()->with('erro', 'Selecione a questão para cadastrar a atividade.');
            }

            $atividadeCadastrada = new Atividade();
            $atividadeCadastrada->id_disciplina = $request->id_disciplina;
            $atividadeCadastrada->descricao = $request->descricao_atividade;
            $atividadeCadastrada->titulo_atividade = $request->titulo_atividade;
            $atividadeCadastrada->cadastradoPorUsuario = auth()->user()->id;
            $atividadeCadastrada->ativo = 1;
            $atividadeCadastrada->save();

            $questoesVincular = $request->id_questao;

            for ($i = 0; $i < Count($questoesVincular); $i++) {
                $vincularQuestaoAtividade = new AtividadeQuestao();
                $vincularQuestaoAtividade->id_atividade = $atividadeCadastrada->id;
                $vincularQuestaoAtividade->id_questao = $questoesVincular[$i];
                $vincularQuestaoAtividade->save();
            }

            return redirect()->route('adm.atividades.index')->with('success', 'Cadastro realizado com sucesso.');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
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
    public function edit(Request $request, $id)
    {
        try {
            $atividade = AtividadeQuestao::find($id);
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $questoes = Questao::where('ativo', '=', 1)->get();

            return view('adm.atividade.edit', compact('atividade', 'disciplinas', 'questoes'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if($request->id_disciplina == null){
                return redirect()->back()->with('erro', 'Selecione a disciplina para cadastrar a atividade.');
            }

            if($request->id_questao == null){
                return redirect()->back()->with('erro', 'Selecione a questão para cadastrar a atividade.');
            }

            $atividadeUpdated = Atividade::find($id);
            $atividadeUpdated->id_disciplina = $request->id_disciplina;
            $atividadeUpdated->descricao = $request->descricao_atividade;
            $atividadeUpdated->titulo_atividade = $request->titulo_atividade;
            $atividadeUpdated->alteradoPorUsuario = auth()->user()->id;
            $atividadeUpdated->ativo = 1;
            $atividadeUpdated->save();

            $questoesUpdated = $request->id_questao;

            for ($i = 0; $i < Count($questoesUpdated); $i++) {
                $updatedQuestaoAtividade = AtividadeQuestao::find($atividadeUpdated->id);
                $updatedQuestaoAtividade->id_atividade = $atividadeUpdated->id;
                $updatedQuestaoAtividade->id_questao = $questoesUpdated[$i];
                $updatedQuestaoAtividade->save();
            }

            return redirect()->route('adm.atividades.index')->with('success', 'Cadastro realizado com sucesso.');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $atividade = Atividade::find($id);
            $atividade->motivo = $request->motivo;
            $atividade->dataInativado = Carbon::now();
            $atividade->inativadoPorUsuario =  auth()->user()->id;
            
            return view('adm.atividade.edit', compact('atividade', 'disciplinas', 'questoes'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }
}
