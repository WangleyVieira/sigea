<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Questao;
use App\QuestaoExterno;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            if(auth()->user()->id_perfil != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $topicos = Topico::where('ativo', '=', 1)->get();
            $questoes = Questao::where('cadastradoPorUsuario', '!=', auth()->user()->id)->where('ativo', '=', 1)->get();
            $minhasQuestoes = Questao::where('cadastradoPorUsuario', '=', auth()->user()->id)->where('ativo', '=', 1)->get();

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
            if(auth()->user()->id_perfil != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

           if($request->id_disciplina == null || $request->id_topico == null){
                return redirect()->back()->with('erro', ' Selecione uma Disciplina e um Tópico vinculado.');
           }

            //  validacao dos campos
             $input = [
                'descricao' => $request->descricao,
                'codigo_questao' => $request->codigo_questao,
                'resposta' => $request->resposta
            ];

            $rules = [
                'descricao' => 'required|max:1200',
                'codigo_questao' => 'required|max:255',
                'resposta' => 'required|max:1200'
            ];

            $messages = [
                'descricao.required' => 'descricao é obrigatório.',
                'descricao.max' => 'Máximo 1200 caracteres.',

                'codigo_questao.required' => 'Código questão é obrigatório.',
                'codigo_questao.max' => 'Máximo 255 caracteres',

                'resposta.required' => 'Resposta da questão é obrigatório.',
                'resposta.max' => 'Máximo 255 caracteres'
            ];

            $validaCampos = Validator::make($input, $rules, $messages);
            $validaCampos->validate();

            //verifica se existe um código cadastrado
            $verificarCodigoQuestao = Questao::where('codigo_questao', '=', $request->codigo_questao)
                ->where('ativo', '=', 1)
                ->select('codigo_questao')
                ->first();

            if($verificarCodigoQuestao){
                return redirect()->back()->with('erro', 'Código questão está vinculado já.');
            }

           $novaQuestao = new Questao();
           $novaQuestao->descricao = $request->descricao;
           $novaQuestao->id_topico = $request->id_topico;
           $novaQuestao->resposta = $request->resposta;
           $novaQuestao->codigo_questao = strtoupper($request->codigo_questao);
           $novaQuestao->id_disciplina = $request->id_disciplina;
           $novaQuestao->titulo_questao = $request->titulo_questao;
           $novaQuestao->cadastradoPorUsuario = auth()->user()->id;
           $novaQuestao->ativo = 1;
           $novaQuestao->save();

            return redirect()->route('acesso_externo.questoes.index_externo')->with('success', 'Questão cadastrado com sucesso.');

        }
        catch (ValidationException $e ) {
            $message = $e->errors();
            return redirect()->back()
                ->withErrors($message)
                ->withInput();
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
            if(auth()->user()->id_perfil != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $questao = Questao::find($id);
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $topicos = Topico::where('ativo', '=', 1)->get();

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
    public function update(Request $request, $id)
    {
        try {
            if(auth()->user()->id_perfil != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

             //  validacao dos campos
              $input = [
                 'descricao' => $request->descricao,
                //  'codigo_questao' => $request->codigo_questao,
                 'resposta' => $request->resposta,
             ];

             $rules = [
                 'descricao' => 'required|max:255',
                //  'codigo_questao' => 'required|max:255',
                 'resposta' => 'required|max:1200'
             ];

             $messages = [
                 'descricao.required' => 'descricao da pergunta é obrigatório.',
                 'descricao.max' => 'Máximo 255 caracteres.',

                //  'codigo_questao.required' => 'Código questão é obrigatório.',
                //  'codigo_questao.max' => 'Máximo 255 caracteres',

                 'resposta.required' => 'Resposta da questão é obrigatório.',
                 'resposta.max' => 'Máximo 1200 caracteres'
             ];

             $validaCampos = Validator::make($input, $rules, $messages);
             $validaCampos->validate();

            $questao = Questao::find($id);
            $questao->descricao = $request->descricao;
            // $questao->id_topico = $request->id_topico;
            $questao->resposta = $request->resposta;
            // $questao->codigo_questao = strtoupper($request->codigo_questao);
            // $questao->id_disciplina = $request->id_disciplina;
            $questao->titulo_questao = $request->titulo_questao;
            $questao->alteradoPorUsuario = auth()->user()->id;
            $questao->save();

             return redirect()->route('acesso_externo.questoes.index_externo')->with('success', 'Questão alterado com sucesso.');

         }
         catch (ValidationException $e ) {
            $message = $e->errors();
            return redirect()->back()
                ->withErrors($message)
                ->withInput();
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
            if(auth()->user()->id_perfil != 2){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

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
