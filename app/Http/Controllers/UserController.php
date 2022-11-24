<?php

namespace App\Http\Controllers;

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
    public function create(){
        try {

            return view('adm.usuario.create');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function createUser(){
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            return view('adm.usuario.create-user');

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function store(Request $request)
    {
        try {
            //validacao dos campos
            $input = [
                'name' => $request->nome,
                'email' => $request->email,
                'password' => $request->password,
                'confirmacao' =>$request->confirmacao
            ];

            $regras = [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'password' => 'required|min:6',
                'confirmacao' => 'required|min:6'
            ];

            $mensagens = [
                'name.required' => 'O nome é obrigatório.',
                'name.max' => 'Máximo 255 caracteres.',

                'email.required' => 'O email é obrigatório.',
                'email.max' => 'Máximo 255 caracteres',

                'password.required' => 'Asenha é obrigatória.',
                'password.min' => 'Minímo 6 caracteres',

                'confirmacao.required' => 'Confirmação é obrigatória',
                'confirmacao.min' => 'Minímo 6 caracteres',
            ];

            $validaCampos = Validator::make($input, $regras, $mensagens);
            $validaCampos->validate();

            $verificacaoEmail = User::where('email', '=', $request->email)
                ->select('name', 'email')
                ->first();

            //verifica se existe um email cadastrado
            if($verificacaoEmail){
                return redirect()->back()->with('erro', 'E-mail cadastrado no sistema.');
            }

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

            if($request->id_perfil){
                //administrador
                $novoUsuario->id_perfil = 1;
            }
            else{
                //usuário externo
                $novoUsuario->id_perfil = 2;
            }

            $novoUsuario->ativo = 1;
            $novoUsuario->save();

            //se não existe um usuário autenticado no sistema
            if(!Auth::check()){
                return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso.');

            }
            //se existe usuário autenticado, redireciona a tela de login
            return redirect()->route('adm.usuario.listagem_usuarios')->with('success', 'Cadastro realizado com sucesso.');

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

    public function listagemUsuarios()
    {
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $usuarios = User::where('ativo', '=', 1)->get();

            return view('adm.usuario.listagem-usuarios', compact('usuarios'));

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function edit($id)
    {
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

            $user = User::find($id);
            $perfils = Perfil::where('ativo', '=', 1)->get();

            return view('adm.usuario.edit', compact('user', 'perfils'));

        } catch (\Exception $ex) {
            return $ex->getMessage();
            // return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }
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

            if($user->id_perfil == 2){
                return redirect()->route('perfil')->with('success', 'Cadastro alterado com sucesso.');
            }

            return redirect()->route('adm.usuario.listagem_usuarios')->with('success', 'Cadastro alterado com sucesso.');

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

    public function destroy(Request $request, $id)
    {
        try {
            if(auth()->user()->id_perfil != 1){
                return redirect()->back()->with('erro', 'Acesso negado.');
            }

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

        } catch (\Exception $ex) {
            // return $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro, entre em contato com o adm.');
        }
    }

}
