<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        try {
            return view('auth.login2');
        }
        catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro ao logar no sistema.');
        }
    }

    public function autenticacao(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors('E-mail ou senha de usuário com dados incorretos');
        };

        $usuario = User::where('email', '=', $request->email)
            ->select('id', 'email', 'id_perfil', 'ativo')
            ->where('ativo', User::ATIVO)
        ->first();
        
        if($usuario != null){
            //Se o usuário perfil é 1, redireciona para rota adm
            if($usuario->id_perfil == 1){
                return redirect('/adm/dashboard');
            }
            else{
                return redirect('/perfil');
            }
        }
        else{
            return redirect()->back()->with('erro', 'Usuário inexistente ou inativado.');
        }

    }

}
