<?php

use App\Http\Controllers\QuestaoController;
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
    return view('pagina-inicial');
});

//Login
Route::get('/', 'Auth\LoginController@index')->name('login');
Route::post('/home', 'Auth\LoginController@autenticacao')->name('login.autenticacao');
Route::post('/logout', 'Auth\LogoutController@logout')->name('logout');

//perfil
Route::get('/perfil', 'PerfilController@index')->name('perfil');
Route::get('/dashboard', 'PerfilController@show')->name('dashboard');

// //Disciplinas
// Route::group(['prefix' => '/disciplinas', 'as' => 'disciplinas.', 'middleware' => 'auth'], function(){
//     Route::get('', 'DisciplinaController@index')->name('index');
// });

// //Questão
// Route::group(['prefix' => '/questoes', 'as' => 'questoes.', 'middleware' => 'auth'], function(){
//     Route::get('', 'QuestaoController@index')->name('index');
// });

//Acesso ADM
Route::group(['prefix' => '/adm', 'as' => 'adm.', 'middleware' => 'auth'], function(){

        //Disciplinas
    Route::group(['prefix' => '/disciplinas', 'as' => 'disciplinas.', 'middleware' => 'auth'], function(){
        Route::get('', 'DisciplinaController@index')->name('index');
    });

    //Questão
    Route::group(['prefix' => '/questoes', 'as' => 'questoes.', 'middleware' => 'auth'], function(){
        Route::get('', 'QuestaoController@index')->name('index');
    });

});

