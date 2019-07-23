<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Notificacao;
use Hash;

class AlunoController extends Controller
{

    private $TotalNotificacoesPagina = 20;


    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        return view('aluno.dashboard');
    }

    public function perfil() {
        return view('aluno.perfil');
    }

    public function editar() {
        return view('aluno.editar');
    }

    public function alterarSenha() {
        return view('aluno.alterarSenha');
    }

    public function notificacoes(){

        $todas_notificacoes = Notificacao::select('id', 'mensagem', 'updated_at')
                                        ->where([["tipo_usuario", "=", "aluno"], 
                                                ["notificado_id", "=", Auth::user()->id]])
                                        ->orderBy('updated_at', 'desc')
                                        ->paginate($this->TotalNotificacoesPagina);

        $novas_notificacoes = Auth::user()->novas_notificacoes;
        Auth::user()->novas_notificacoes = 0;
        Auth::user()->save();

        return view('aluno.notificacoes')->with('todas_notificacoes', $todas_notificacoes)
                                        ->with('novas_notificacoes', $novas_notificacoes);
    }

    // POST'S

    // Alterar dados
    public function update(Request $request) {

        // valida os dados passados pelo formulário
        $this->validate($request, [
            'name' => 'required|max:100',
            // 'email' => 'required|email|unique:users|max:100',
            'email' => 'required|email|max:128|unique:users,email,'.Auth::user()->id.',id',
            'matricula' => 'max:9',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            'telefone' => 'max:20|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Armazena os dados no BD
        $aluno = Auth::user();
        $aluno->name = $request->name;
        $aluno->email = $request->email;
        $aluno->data_nasc = $request->data_nasc;
        $aluno->telefone = $request->telefone;

        // Verifica se foi foi alterada a foto e se é válida
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            // Verifica se o aluno já tinha foto e remove imagem antiga do diretório
            if($aluno->image){
                unlink(storage_path('app/public/perfil/users/'.$aluno->image));
            }

            // concatena id, nome do usuário e extensão para ter o nome que será salvo para a imagem no BD
            $name = $aluno->id.kebab_case($aluno->name);
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";

            // Salva o nome da imagem no BD e o arquivo na pasta 'Storage' do servidor
            $aluno->image = $nameFile;
            $upload = $request->image->storeAs('perfil/users', $nameFile);

            // Se upload não funcionar retorna erro
            if(! $upload) {
                return redirect()->back()->with(session()->flash('error', 'Erro ao fazer Upload de Imagem.'));
            }
        }

        // Retorna mensagem de sucesso ou erro (feedback)

        if($aluno->save()) {
            return redirect()->back()->with(session()->flash('success', 'Dados Atualizados.'));
        }
        
        return redirect()->back()->with(session()->flash('error', 'Erro ao Atualizar Dados.'));
    }

    // Alterar Senha
    public function salvarSenha(Request $request) {
        $aluno = Auth::user();

        // Valida dados passados pelo form
        $this->validate($request, [
            'senha_atual' => 'required|max:100',
            'nova_senha' => 'required|max:100|min:6|confirmed',
        ]);

        if(Hash::check($request->senha_atual, $aluno->password)) {
            
            // Armazena a senha criptografada
            $aluno->password = Hash::make($request->nova_senha);
            if($aluno->save()) {
                return redirect()->back()->with(session()->flash('success', 'Senha Alterada.'));
            }

            return redirect()->back()->with(session()->flash('error', 'Erro ao Alterar Senha.'));
        } 

        return redirect()->back()->withErrors('senha_atual', 'Senha atual incorreta');
    }
}
