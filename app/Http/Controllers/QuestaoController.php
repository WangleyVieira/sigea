<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Http\Requests\QuestaoStoreRequest;
use App\Http\Requests\QuestaoUpdateRequest;
use App\Periodo;
use App\Questao;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Mpdf\Mpdf;

class QuestaoController extends Controller
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
            return view('adm.questao.index', compact('questoes', 'disciplinas', 'topicos', 'minhasQuestoes'));
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    public function buscaTopico(Request $request, $id)
    {
        try {
            if($request->ajax()){
                $topicos = Topico::where('id_disciplina', '=', $id)->where('ativo', '=', Topico::ATIVO)->get();
                return response()->json($topicos);
            }
        }
        catch (\Exception $ex) {
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
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->get();
            return view('adm.questao.create', compact('disciplinas', 'topicos'));
        }
        catch (\Exception $ex) {
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
            Questao::create($request->validated() + [
                'cadastradoPorUsuario' => Auth::user()->id
            ]);
            return redirect()->route('adm.questoes.index')->with('success', 'Questão cadastrado com sucesso.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $questao = Questao::find($id);
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $topicos = Topico::where('ativo', '=',Topico::ATIVO)->get();
            return view('adm.questao.editar', compact('disciplinas', 'topicos', 'questao'));
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function update(QuestaoUpdateRequest $request, $id)
    {
        try {
            $questao = Questao::find($id);
            $questao->update($request->validated() + [
                'cadastradoPorUsuario' => Auth::user()->id
            ]);
            return redirect()->route('adm.questoes.index')->with('success', 'Questão alterado com sucesso.');
        }
        catch (\Exception $ex) {
         return redirect()->back()->with('erro', 'Ocorreu um erro ao alterar a questão, entre em contato com Adm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $questao = Questao::find($request->id);
            $questao->update([
                'dataInativado' => Carbon::now(),
                'inativadoPorUsuario' => Auth::user()->id,
                'motivoInativado' => $request->motivo,
                'ativo' => Questao::INATIVO
            ]);
            return redirect()->back()->with('success', 'Questão excluído com sucesso.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu ao excluir a questão.');
        }
    }
}
