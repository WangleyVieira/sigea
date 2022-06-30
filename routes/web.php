<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Login
Route::get('/', 'Auth\LoginController@index')->name('login');
Route::post('/autenticacao', 'Auth\LoginController@autenticacao')->name('login.autenticacao');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
