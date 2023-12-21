<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilUpdateRequest;
use App\Perfil;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = User::where('id', '=', auth()->user()->id)
                ->select('id', 'name', 'email', 'id_perfil')
                ->first();

            return view('adm.perfil.index', compact('user'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilUpdateRequest $request, $id)
    {
        try {

            $user = User::find($id);
            $user->name = $request->nome;
            $user->email = $request->email;

            if($request->password != null){

                if($request->password != $request->confirmacao){
                    return redirect()->back()->with('erro', 'Senhas não conferem.');
                }

                $tamanhoSenha = strlen($request->password);
                if($tamanhoSenha < 6){
                    return redirect()->back()->with('erro', 'Senhas menor que 6 caracteres.');
                }

                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->back()->with('success', 'Cadastro alterado com sucesso.');

        }

        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
