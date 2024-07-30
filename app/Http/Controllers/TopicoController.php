<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Http\Requests\TopicoStoreRequest;
use App\Topico;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
            $disciplinas = Disciplina::with('topicos')->where('ativo', '=', Disciplina::ATIVO)->get();
            return view('adm.topico.index', compact('disciplinas'));

        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicoStoreRequest $request)
    {
        try {
            Topico::create($request->validated() + [
                'cadastradoPorUsuario' => Auth::user()->id
            ]);
            return redirect()->back()->with('success', 'Tópico cadastrado com sucesso.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topico  $topico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $top = Topico::find($id);
            $top->update([
                'descricao' => $request->topico,
                'alteradoPorUsuario' => Auth::user()->id
            ]);
            return redirect()->back()->with('success', 'Tópico alterado com sucesso.');

        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
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
            $top->update([
                'inativadoPorUsuario' => auth()->user()->id,
                'dataInativado' => Carbon::now(),
                'ativo' => Topico::INATIVO,
                'motivoInativado' => $request->motivo
            ]);
            return redirect()->back()->with('success', 'Tópico excluído com sucesso');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro ao excluir o tópico.');
        }
    }
}
