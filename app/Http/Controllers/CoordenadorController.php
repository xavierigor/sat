<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\User;
use App\Tcc;

class CoordenadorController extends Controller
{

    private $TotalItensPágina = 5;
    
    public function __construct() {
        $this->middleware('auth:coordenador');
    }
    
    
    public function dashboard() {
        return view('coordenador.dashboard');
    }

    // Get's Professor
    
    public function visualizarProfessores() {

        if(request()->has('name')){
            $professores = Professor::where('name', request('name'))
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->TotalItensPágina)
                                ->appends('name', request('name'));
        
        } else{
            $professores = Professor::orderBy('created_at', 'desc')->paginate($this->TotalItensPágina);
        }

        return view('coordenador.visualizar.professores')->with('professores', $professores);
    }

    public function cadastrarProfessor() {
        return view('coordenador.cadastrar.professor');
    }
    

    // Get's User/Aluno
    public function visualizarAlunos() {

        // $alunos = new User;
        // $queries = [];

        // $columns = [
        //     'name',
        // ];

        // foreach ($columns as $column) {

        //     if(request()->has($column)){
        //         $alunos = User::where($column, request($column))->paginate($this->TotalItensPágina);
        //         $queries[$column] = request($column);
        //     }
        // }

        // if(request()->has('sort')){
        //     $alunos = $alunos->orderBy('name', request('sort'))->paginate($this->TotalItensPágina);
        //     $queries['sort'] = request('sort');
        // }


        if(request()->has('name')){
            $alunos = User::where('name', request('name'))
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->TotalItensPágina)
                                ->appends('name', request('name'));
        
        } else{
            $alunos = User::orderBy('created_at', 'desc')->paginate($this->TotalItensPágina);
        }

        
        return view('coordenador.visualizar.alunos')->with('alunos', $alunos);
    }

    public function cadastrarAluno() {
        return view('coordenador.cadastrar.aluno');
    }


    // Post's Professor

    public function salvarProfessor(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:professores|max:100',
            'matricula' => 'required|max:9|unique:professores',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            // 'area_de_interesse' => 'max:191|nullable',
            // 'telefone' => 'max:20|nullable',
        ]);

        $professor = new Professor;
        $professor->name = $request->name;
        $professor->email = $request->email;
        // Muda o formato da data_nasc para ddmmaaaa e armazena em password
        $professor->password = bcrypt(str_replace('/', '', date('d/m/Y',(strtotime($request->data_nasc)))));
        $professor->matricula = $request->matricula;
        $professor->data_nasc = $request->data_nasc;
        // $professor->area_de_interesse = $request->area_de_interesse;
        // $professor->telefone = $request->telefone;

        if($professor->save()) {
            return redirect()->back()->with(session()->flash('success', 'Professor cadastrado.'));
        }

        return back()->with(session()->flash('error', 'Erro ao cadastrar Professor.'));
    }

    public function removerProfessor(Request $request) {        
        if(Professor::destroy($request->id)) {
            return redirect()->back()->with(session()->flash('success', 'Professor removido.'));
        }

        return back()->with(session()->flash('error', 'Erro ao remover Professor.'));
    }
    
    // Post's User/Aluno

    public function salvarAluno(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'matricula' => 'required|max:9|unique:users',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            // 'area_de_interesse' => 'max:191|nullable',
            // 'telefone' => 'max:20|nullable',
        ]);
            
        $aluno = new User;
        $aluno->name = $request->name;
        $aluno->email = $request->email;
        // Muda o formato da data_nasc para ddmmaaaa e armazena em password
        $aluno->password = bcrypt(str_replace('/', '', date('d/m/Y',(strtotime($request->data_nasc)))));
        $aluno->matricula = $request->matricula;
        $aluno->data_nasc = $request->data_nasc;

        if($aluno->save()) {
            $tcc = new Tcc;

            $tcc->user_id = $aluno->id;
            $tcc->save();

            return redirect()->back()->with(session()->flash('success', 'Aluno cadastrado.'));
        }

        return back()->with(session()->flash('error', 'Erro ao cadastrar Aluno.'));
    }
    
    public function removerAluno(Request $request) {        
        if(User::destroy($request->id)) {
            return redirect()->back()->with(session()->flash('success', 'Aluno removido.'));
        }

        return back()->with(session()->flash('error', 'Erro ao remover Aluno.'));
    }

}
