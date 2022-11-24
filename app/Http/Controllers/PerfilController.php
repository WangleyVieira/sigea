<?php

namespace App\Http\Controllers;

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
    public function update(Request $request, $id)
    {
        try {
            //validacao dos campos
            $input = [
                'name' => $request->nome,
                'email' => $request->email,
                // 'password' => $request->password,
                // 'confirmacao' =>$request->confirmacao
            ];

            $regras = [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                // 'password' => 'required|min:6',
                // 'confirmacao' => 'required|min:6'
            ];

            $mensagens = [
                'name.required' => 'O nome é obrigatório.',
                'name.max' => 'Máximo 255 caracteres.',

                'email.required' => 'O email é obrigatório.',
                'email.max' => 'Máximo 255 caracteres',

                // 'password.required' => 'Asenha é obrigatória.',
                // 'password.min' => 'Minímo 6 caracteres',

                // 'confirmacao.required' => 'Confirmação é obrigatória',
                // 'confirmacao.min' => 'Minímo 6 caracteres',
            ];

            $validaCampos = Validator::make($input, $regras, $mensagens);
            $validaCampos->validate();

             $verificacao_user = User::where('email', '=', $request->email)
                ->select('id', 'name', 'email')
                ->first();

            //verifica se existe um email cadastrado
            if($verificacao_user){
                if($verificacao_user->id != $id){
                    return redirect()->back()->with('erro', 'Existe e-mail cadastrado no sistema.');
                }
            }

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
        catch (ValidationException $e ) {
            $message = $e->errors();
            return redirect()->back()
                ->withErrors($message)
                ->withInput();
        }
        catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
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
