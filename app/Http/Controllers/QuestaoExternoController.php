<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Questao;
use App\QuestaoExterno;
use App\Topico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            if(auth()->user()->id != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $topicos = Topico::where('ativo', '=', 1)->get();
            $questoes = Questao::where('ativo', '=', 1)->get();

            $minhasQuestoes = Questao::where('ativo', '=', 1)->where('cadastradoPorUsuario', '=', auth()->user()->id)->get();

            return view('usuario-externo.questao-externa.index', compact('questoes', 'disciplinas', 'topicos', 'minhasQuestoes'));

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
        try {
            // if(auth()->user()->id != 2){
            //     return redirect()->back()->with('erro', 'Acesso negado.');
            // }

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

            return redirect()->route('acesso_externo.questoes.index_externo')->with('success', 'Questão cadastrado com sucesso.');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestaoExterno  $questaoExterno
     * @return \Illuminate\Http\Response
     */
    public function show(QuestaoExterno $questaoExterno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestaoExterno  $questaoExterno
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestaoExterno $questaoExterno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestaoExterno  $questaoExterno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestaoExterno $questaoExterno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestaoExterno  $questaoExterno
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestaoExterno $questaoExterno)
    {
        //
    }
}
