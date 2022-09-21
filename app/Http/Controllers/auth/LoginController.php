<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index() {

        try {
            return view('auth.login');
            // return view('auth.login2');
        } catch (\Exception $ex) {
            // $ex->getMessage();
            return redirect()->back()->with('erro', 'Ocorreu um erro ao logar no sistema.');
        }
    }

    public function autenticacao(Request $request) {

        if (!Auth::attempt($request->only(['email', 'password']))) {

            return redirect()->back()->withErrors('Email de usuário ou Senha com dados incorretos');
        };

        // return view('home');
        return redirect()->route('dashboard');

    }

}
