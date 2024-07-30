<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreExterno;
use App\Http\Requests\UserStoreRequest;
use App\Perfil;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function create()
    {
        try {
            return view('adm.usuario.create');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function createUser()
    {
        try {
            return view('adm.usuario.create-user');

        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $novoUsuario = new User();

            if($request->password != null){
                //verificação de senhas
                if($request->password != $request->confirmacao){
                    return redirect()->back()->with('erro', 'Senhas não conferem.');
                }

                $tamanhoSenha = strlen($request->password);
                if($tamanhoSenha < 6){
                    return redirect()->back()->with('erro', 'Senha fraca! Insira uma no minímo 6 caracteres.');
                }
                $novoUsuario->password = Hash::make($request->password);
            }

            $novoUsuario->name = $request->nome;
            $novoUsuario->email = $request->email;

            if($request->id_perfil == 1){
                //administrador
                $novoUsuario->id_perfil = 1;
            }
            else{
                //usuário externo
                $novoUsuario->id_perfil = 2;
            }

            $novoUsuario->ativo = User::ATIVO;
            $novoUsuario->save();

            //se não existe um usuário autenticado no sistema
            if(!Auth::check()){
                return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso.');

            }
            //se existe usuário autenticado, redireciona a tela de login
            return redirect()->route('adm.usuario.listagem_usuarios')->with('success', 'Cadastro realizado com sucesso.');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function storeExterno(UserStoreExterno $request)
    {
        try {
            $novoUsuario = new User();
            if($request->password != null){
                //verificação de senhas
                if($request->password != $request->confirmacao){
                    return redirect()->back()->with('erro', 'Senhas não conferem.');
                }

                $tamanhoSenha = strlen($request->password);
                if($tamanhoSenha < 6){
                    return redirect()->back()->with('erro', 'Senha fraca! Insira uma no minímo 6 caracteres.');
                }

                $novoUsuario->password = Hash::make($request->password);
            }

            $novoUsuario->name = $request->nome;
            $novoUsuario->email = $request->email;
            $novoUsuario->id_perfil = Perfil::USUARIO_EXTERNO;
            $novoUsuario->ativo = User::ATIVO;
            $novoUsuario->save();

            return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso.');

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function listagemUsuarios()
    {
        try {
            $usuarios = User::where('ativo', '=', User::ATIVO)->get();
            $usuarios_inativos = User::where('ativo', '=', User::INATIVO)->get();
            return view('adm.usuario.listagem-usuarios', compact('usuarios', 'usuarios_inativos'));
        }
         catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function edit($id)
    {
        try {
            $user = User::find($id);
            $perfils = Perfil::where('ativo', '=', 1)->get();
            return view('adm.usuario.edit', compact('user', 'perfils'));
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function update(UserStoreRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->id_perfil = $request->id_perfil;

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

            if(Auth::user()->id_perfil == 2){
                return redirect()->route('perfil')->with('success', 'Cadastro alterado com sucesso.');
            }

            if(Auth::user()->id_perfil == 1){
                return redirect()->route('adm.usuario.listagem_usuarios')->with('success', 'Cadastro alterado com sucesso.');
            }

        }
        catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $usuario = User::find($id);

            if(auth()->user()->id == $usuario->id) {
                return redirect()->back()->with('erro', 'Não é possível excluir administrador logado no sistema.');
            }

            $usuario->motivoInativado = $request->motivo;
            $usuario->inativadoPorUsuario = auth()->user()->id;
            $usuario->dataInativado = Carbon::now();
            $usuario->ativo = 0;
            $usuario->save();

            return redirect()->back()->with('success', 'Usuário excluído com sucesso');

        }
        catch (\Exception $ex) {
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

}
