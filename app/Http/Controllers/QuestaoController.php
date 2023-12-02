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
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->get();
            $questoes = Questao::where('cadastradoPorUsuario', '!=', Auth::user()->id)->where('ativo', '=', Questao::ATIVO)->get();
            $minhasQuestoes = Questao::where('cadastradoPorUsuario', '=', Auth::user()->id)->where('ativo', '=', Questao::ATIVO)->get();

            // $questoes = Disciplina::where('ativo', '=', 1)->with('topicos')->with('questoes')->get();

            return view('adm.questao.index', compact('questoes', 'disciplinas', 'topicos', 'minhasQuestoes'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
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
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }
            // $disciplinas = Disciplina::where('ativo', '=', 1)->with('topicos')->get();
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $topicos = Topico::where('ativo', '=', Topico::ATIVO)->get();

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

            return redirect()->route('adm.questoes.index')->with('success', 'Questão cadastrado com sucesso.');

        }
        catch (\Exception $ex) {
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
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $questao = Questao::find($id);
            // $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $topicos = Topico::where('ativo', '=',Topico::ATIVO)->get();

            return view('adm.questao.editar', compact('disciplinas', 'topicos', 'questao'));

        }
        catch (\Exception $ex) {
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
    public function update(QuestaoUpdateRequest $request, $id)
    {
        try {
            $questao = Questao::find($id);
            $questao->descricao = $request->descricao;
            // $questao->id_topico = $request->id_topico;
            $questao->resposta = $request->resposta;
            // $questao->codigo_questao = strtoupper($request->codigo_questao);
            $questao->titulo_questao = $request->titulo_questao;
            $questao->alteradoPorUsuario = Auth::user()->id;
            $questao->save();

            return redirect()->route('adm.questoes.index')->with('success', 'Questão alterado com sucesso.');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
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
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $questao = Questao::find($request->id);
            $questao->dataInativado = Carbon::now();
            $questao->inativadoPorUsuario = Auth::user()->id;
            $questao->motivoInativado = $request->motivo;
            $questao->ativo = Questao::INATIVO;
            $questao->save();

            return redirect()->back()->with('success', 'Questão excluído com sucesso.');

        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu ao excluir a questão.');
        }
    }

    // public function visualizarQuestao($id)
    // {
    //     try {
    //         if(auth()->user()->id_perfil != 1){
    //             return redirect()->back()->with('erro', 'Acesso negado.');
    //         }
    //         $minhaQuestao = Questao::find($id);
    //         $disciplinas = Disciplina::where('ativo', '=', 1)->get();
    //         $topicos = Topico::where('ativo', '=', 1)->get();

    //         $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

    //         $now = Carbon::now();
    //         $html = view('adm.questao.pdf-questao', compact('minhaQuestao', 'disciplinas', 'topicos'));
    //         $mpdf->WriteHTML($html);

    //         return $mpdf->Output('Questão - ' .$now . '.pdf', 'I');

    //     } catch (\Exception $ex) {
    //         // return $ex->getMessage();
    //         return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
    //     }
    // }

    // public function visualizarQuestaoExterna($id)
    // {
    //     try {
    //         if(auth()->user()->id_perfil != 1){
    //             return redirect()->back()->with('erro', 'Acesso negado.');
    //         }

    //         $questao = Questao::find($id);
    //         $disciplinas = Disciplina::where('ativo', '=', 1)->get();
    //         $topicos = Topico::where('ativo', '=', 1)->get();

    //         $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

    //         $now = Carbon::now();
    //         $html = view('adm.questao.pdf-questao-externa', compact('questao', 'disciplinas', 'topicos'));
    //         $mpdf->WriteHTML($html);

    //         return $mpdf->Output('Questão - ' .$now . '.pdf', 'I');

    //     } catch (\Exception $ex) {
    //         // return $ex->getMessage();
    //         return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
    //     }
    // }
}
