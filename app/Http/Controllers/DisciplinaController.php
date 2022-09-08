<?php

namespace App\Http\Controllers;

use App\CurricularEletiva;
use App\Disciplina;
use App\Periodo;
use App\Topico;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            $periodos = Periodo::where('ativo', '=', 1)->get();

            $disciplinas = Disciplina::where('ativo', '=', 1)
                            ->with('topicos')->get();
            // dd($disciplinas);

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
            $periodos = Periodo::where('ativo', '=', 1)->get();

            return view('adm.disciplinas.create', compact('periodos'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
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
            if($request->disciplina == null || $request->codigo == null || $request->id_periodo == null){
                return redirect()->back()->with('erro', 'Campos disciplina, código e período são obrigatórios.');
            }

            //verifica se existe uma disciplina cadastrada
            $verificarDisciplina = Disciplina::where('nome', '=', $request->disciplina)->first();

            if($verificarDisciplina){
                return redirect()->back()->with('erro', 'Existe uma disciplina cadastrado ao informado.');
            }

            $novaDisciplina = new Disciplina();
            $novaDisciplina->nome = $request->disciplina;
            $novaDisciplina->codigo = $request->codigo;
            $novaDisciplina->id_periodo = $request->id_periodo;
            $novaDisciplina->cadastradoPorUsuario = auth()->user()->id;
            $novaDisciplina->ativo = 1;
            $novaDisciplina->save();

            return redirect()->route('adm.disciplinas.index')->with('success', 'Disciplina cadastrado com sucesso.');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
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

            $disciplinaAlterada = Disciplina::find($id);
            $disciplinaAlterada->nome = $request->disciplina;
            $disciplinaAlterada->codigo = $request->codigo;
            $disciplinaAlterada->id_periodo = $request->id_periodo;
            $disciplinaAlterada->alteradoPorUsuario = auth()->user()->id;
            $disciplinaAlterada->save();

            return redirect()->back()->with('success', 'Disciplina alterada com sucesso');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
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
            //disciplina
            $d = Disciplina::find($id);
            $d->dataInativado = Carbon::now();
            $d->inativadoPorUsuario = auth()->user()->id;
            $d->motivoInativado = $request->motivo;
            $d->ativo = 0;
            $d->save();

            //tópicos
            foreach ($d->topicos as $top) {
                $top->dataInativado = Carbon::now();
                $top->inativadoPorUsuario = auth()->user()->id;
                $top->ativo = 0;
                $top->save();
            }

            // dd($d);

            return redirect()->back()->with('success', 'Disciplina excluído com sucesso.');

        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro ao listas as disciplinas');
        }
    }
}
