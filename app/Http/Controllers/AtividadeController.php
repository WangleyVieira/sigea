<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\AtividadeQuestao;
use App\Disciplina;
use App\Http\Requests\AtividadeStoreRequest;
use App\Questao;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $atividadesExternas = Atividade::where('ativo', '=', Atividade::ATIVO)->where('cadastradoPorUsuario', '!=', auth()->user()->id)->get();
            $minhasAtividades = Atividade::where('ativo', '=', Atividade::ATIVO)->where('cadastradoPorUsuario', '=', auth()->user()->id)->get();

            return view('adm.atividade.index', compact('atividadesExternas', 'minhasAtividades'));

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

            $questoes = Questao::where('ativo', '=', Questao::ATIVO)->get();
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->get();

            return view('adm.atividade.create', compact('disciplinas', 'questoes'));

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
    public function storeAtividade(AtividadeStoreRequest $request)
    {
        try {

            $atividadeCadastrada = Atividade::create($request->validated() + [
                'cadastradoPorUsuario' => Auth::user()->id,
                'ativo' => Atividade::ATIVO
            ]);

            $questoesVincular = $request->id_questao;

            for ($i = 0; $i < Count($questoesVincular); $i++) {

                AtividadeQuestao::create([
                    'id_atividade' => $atividadeCadastrada->id,
                    'id_questao' => $questoesVincular[$i],
                    'ativo' => AtividadeQuestao::ATIVO
                ]);
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

            $atividade = Atividade::findOrFail($id);
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

            $atividadeAtualizar = Atividade::findOrFail($id);
            $atividadeAtualizar->update([
                'descricao' => $request->descricao_atividade,
                'titulo_atividade' => $request->titulo_atividade,
                'alteradoPorUsuario' => Auth::user()->id,
                'ativo' => Atividade::ATIVO
            ]);

            $questoesAtualizar = $request->id_questao;

            if($questoesAtualizar != null){

                for ($i = 0; $i < Count($questoesAtualizar); $i++) {

                    $atv = Questao::where('id', '=', $questoesAtualizar[$i])->where('ativo', '=', Questao::ATIVO)->first();

                    if($atv){
                        //se não for questao desta atividade, adiciona
                        if($atv->pertencenteAtividade($id) == 0){
                            AtividadeQuestao::create([
                                'id_atividade' => $atividadeAtualizar->id,
                                'id_questao' => $questoesAtualizar[$i],
                                'ativo' => AtividadeQuestao::ATIVO,
                            ]);
                        }
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

            $atividade = Atividade::findOrFail($id);
            $atividade->update([
                'motivoInativado' => $request->motivo,
                'inativadoPorUsuario' => Auth::user()->id,
                'dataInativado' => Carbon::now(),
                'ativo' => Atividade::INATIVO
            ]);

            return redirect()->route('adm.atividades.index')->with('success', 'Atividade excluído com sucesso.');

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

            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('adm.atividade.pdf-atividade', compact('atividade', 'atividadeQuestoes'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Atividade - ' .$atividade->titulo_atividade. ' - ' .$dataFormatada. '.pdf', 'I');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }

    // public function pdfAtividadeExterna($id)
    // {
    //     try {
    //         if(auth()->user()->id_perfil != 1){
    //             return redirect()->back()->with('erro', 'Acesso negado.');
    //         }

    //         $atividades = Atividade::find($id);
    //         $atividadeQuestoes = AtividadeQuestao::where('ativo', '=', 1)->where('id_atividade', '=', $atividades->id)->get();

    //         $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

    //         $now = Carbon::now();
    //         $html = view('adm.atividade.pdf-atividade-externa', compact('atividades', 'atividadeQuestoes'));
    //         $mpdf->WriteHTML($html);

    //         return $mpdf->Output('Atividade - ' .$now . '.pdf', 'I');

    //     } catch (\Exception $ex) {
    //         return $ex->getMessage();
    //         // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
    //     }
    // }

    public function gabarito($id)
    {
        try {

            $atividade = Atividade::find($id);
            $atividadeQuestoes = AtividadeQuestao::where('id_atividade', '=', $atividade->id)->where('ativo', '=', AtividadeQuestao::ATIVO)->get();

            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

            $now = Carbon::now();
            $dataFormatada = $now->format('d/m/Y H:i:s');
            $html = view('adm.atividade.gabarito', compact('atividade', 'atividadeQuestoes'));
            $mpdf->WriteHTML($html);

            return $mpdf->Output('Resposta - ' .$atividade->titulo_atividade . '-' .$dataFormatada. '.pdf', 'I');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com Adm.');
        }
    }
}
