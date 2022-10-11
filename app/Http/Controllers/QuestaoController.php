<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Periodo;
use App\Questao;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $questoes = Questao::where('ativo', '=', 1)->get();
            return view('adm.questao.index', compact('questoes'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    public function buscaTopico(Request $request, $id)
    {
        try {
            if($request->ajax()){
                $topicos = Topico::where('id_disciplina', '=', $id)->where('ativo', '=', 1)->get();

                return response()->json($topicos);
            }

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
            // $disciplinas = Disciplina::where('ativo', '=', 1)->with('topicos')->get();
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $topicos = Topico::where('ativo', '=', 1)->get();

            return view('adm.questao.create', compact('disciplinas', 'topicos'));

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
        try {
           if($request->id_disciplina == null || $request->id_topico == null){
                return redirect()->back()->with('erro', ' Selecione uma Disciplina e um Tópico vinculado.');
           }
           if($request->descricao == null){
                return redirect()->back()->with('erro', 'Campo Descrição é obrigatório.');
           }
            //  validacao dos campos
             $input = [
                'descricao' => $request->descricao,
                'codigo_questao' => $request->codigo_questao
            ];

            $rules = [
                'descricao' => 'required|max:1200',
                'codigo_questao' => 'required|max:255'
            ];

            $messages = [
                'descricao.required' => 'descricao é obrigatório.',
                'descricao.max' => 'Máximo 255 caracteres.',

                'codigo_questao.required' => 'Código questão é obrigatório.',
                'codigo_questao.max' => 'Máximo 255 caracteres'
            ];

            $validaCampos = Validator::make($input, $rules, $messages);
            $validaCampos->validate();

           $novaQuestao = new Questao();
           $novaQuestao->descricao = $request->descricao;
           $novaQuestao->id_topico = $request->id_topico;
           $novaQuestao->codigo_questao = strtoupper($request->codigo_questao);
           $novaQuestao->id_disciplina = $request->id_disciplina;
           $novaQuestao->titulo_questao = $request->titulo_questao;
           $novaQuestao->cadastradoPorUsuario = auth()->user()->id;
           $novaQuestao->ativo = 1;
           $novaQuestao->save();

            return redirect()->route('adm.questoes.index')->with('success', 'Questão cadastrado com sucesso.');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questao  $questao
     * @return \Illuminate\Http\Response
     */
    public function show(Questao $questao)
    {
        //
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
            // $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $disciplinas = Disciplina::get();
            $topicos = Topico::get();

            return view('adm.questao.editar', compact('disciplinas', 'topicos', 'questao'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
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
    public function update(Request $request, $id)
    {
        try {
            if($request->id_disciplina == null || $request->id_topico == null){
                 return redirect()->back()->with('erro', ' Selecione uma Disciplina e um Tópico vinculado.');
            }
            if($request->descricao == null){
                 return redirect()->back()->with('erro', 'Campo Descrição é obrigatório.');
            }
             //  validacao dos campos
              $input = [
                 'descricao' => $request->descricao,
                 'codigo_questao' => $request->codigo_questao
             ];

             $rules = [
                 'descricao' => 'required|max:255',
                 'codigo_questao' => 'required|max:255'
             ];

             $messages = [
                 'descricao.required' => 'descricao é obrigatório.',
                 'descricao.max' => 'Máximo 255 caracteres.',

                 'codigo_questao.required' => 'Código questão é obrigatório.',
                 'codigo_questao.max' => 'Máximo 255 caracteres'
             ];

             $validaCampos = Validator::make($input, $rules, $messages);
             $validaCampos->validate();

            $questao = Questao::find($id);
            $questao->descricao = $request->descricao;
            $questao->id_topico = $request->id_topico;
            $questao->codigo_questao = strtoupper($request->codigo_questao);
            $questao->id_disciplina = $request->id_disciplina;
            $questao->titulo_questao = $request->titulo_questao;
            $questao->alteradoPorUsuario = auth()->user()->id;
            $questao->save();

             return redirect()->route('adm.questoes.index')->with('success', 'Questão alterado com sucesso.');

         } catch (\Exception $ex) {
            //  return $ex->getMessage();
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
            $questao->dataInativado = Carbon::now();
            $questao->inativadoPorUsuario = auth()->user()->id;
            $questao->motivoInativado = $request->motivo;
            $questao->ativo = 0;
            $questao->save();

            return redirect()->back()->with('success', 'Questão excluído com sucesso.');

        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu ao excluir a questão.');
        }
    }
}
