<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index() {

        try {
            // return view('auth.login');
            return view('auth.login2');
        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro ao logar no sistema.');
        }
    }

    public function autenticacao(Request $request) {

        if (!Auth::attempt($request->only(['email', 'password']))) {

            return redirect()->back()->withErrors('Email de usuário ou Senha com dados incorretos');
        };

        $usuario = User::where('email', '=', $request->email)
            ->where('ativo', '=', 1)
            ->select('id', 'email', 'id_perfil')
            ->first();

        //Se o usuário perfil é 1, redireciona para rota adm
        if($usuario->id_perfil == 1){
            return redirect('/adm/dashboard');
        }
        else{
            return redirect('/perfil');
        }

    }

}
