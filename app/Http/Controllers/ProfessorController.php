<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfessorController extends Controller
{
    public function __construct() {
        $this->middleware('auth:professor');
    }

    public function dashboard() {
        return view('professor.dashboard');
    }

    public function perfil() {
        return view('professor.perfil');
    }

    public function editar() {
        return view('professor.editar');
    }

    public function alterarSenha() {
        return view('professor.alterarSenha');
    }


    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:128|unique:professores,email,'.Auth::user()->id.',id',
            'matricula' => 'max:9',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            'telefone' => 'max:20|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $professor = Auth::user();
        $professor->name = $request->name;
        $professor->email = $request->email;
        $professor->data_nasc = $request->data_nasc;
        $professor->telefone = $request->telefone;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            if($professor->image){
                // remove old img from directory
                unlink(storage_path('app/public/perfil/professores/'.$professor->image));
            }

            $name = $professor->id.kebab_case($professor->name);

            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";

            $professor->image = $nameFile;
            $upload = $request->image->storeAs('perfil/professores', $nameFile);

            // Se upload não funcionar
            if(! $upload) {
                return redirect()->back()->with(session()->flash('error', 'Erro ao fazer upload de imagem.'));
            }
            // dd($nameFile);
        }

        if($professor->save()) {
            return redirect()->back()->with(session()->flash('success', 'Dados Atualizados.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao atualizar dados.'));
    }

    public function salvarSenha(Request $request) {
        $professor = Auth::user();

        $this->validate($request, [
            'senha_atual' => 'required|max:100',
            'nova_senha' => 'required|max:100|min:6|confirmed',
        ]);

        if(Hash::check($request->senha_atual, $professor->password)) {
            $professor->password = Hash::make($request->nova_senha);
            if($professor->save()) {
                return redirect()->back()->with(session()->flash('success', 'Senha Alterada.'));
            }

            return redirect()->back()->with(session()->flash('error', 'Erro ao Alterar Senha.'));
        } 

        return redirect()->back()->withErrors('senha_atual', 'Senha atual incorreta');
    }
}
