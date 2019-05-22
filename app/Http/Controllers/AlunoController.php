<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class AlunoController extends Controller
{
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


    // POST'S

    // Alterar dados
    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            // 'email' => 'required|email|unique:users|max:100',
            'email' => 'required|email|max:128|unique:users,email,'.Auth::user()->id.',id',
            'matricula' => 'max:9',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            'telefone' => 'max:20|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $aluno = Auth::user();
        $aluno->name = $request->name;
        $aluno->email = $request->email;
        $aluno->data_nasc = $request->data_nasc;
        $aluno->telefone = $request->telefone;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            if($aluno->image){
                // remove old img from directory
                unlink(storage_path('app/public/perfil/users/'.$aluno->image));
            }

            $name = $aluno->id.kebab_case($aluno->name);

            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";

            $aluno->image = $nameFile;
            $upload = $request->image->storeAs('perfil/users', $nameFile);

            // Se upload não funcionar
            if(! $upload) {
                return redirect()->back()->with(session()->flash('error', 'Erro ao fazer upload de imagem.'));
            }
            // dd($nameFile);
        }

        if($aluno->save()) {
            return redirect()->back()->with(session()->flash('success', 'Dados Atualizados.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao atualizar dados.'));
    }

    // Alterar Senha
    public function salvarSenha(Request $request) {
        $aluno = Auth::user();

        $this->validate($request, [
            'senha_atual' => 'required|max:100',
            'nova_senha' => 'required|max:100|min:6|confirmed',
        ]);

        if(Hash::check($request->senha_atual, $aluno->password)) {
            $aluno->password = Hash::make($request->nova_senha);
            if($aluno->save()) {
                return redirect()->back()->with(session()->flash('success', 'Senha Alterada.'));
            }

            return redirect()->back()->with(session()->flash('error', 'Erro ao Alterar Senha.'));
        } 

        return redirect()->back()->withErrors('senha_atual', 'Senha atual incorreta');
    }
}
