<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Topico;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TopicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $topicos = Topico::where('ativo', '=', 1)->with('disciplina')->get();
            $disciplinas = Disciplina::where('ativo', '=', 1)->with('topicos')->get();

            // dd($disciplinas);
            return view('topico.index', compact('disciplinas'));

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
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
            if($request->descricao == null){
                return redirect()->back()->with('erro', 'Campo descrição obrigatório.');
            }
            $novoTopico = new Topico();
            $novoTopico->descricao = $request->descricao;
            $novoTopico->id_disciplina = $request->id;
            $novoTopico->cadastradoPorUsuario = auth()->user()->id;
            $novoTopico->ativo = 1;
            // dd($novoTopico);
            $novoTopico->save();

            return redirect()->back()->with('success', 'Tópico cadastrado com sucesso.');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topico  $topico
     * @return \Illuminate\Http\Response
     */
    public function show(Topico $topico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topico  $topico
     * @return \Illuminate\Http\Response
     */
    public function edit(Topico $topico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topico  $topico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topico $topico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topico  $topico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $top = Topico::find($id);
            $top->inativadoPorUsuario = auth()->user()->id;
            $top->dataInativado = Carbon::now();
            $top->ativo = 0;
            $top->motivoInativado = $request->motivo;
            $top->save();

            return redirect()->back()->with('success', 'Tópico excluído com sucesso');

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro ao excluir o tópico.');
        }
    }
}
