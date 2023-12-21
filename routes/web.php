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


//Login
Route::get('/', 'Auth\LoginController@index')->name('login');
Route::post('/home', 'Auth\LoginController@autenticacao')->name('login.autenticacao');
Route::post('/logout', 'Auth\LogoutController@logout')->name('logout');

//Cadastrar novo usuário
Route::get('/cadastrar', 'UserController@create')->name('registrar_usuario');
Route::post('/store', 'UserController@storeExterno')->name('salvar_usuario_externo');

//perfil
Route::get('/perfil', ['middleware' => 'auth', 'uses' => 'PerfilController@index'])->name('perfil');
Route::post('/perfil/{id}', ['middleware' => 'auth', 'uses' => 'PerfilController@update'])->name('perfil_update');

//Dashboard
// Route::get('/dashboard', ['middleware' => 'auth', 'uses' => 'DashboardController@index'])->name('dashboard');


//Acesso ADM
Route::group(['prefix' => '/adm', 'as' => 'adm.', 'middleware' => ['auth', 'acessoAdm']], function(){

    Route::get('/dashboard', 'HomeController@index')->name('index_adm');

    //Usuário
    Route::group(['prefix' => '/usuario', 'as' => 'usuario.'], function(){
        Route::get('/create', 'UserController@create')->name('create');
        Route::get('/cadastrar-usuario', 'UserController@createUser')->name('createUser');
        Route::post('/destroy/{id}', 'UserController@destroy')->name('destroy');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::post('/update/{id}', 'UserController@update')->name('update');
        Route::post('/store', 'UserController@store')->name('salvar_usuario');
        Route::get('/usuarios-ativos', 'UserController@listagemUsuarios')->name('listagem_usuarios');
    });

        //Disciplinas
    Route::group(['prefix' => '/disciplinas', 'as' => 'disciplinas.'], function(){
        Route::get('', 'DisciplinaController@index')->name('index');
        Route::post('/destroy/{id}', 'DisciplinaController@destroy')->name('destroy');
        Route::post('/update/{id}', 'DisciplinaController@update')->name('update');
        Route::get('/create', 'DisciplinaController@create')->name('create');
        Route::post('/store', 'DisciplinaController@store')->name('store');
    });

    //Questão
    Route::group(['prefix' => '/questoes', 'as' => 'questoes.'], function(){
        Route::get('', 'QuestaoController@index')->name('index');
        // Route::get('/cadastrar-questao', 'QuestaoController@create')->name('create');
        Route::get('/busca-topicos/{id}', 'QuestaoController@buscaTopico')->name('busca_topico');
        Route::post('/store', 'QuestaoController@store')->name('store');
        Route::post('/destroy/{id}', 'QuestaoController@destroy')->name('destroy');
        Route::post('/update/{id}', 'QuestaoController@update')->name('update');
        Route::get('/edit/{id}', 'QuestaoController@edit')->name('edit');
        // Route::get('/visualizar/{id}', 'QuestaoController@visualizarQuestao')->name('visualizar');
        // Route::get('/visualizar-questao-externa/{id}', 'QuestaoController@visualizarQuestaoExterna')->name('visualizar_questao_externa');
    });

    //Tópicos
    Route::group(['perfix' => '/topicos', 'as' => 'topicos.'], function(){
        Route::get('/topicos', 'TopicoController@index')->name('index');
        Route::post('/destroy/{id}', 'TopicoController@destroy')->name('destroy');
        Route::post('/update/{id}', 'TopicoController@update')->name('update');
        Route::post('/store', 'TopicoController@store')->name('store');
    });

    //Atividade
    Route::group(['prefix' => '/atividades', 'as' => 'atividades.'], function(){
        Route::get('', 'AtividadeController@index')->name('index');
        Route::get('/cadastrar-atividade', 'AtividadeController@create')->name('create');
        Route::post('/destroy/{id}', 'AtividadeController@destroy')->name('destroy');
        Route::get('/edit/{id}', 'AtividadeController@edit')->name('edit');
        Route::post('/update/{id}', 'AtividadeController@update')->name('update');
        // Route::get('/busca-questao/{id}', 'AtividadeController@buscaQuestao')->name('busca_questao');
        Route::post('/store', 'AtividadeController@storeAtividade')->name('store');
        Route::get('/pdf-atividade/{id}', 'AtividadeController@pdfAtividade')->name('atividade_pdf');
        Route::get('/pdf-atividade-externa/{id}', 'AtividadeController@pdfAtividadeExterna')->name('atividade_externa_pdf');
        Route::get('/gabarito-atividade/{id}', 'AtividadeController@gabarito')->name('gabarito');
    });

    //Atividade-Questão
    Route::group(['prefix' => '/atividade-questao', 'as' => 'atividade_questao.'], function(){
        Route::post('/store', 'AtividadeQuestaoController@store')->name('atividade_questao');
        Route::post('/destroy/{id}', 'AtividadeQuestaoController@destroy')->name('destroy');
        // Route::get('/selecionar-questoes', 'AtividadeQuestaoController@selectQuestao')->name('select_questao');
        Route::get('/busca-questao-atividade/{id}', 'AtividadeQuestaoController@buscaQuestaoDisciplina')->name('busca_questao_disciplina');
    });

    //Relatórios
    Route::group(['prefix' => '/relatorio', 'as' => 'relatorio.'], function(){
        Route::get('/disciplinas', 'RelatorioController@disciplinas')->name('relatorio_disciplinas');
        Route::get('/geral', 'RelatorioController@relatorioGeral')->name('relatorio_geral');
        Route::get('/relatorio-topicos', 'RelatorioController@topicos')->name('relatorio_topicos');
    });

});

// Acesso Usuário externo
Route::group(['prefix' => '/acesso-externo', 'as' => 'acesso_externo.', 'middleware' => ['auth', 'acessoExterno']], function(){

    Route::group(['prefix' => '/questoes', 'as' => 'questoes.'], function(){
        Route::get('', 'QuestaoExternoController@index')->name('index_externo');
        Route::post('/store', 'QuestaoExternoController@store')->name('store');
        Route::post('/destroy/{id}', 'QuestaoExternoController@destroy')->name('destroy');
        Route::post('/update/{id}', 'QuestaoExternoController@update')->name('update');
        Route::get('/edit/{id}', 'QuestaoExternoController@edit')->name('edit');
    });

    Route::group(['prefix' => '/atividades', 'as' => 'atividades.'], function(){
        Route::get('/', 'AtividadeExternoController@index')->name('index');
        Route::post('/store', 'AtividadeExternoController@store')->name('store');
        Route::post('/update/{id}', 'AtividadeExternoController@update')->name('update');
        Route::get('/cadastrar-atividade', 'AtividadeExternoController@create')->name('create');
        Route::get('/edit/{id}', 'AtividadeExternoController@edit')->name('edit');
        Route::get('/pdf-atividade/{id}', 'AtividadeExternoController@pdfAtividade')->name('atividade_pdf');
        Route::post('/destroy/{id}', 'AtividadeExternoController@destroy')->name('destroy');
        Route::get('/gabarito-atividade/{id}', 'AtividadeExternoController@gabarito')->name('gabarito');
    });

});

