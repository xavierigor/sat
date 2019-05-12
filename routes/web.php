<?php

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

// Rotas Publicas
Route::get('/', 'PublicController@index')->name('public.index');
Route::get('/agenda-tccs', 'PublicController@agenda')->name('public.agenda');
Route::get('/iniciar-sessao', 'PublicController@escolhaLogin')->name('public.escolhaLogin');
Route::get('/documentos-modelo', 'PublicController@documentosModelo')->name('public.documentosModelo');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Auth::routes();

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/coordenador-login', 'Auth\CoordenadorLoginController@showLogin')->name('coordenador.showLogin');
Route::post('/coordenador-login', 'Auth\CoordenadorLoginController@login')->name('coordenador.login');

Route::get('/professor-login', 'Auth\ProfessorLoginController@showLogin')->name('professor.showLogin');
Route::post('/professor-login', 'Auth\ProfessorLoginController@login')->name('professor.login');

Route::prefix('/coordenador')->group(function() {
    Route::get('/', 'CoordenadorController@dashboard')->name('coordenador.dashboard');

    Route::get('/cadastrar/professor', 'CoordenadorController@cadastrarProfessor')->name('coordenador.cadastrar.professor');
    Route::post('/cadastrar/professor', 'CoordenadorController@salvarProfessor')->name('coordenador.salvar.professor');
    Route::get('/visualizar/professores', 'CoordenadorController@visualizarProfessores')->name('coordenador.visualizar.professores');
    Route::post('/visualizar/professores', 'CoordenadorController@removerProfessor')->name('coordenador.remover.professor');

    Route::get('/cadastrar/aluno', 'CoordenadorController@cadastrarAluno')->name('coordenador.cadastrar.aluno');
    Route::post('/cadastrar/aluno', 'CoordenadorController@salvarAluno')->name('coordenador.salvar.aluno');
    Route::get('/visualizar/alunos', 'CoordenadorController@visualizarAlunos')->name('coordenador.visualizar.alunos');
    Route::post('/visualizar/alunos', 'CoordenadorController@removerAluno')->name('coordenador.remover.aluno');
    
    Route::get('/perfil/{id}', 'CoordenadorController@perfilProfessor')->name('coordenador.perfil.professor');
});

Route::prefix('/professor')->group(function() {
    Route::get('/', 'ProfessorController@dashboard')->name('professor.dashboard');
});
