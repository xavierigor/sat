<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;

class CoordenadorController extends Controller
{

    // Get's

    // Isso remove a necessidade de colocar middleware em todas as rotas no arquivo routes/web.php
    public function __construct() {
        $this->middleware('auth:coordenador');
    }


    public function dashboard() {
        return view('coordenador.dashboard');
    }

    public function visualizarProfessores() {
        $professores = Professor::all();

        return view('coordenador.visualizar.professores')->with('professores', $professores);
    }

    public function cadastrarProfessor() {
        return view('coordenador.cadastrar.professor');
    }

    // Post's

    public function salvarProfessor(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100|',
            'email' => 'required|email|unique:professores|max:100',
            'matricula' => 'required|max:9|unique:professores',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            'area_de_interesse' => 'max:191|nullable',
            'telefone' => 'max:20|nullable',
        ]);

        $professor = new Professor;
        $professor->name = $request->name;
        $professor->email = $request->email;
        // Muda o formato da data_nasc para ddmmaaaa e armazena em password
        $professor->password = bcrypt(str_replace('/', '', date('d/m/Y',(strtotime($request->data_nasc)))));
        $professor->matricula = $request->matricula;
        $professor->data_nasc = $request->data_nasc;
        $professor->area_de_interesse = $request->area_de_interesse;
        $professor->telefone = $request->telefone;

        if($professor->save()) {
            return redirect()->back()->with(session()->flash('success', 'Professor cadastrado'));
        }

        return back()->with(session()->flash('error', 'Erro ao cadastrar professor'));
    }

    public function removerProfessor(Request $request) {        

        if(Professor::destroy($request->id)) {
            return  redirect()->back()->with(session()->flash('success', 'Professor removido.'));
        }

        return  back()->with(session()->flash('error', 'Erro ao remover professor.'));

    }

}
