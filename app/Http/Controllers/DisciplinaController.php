<?php

namespace App\Http\Controllers;

use App\CurricularEletiva;
use App\Disciplina;
use App\Http\Requests\DisciplinaStoreRequest;
use App\Periodo;
use App\Questao;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Tag\Toc;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $periodos = Periodo::where('ativo', '=', Periodo::ATIVO)->get();
            $disciplinas = Disciplina::where('ativo', '=', Disciplina::ATIVO)->with('topicos')->get();

            return view('adm.disciplinas.index', compact('disciplinas', 'periodos'));

        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro ao listas as disciplinas');
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

            $periodos = Periodo::where('ativo', '=', Periodo::ATIVO)->get();

            return view('adm.disciplinas.create', compact('periodos'));

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplinaStoreRequest $request)
    {
        try {

            Disciplina::create($request->validated() + [
                'cadastradoPorUsuario' => Auth::user()->id,
                'ativo' => Disciplina::ATIVO
            ]);

            return redirect()->route('adm.disciplinas.index')->with('success', 'Disciplina cadastrado com sucesso.');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplina $disciplina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplina $disciplina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            if($request->disciplina == null || $request->codigo == null || $request->id_periodo == null){
                return redirect()->back()->with('erro', 'Campos disciplina, código e período são obrigatórios.');
            }

            $disciplinaAlterada = Disciplina::findOrFail($id);

            $disciplinaAlterada->update([
                'nome' => $request->disciplina,
                'codigo' => $request->codigo,
                'id_periodo' => $request->id_periodo,
                'alteradoPorUsuario' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Disciplina alterada com sucesso');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            // Inicie a transação
            DB::beginTransaction();

            // Atualize o primeiro registro
            $d = Disciplina::findOrFail($id);
            $d->update([
                'dataInativado' => Carbon::now(),
                'inativadoPorUsuario' => Auth::user()->id,
                'motivoInativado' => $request->motivo,
                'ativo' => Disciplina::INATIVO
            ]);

            // Atualize o segundo registro
            $topicos = Topico::where('id_disciplina', '=', $d->id)->where('ativo', '=', Topico::ATIVO)->get();
            foreach ($topicos as $top) {
                $top->update([
                    'dataInativado' => Carbon::now(),
                    'inativadoPorUsuario' => Auth::user()->id,
                    'motivoInativado' => 'Desvinculado da disciplina',
                    'ativo' => Topico::INATIVO
                ]);
            }

            // Atualize o terceiro registro
            $questoes = Questao::where('id_disciplina', '=', $d->id)->where('ativo', '=', Questao::ATIVO)->get();
            foreach ($questoes as $questao) {
                $questao->update([
                    'dataInativado' => Carbon::now(),
                    'inativadoPorUsuario' => Auth::user()->id,
                    'motivoInativado' => 'Desvinculado da disciplina',
                    'ativo' => Questao::INATIVO
                ]);
            }

            // Commit da transação se todas as operações foram bem-sucedidas
            DB::commit();

            // Redirecione ou retorne uma resposta de sucesso
            return redirect()->back()->with('success', 'Disciplina excluído com sucesso.');

        }
        catch (\Exception $ex) {
            // Se algo der errado, reverta as alterações (rollback) na transação
            DB::rollback();

            // Trate a exceção ou redirecione para uma página de erro
            return redirect()->back()->with('erro', 'Ocorreu ao excluir ao excluir a disciplina.');
        }
    }
}
