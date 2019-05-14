<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Hash;

class AlunoController extends Controller
{
    public function perfil() {
        return view('aluno.perfil');
    }

    public function editar() {
        return view('aluno.editar');
    }

    public function alterarSenha() {
        return view('aluno.alterarSenha');
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            // 'email' => 'required|email|unique:users|max:100',
            "email" => "required|email|max:128|unique:users,email,".Auth::user()->id.",id",
            'matricula' => 'max:9',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            'telefone' => 'max:20|nullable',
        ]);

        $aluno = Auth::user();
        $aluno->name = $request->name;
        $aluno->email = $request->email;
        $aluno->data_nasc = $request->data_nasc;
        $aluno->telefone = $request->telefone;

        if($aluno->save()) {
            return redirect()->back()->with(session()->flash('success', 'Dados Atualizados.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao atualizar dados.'));
    }

    public function salvarSenha(Request $request) {
        $aluno = Auth::user();

        $this->validate($request, [
            'senha_atual' => 'required|max:100',
            'nova_senha' => 'required|max:100|min:6|confirmed',
            // 'nova_senha_confirmed' => 'required|max:100|min:6|same:nova_senha',
        ]);

        // $validator = Validator::make($request->all(), [
        //     'senha_atual' => 'required|max:100',
        //     'nova_senha' => 'required|max:100|min:6|confirmed',
        //     'nova_senha_confirmed' => 'required|max:100|min:6|same:nova_senha',
        // ]);

        if(!Hash::check($request->senha_atual, $aluno->password)) {
            // $validator->errors()->add('senha_atual', 'Senha atual incorreta');
            return redirect()->back()->withErrors('senha_atual', 'Senha atual incorreta');
        }

        $aluno->password = Hash::make($request->nova_senha);

        if($aluno->save()) {
            return redirect()->back()->with(session()->flash('success', 'Senha Alterada.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao Alterar Senha.'));
    }
}
