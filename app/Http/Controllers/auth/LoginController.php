<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index() {
        return view('auth.login');
    }

    public function autenticacao(Request $request) {

        if (!Auth::attempt($request->only(['email', 'password']))) {

            return redirect()->back()->withErrors('Email de usuário ou Senha com dados incorretos');
        };

        // return redirect('/home');
        return view('teste');

    }

}
