<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AtividadeQuestao;
use App\Disciplina;
use App\Questao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class AtividadeExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $atividades = Atividade::where('cadastradoPorUsuario', '!=', auth()->user()->id)->where('ativo', '=', 1)->get();
            $minhasAtividades = Atividade::where('cadastradoPorUsuario', '=', auth()->user()->id)->where('ativo', '=', 1)->get();
            return view('usuario-externo.atividade-externo.index', compact('atividades', 'minhasAtividades'));
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
            $questoes = Questao::where('ativo', '=', Questao::ATIVO)->get();
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            return view('usuario-externo.atividade-externo.create', compact('disciplinas', 'questoes'));
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
    public function store(Request $request)
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
                $vincularQuestaoAtividade->ativo = 1;
                $vincularQuestaoAtividade->save();
            }

            return redirect()->route('acesso_externo.atividades.index')->with('success', 'Cadastro realizado com sucesso.');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AtividadeExterno  $atividadeExterno
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $atividade = Atividade::find($id);
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();
            $atividadeQuestoes = AtividadeQuestao::where('id_atividade', '=', $atividade->id)->where('ativo', '=', AtividadeQuestao::ATIVO)->get();
            $questaoAtv = Questao::where('id_disciplina', '=', $atividade->id_disciplina)->where('ativo', '=', Questao::ATIVO)->get();
            $questoesArray = array();
            foreach($questaoAtv as $q){
                //verifica se a questão é pertencente a atividade
                if($q->pertencenteAtividade($atividade->id) == false){
                    array_push($questoesArray, $q);
                }
            }
            return view('usuario-externo.atividade-externo.edit', compact('atividade', 'disciplinas', 'atividadeQuestoes', 'questoesArray'));

        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AtividadeExterno  $atividadeExterno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $atividadeAtualizar = Atividade::find($id);
            $atividadeAtualizar->descricao = $request->descricao_atividade;
            $atividadeAtualizar->titulo_atividade = $request->titulo_atividade;
            $atividadeAtualizar->alteradoPorUsuario = auth()->user()->id;
            $atividadeAtualizar->ativo = 1;
            $atividadeAtualizar->save();
            $questoesAtualizar = $request->id_questao;
            if($questoesAtualizar != null){
                for ($i = 0; $i < Count($questoesAtualizar); $i++) {
                    $atv = Questao::where('id', '=', $questoesAtualizar[$i])->where('ativo', '=', Questao::ATIVO)->first();
                    if($atv){
                        //se não for questao desta atividade, adiciona
                        if($atv->pertencenteAtividade($id) == 0){
                            Atividade::create([
                                'id_atividade' => $atividadeAtualizar->id,
                                'id_questao' => $questoesAtualizar[$i]
                            ]);
                        }
                    }
                }
            }
            return redirect()->route('acesso_externo.atividades.index')->with('success', 'Atividade atualizado com sucesso.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AtividadeExterno  $atividadeExterno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $atividade = Atividade::find($id);
            $atividade->motivoInativado = $request->motivo;
            $atividade->inativadoPorUsuario = auth()->user()->id;
            $atividade->dataInativado = Carbon::now();
            $atividade->ativo = 0;
            $atividade->save();

            return redirect()->route('acesso_externo.atividades.index')->with('success', 'Atividade excluído com sucesso.');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    public function pdfAtividade($id)
    {
        try {

            $atividade = Atividade::find($id);
            $atividadeQuestoes = AtividadeQuestao::where('id_atividade', '=', $atividade->id)->where('ativo', '=', AtividadeQuestao::ATIVO)->get();
            $questaoAtv = Questao::where('ativo', '=', 1)->get();
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('usuario-externo.atividade-externo.pdf-atividade', compact('atividade', 'atividadeQuestoes', 'questaoAtv'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Atividade - ' .$atividade->titulo_atividade. ' - ' .$dataFormatada. '.pdf', 'I');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    public function gabarito($id)
    {
        try {
            $atividade = Atividade::find($id);
            $atividadeQuestoes = AtividadeQuestao::where('id_atividade', '=', $atividade->id)->where('ativo', '=', AtividadeQuestao::ATIVO)->get();
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('usuario-externo.atividade-externo.gabarito', compact('atividade', 'atividadeQuestoes'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Resposta - ' .$atividade->titulo_atividade . '-' .$dataFormatada. '.pdf', 'I');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }
}
