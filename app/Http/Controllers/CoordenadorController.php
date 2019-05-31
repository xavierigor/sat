<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\User;
use App\Tcc;

class CoordenadorController extends Controller
{

    // Variavel que armazena o numero de itens que sera mostrado na paginação
    private $TotalItensPágina = 5;
    
    public function __construct() {
        $this->middleware('auth:coordenador');
    }
    
    
    public function dashboard() {
        return view('coordenador.dashboard');
    }

    // Get's Professor
    
    public function visualizarProfessores() {

        if(request()->has('n')){
            
            $professores = Professor::where('name', 'LIKE', '%' . request('n') . '%')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate($this->TotalItensPágina)
                                    ->appends('n', request('n'));

        } else {
            $professores = Professor::orderBy('created_at', 'desc')->paginate($this->TotalItensPágina);
        }

        return view('coordenador.visualizar.professores')->with('professores', $professores)->withInput(request()->only('n'));
    }

    public function cadastrarProfessor() {
        return view('coordenador.cadastrar.professor');
    }
    

    // Get's User/Aluno
    public function visualizarAlunos() {

        // verifica se foi foi passado 'name' como GET (quando é pesquisa algo no campo de busca)
        if(request()->has('n')){
            
            // Busca alunos (Users) com o nome pesquisado, retorna ordenados e paginados e
            // usa o método 'appends' para persistir a pesquisa quando trocada a página
            $alunos = User::where('name', 'LIKE', '%' . request('n') . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate($this->TotalItensPágina)
                            ->appends('n', request('n'));

        } else{
            $alunos = User::orderBy('created_at', 'desc')->paginate($this->TotalItensPágina);
        }
        
        // Retorna para a página uma varivel com os aluno (Users) que serão exibidos
        return view('coordenador.visualizar.alunos')->with('alunos', $alunos)->withInput(request()->only('n'));
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
        ]);

        $professor = new Professor;
        $professor->name = $request->name;
        $professor->email = $request->email;
        $professor->password = bcrypt(str_replace('/', '', date('d/m/Y',(strtotime($request->data_nasc)))));
        $professor->matricula = $request->matricula;
        $professor->data_nasc = $request->data_nasc;

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
        // valida dados passados pelo form
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'matricula' => 'required|max:9|unique:users',
            'data_nasc' => 'required|date|date_format:Y-m-d',
        ]);
            
        // salva dados no BD
        $aluno = new User;
        $aluno->name = $request->name;
        $aluno->email = $request->email;
        // salva senha criptografada
        $aluno->password = bcrypt(str_replace('/', '', date('d/m/Y',(strtotime($request->data_nasc)))));
        $aluno->matricula = $request->matricula;
        $aluno->data_nasc = $request->data_nasc;

        // verifica se dados de aluno foram salvos
        if($aluno->save()) {

            // cria novo tupla na tabela TCC e associa ao aluno salvo (com o id)
            $tcc = new Tcc;
            $tcc->user_id = $aluno->id;
            $tcc->save();

            return redirect()->back()->with(session()->flash('success', 'Aluno cadastrado.'));
        }

        return back()->with(session()->flash('error', 'Erro ao cadastrar Aluno.'));
    }
    
    public function removerAluno(Request $request) {        

        // Remove aluno (User) do BD
        if(User::destroy($request->id)) {
            return redirect()->back()->with(session()->flash('success', 'Aluno removido.'));
        }

        return back()->with(session()->flash('error', 'Erro ao remover Aluno.'));
    }

}
