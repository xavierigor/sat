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
Route::get('/professores', 'PublicController@professores')->name('public.professores');
Route::get('/professores/{id}', 'PublicController@perfilprofessor')->name('public.professores.perfil');

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

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/coordenador-login', 'Auth\CoordenadorLoginController@showLogin')->name('coordenador.showLogin');
Route::post('/coordenador-login', 'Auth\CoordenadorLoginController@login')->name('coordenador.login');

Route::get('/professor-login', 'Auth\ProfessorLoginController@showLogin')->name('professor.showLogin');
Route::post('/professor-login', 'Auth\ProfessorLoginController@login')->name('professor.login');

Route::prefix('/coordenador')->group(function() {
    Route::get('/', 'CoordenadorController@dashboard')->name('coordenador.dashboard');

    Route::get('/cadastrar/professor', 'CoordenadorController@cadastrarProfessor')->name('coordenador.cadastrar.professor');
    Route::post('/cadastrar/professor', 'CoordenadorController@salvarProfessor')->name('coordenador.salvar.professor');
    Route::get('/visualizar/professores', 'CoordenadorController@visualizarProfessores')->name('coordenador.visualizar.professores');
    Route::delete('/visualizar/professores', 'CoordenadorController@removerProfessor')->name('coordenador.remover.professor');

    Route::get('/cadastrar/aluno', 'CoordenadorController@cadastrarAluno')->name('coordenador.cadastrar.aluno');
    Route::post('/cadastrar/aluno', 'CoordenadorController@salvarAluno')->name('coordenador.salvar.aluno');
    Route::get('/visualizar/alunos', 'CoordenadorController@visualizarAlunos')->name('coordenador.visualizar.alunos');
    Route::delete('/visualizar/alunos', 'CoordenadorController@removerAluno')->name('coordenador.remover.aluno');
});

Route::prefix('/professor')->group(function() {
    Route::get('/', 'ProfessorController@dashboard')->name('professor.dashboard');
    Route::get('/perfil', 'ProfessorController@perfil')->name('professor.perfil');
    Route::get('/editar', 'ProfessorController@editar')->name('professor.editar');
    Route::post('/editar', 'ProfessorController@update')->name('professor.update');
    Route::get('/alterar/senha', 'ProfessorController@alterarSenha')->name('professor.alterar.senha');
    Route::post('/alterar/senha', 'ProfessorController@salvarSenha')->name('professor.salvar.senha');

    Route::get('/solicitacoes', 'SolicitacaoController@solicitacoes')->name('professor.solicitacoes');
    Route::post('/aceitar-solicitacao', 'SolicitacaoController@aceitarSolicitacao')->name('professor.solicitacao.aceitar');
    Route::post('/recusar-solicitacao', 'SolicitacaoController@recusarSolicitacao')->name('professor.solicitacao.recusar');

    Route::get('/orientandos', 'ProfessorController@orientandos')->name('professor.orientandos');

    Route::get('/documentos', 'ProfessorController@documentos')->name('professor.documentos');
    Route::post('/documentos', 'ProfessorController@storeDocumentos')->name('professor.store.documentos');
    Route::delete('/documentos', 'ProfessorController@destroyDocumento')->name('professor.destroy.documento');

});

Route::prefix('/aluno')->group(function() {
    Route::get('/', 'AlunoController@dashboard')->name('aluno.dashboard');
    Route::get('/perfil', 'AlunoController@perfil')->name('aluno.perfil');
    Route::get('/editar', 'AlunoController@editar')->name('aluno.editar');
    Route::post('/editar', 'AlunoController@update')->name('aluno.update');
    Route::get('/alterar/senha', 'AlunoController@alterarSenha')->name('aluno.alterar.senha');
    Route::post('/alterar/senha', 'AlunoController@salvarSenha')->name('aluno.salvar.senha');

    Route::get('tcc/editar', 'TccController@editar')->name('aluno.editar.tcc');
    Route::post('tcc/editar', 'TccController@atualizar')->name('aluno.atualizar.tcc');
    Route::get('tcc/visualizar', 'TccController@visualizar')->name('aluno.visualizar.tcc');
    Route::get('tcc/documentos', 'TccController@documentos')->name('aluno.documentos.tcc');
    Route::post('tcc/documentos', 'TccController@storeDocumentos')->name('aluno.store.documentos');
    Route::delete('tcc/documentos', 'TccController@destroyDocumento')->name('aluno.destroy.documento');
    // Route::get('/editar/tcc', 'TccController@editar')->name('aluno.editar.tcc');
    // Route::post('/editar/tcc', 'TccController@atualizar')->name('aluno.atualizar.tcc');
    // Route::get('/visualizar/tcc', 'TccController@visualizar')->name('aluno.visualizar.tcc');
    // Route::get('/documentos/tcc', 'TccController@documentos')->name('aluno.documentos.tcc');
    // Route::post('/documentos/tcc', 'TccController@storeDocumento')->name('aluno.store.documento');
    // Route::delete('/documentos/tcc', 'TccController@destroyDocumento')->name('aluno.destroy.documento');
    
    Route::post('/solicitar-professor/tcc', 'TccController@solicitarProfessor')->name('aluno.solicitar-professor.tcc');
    Route::post('/cancelar-solicitacao/tcc', 'TccController@cancelarSolicitacao')->name('aluno.cancelar-solicitacao.tcc');
    
    Route::get('tcc/orientador', 'TccController@orientador')->name('aluno.orientador.tcc');
    Route::post('/tcc/cancelar-orientacao', 'TccController@cancelarOrientacao')->name('aluno.tcc.cancelar-orientacao');
    
    Route::get('/tcc/coorientadores/solicitar', 'TccController@solicitarCoorientadores')->name('aluno.tcc.coorientadores.solicitar');
    
    Route::get('/tcc/coorientadores', 'TccController@coorientadores')->name('aluno.tcc.coorientadores');
    Route::post('/tcc/cancelar-coorientacao', 'TccController@cancelarCoorientacao')->name('aluno.tcc.cancelar-coorientacao');
});
