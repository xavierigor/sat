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

// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/coordenador')->group(function() {
    Route::get('/', 'CoordenadorController@dashboard')->middleware('auth:coordenador')->name('coordenador.dashboard');
    Route::get('/cadastrarProfessor', 'CoordenadorController@cadastrarProfessor')->middleware('auth:coordenador')->name('coordenador.cadastrarProfessor');
    Route::post('/salvarProfessor', 'CoordenadorController@salvarProfessor')->middleware('auth:coordenador')->name('coordenador.salvarProfessor');
});

Route::get('/coordenador-login', 'Auth\CoordenadorLoginController@showLogin')->name('coordenador.showLogin');
Route::post('/coordenador-login', 'Auth\CoordenadorLoginController@login')->name('coordenador.login');

Route::get('/professor-login', 'Auth\ProfessorLoginController@showLogin')->name('professor.showLogin');
