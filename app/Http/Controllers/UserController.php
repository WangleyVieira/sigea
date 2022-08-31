<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        try {

            return view('usuario.index');

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function store(Request $request)
    {
        try {
            dd('Olá');

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


}
