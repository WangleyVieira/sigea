<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AtividadeQuestao;
use App\Disciplina;
use App\Questao;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

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
            if(auth()->user()->id != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }
            // $atividades = Disciplina::where('ativo', '=', 1)
            //     ->with('atividades')
            //     ->with('questoes')
            //     ->get();

            $atividades = Atividade::where('ativo', '=', 1)->where('cadastradoPorUsuario', '!=', auth()->user()->id)->get();
            $minhasAtividades = Atividade::where('ativo', '=', 1)->where('cadastradoPorUsuario', '=', auth()->user()->id)->get();

            return view('adm.atividade.index', compact('atividades', 'minhasAtividades'));

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
            if(auth()->user()->id != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

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
            if(auth()->user()->id != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

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
                $vincularQuestaoAtividade->ativo = 1;
                $vincularQuestaoAtividade->save();
            }

            return redirect()->route('adm.atividades.index')->with('success', 'Cadastro realizado com sucesso.');

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
    public function edit(Request $request, $id)
    {
        try {
            if(auth()->user()->id != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $atividade = Atividade::find($id);
            $disciplinas = Disciplina::where('ativo', '=', 1)->get();
            $atividadeQuestoes = AtividadeQuestao::where('ativo', '=', 1)->where('id_atividade', '=', $atividade->id)->get();
            $questaoAtv = Questao::where('ativo', '=', 1)->get();

            $questoesArray = array();

            foreach($questaoAtv as $q){
                //verifica se a questão é pertencente a atividade
                if($q->pertencenteAtividade($atividade->id) == false){
                    array_push($questoesArray, $q);
                }
            }

            return view('adm.atividade.edit', compact('atividade', 'disciplinas', 'atividadeQuestoes', 'questoesArray'));

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
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
            if(auth()->user()->id != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            if($request->id_questao == null){
                return redirect()->back()->with('erro', 'Selecione a questão para cadastrar a atividade.');
            }

            $atividadeAtualizar = Atividade::find($id);
            $atividadeAtualizar->descricao = $request->descricao_atividade;
            $atividadeAtualizar->titulo_atividade = $request->titulo_atividade;
            $atividadeAtualizar->alteradoPorUsuario = auth()->user()->id;
            $atividadeAtualizar->ativo = 1;
            $atividadeAtualizar->save();

            $questoesAtualizar = $request->id_questao;

            for ($i = 0; $i < Count($questoesAtualizar); $i++) {

                $atv = Questao::where('id', '=', $questoesAtualizar[$i])->where('ativo', '=', 1)->first();

                if($atv){
                    //se não for questao desta atividade, adiciona
                    if($atv->pertencenteAtividade($id) == 0){
                        $questaoAtividadeAtualizar = new AtividadeQuestao();
                        $questaoAtividadeAtualizar->id_atividade = $atividadeAtualizar->id;
                        $questaoAtividadeAtualizar->id_questao = $questoesAtualizar[$i];
                        $questaoAtividadeAtualizar->ativo = 1;
                        $questaoAtividadeAtualizar->save();
                    }
                }

            }

            return redirect()->route('adm.atividades.index')->with('success', 'Atividade atualizado com sucesso.');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
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
            if(auth()->user()->id != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $atividade = Atividade::find($id);
            $atividade->motivoInativado = $request->motivo;
            $atividade->inativadoPorUsuario = auth()->user()->id;
            $atividade->dataInativado = Carbon::now();
            $atividade->ativo = 0;
            $atividade->save();

            return redirect()->route('adm.atividades.index')->with('success', 'Atividade excluído com sucesso.');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    public function pdfAtividade($id)
    {
        try {
            if(auth()->user()->id != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $atividade = Atividade::find($id);
            $atividadeQuestoes = AtividadeQuestao::where('ativo', '=', 1)->where('id_atividade', '=', $atividade->id)->get();
            $questaoAtv = Questao::where('ativo', '=', 1)->get();

            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

            // Define a default page size/format by array - page will be 190mm wide x 236mm height
            // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297]]);

            $now = Carbon::now();
            $html = view('adm.atividade.pdf-atividade', compact('atividade', 'atividadeQuestoes', 'questaoAtv'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Atividade - ' .$now . '.pdf', 'I');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }
}
