<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\User;
use App\Tcc;
use App\Data;
use Auth;
use App\Notificacao;
use App\Mail\BemVindo;

class CoordenadorController extends Controller
{

    private $TotalNotificacoesPagina = 20;

    
    // Variavel que armazena o numero de itens que sera mostrado na paginação
    private $TotalItensPágina = 5;
    
    public function __construct() {
        $this->middleware('auth:coordenador');
    }
    
    
    public function dashboard() {
        return view('coordenador.dashboard');
    }

    public function notificacoes(){

        $todas_notificacoes = Notificacao::select('id', 'mensagem', 'updated_at')
                                        ->where([["tipo_usuario", "=", "coordenador"], 
                                                ["notificado_id", "=", Auth::guard('coordenador')->user()->id]])
                                        ->orderBy('updated_at', 'desc')
                                        ->paginate($this->TotalNotificacoesPagina);

        $novas_notificacoes = Auth::guard('coordenador')->user()->novas_notificacoes;
        Auth::guard('coordenador')->user()->novas_notificacoes = 0;
        Auth::guard('coordenador')->user()->save();

        return view('aluno.notificacoes')->with('todas_notificacoes', $todas_notificacoes)
                                        ->with('novas_notificacoes', $novas_notificacoes);
    }

    public function datas() {
        $todas_datas = Data::all();
        
        return view('coordenador.datas')->with('todas_datas', $todas_datas);
    }

    public function salvarDatas(Request $request) {

        // dd($request);
        // valida dados passados pelo form
        $this->validate($request, [
            'definir_orientador_inicio' => 'required_with:definir_orientador_termino|Date|nullable|before_or_equal:definir_orientador_termino',
            'definir_orientador_termino' => 'required_with:definir_orientador_inicio|Date|nullable|after_or_equal:definir_orientador_inicio',
            
            'termo_compromisso_inicio' => 'required_with:termo_compromisso_termino|Date|nullable|before_or_equal:termo_compromisso_termino',
            'termo_compromisso_termino' => 'required_with:termo_compromisso_inicio|Date|nullable|after_or_equal:termo_compromisso_inicio',
            
            'termo_responsabilidade_inicio' => 'required_with:termo_responsabilidade_termino|Date|nullable|before_or_equal:termo_responsabilidade_termino',
            'termo_responsabilidade_termino' => 'required_with:termo_responsabilidade_inicio|Date|nullable|after_or_equal:termo_responsabilidade_inicio',
            
            'relatorio_acompanhamento_inicio' => 'required_with:relatorio_acompanhamento_termino|Date|nullable|before_or_equal:relatorio_acompanhamento_termino',
            'relatorio_acompanhamento_termino' => 'required_with:relatorio_acompanhamento_inicio|Date|nullable|after_or_equal:relatorio_acompanhamento_inicio',
        ]);
            
        // salvar datas no BD

        $todas_datas = Data::all();

        foreach ($todas_datas as $data) {

            if($data->nome == 'definir orientador'){
                $data->data_inicio = $request->definir_orientador_inicio;
                $data->data_termino = $request->definir_orientador_termino;
                $data->save();
            }

            if($data->nome == 'termo de compromisso'){
                $data->data_inicio = $request->termo_compromisso_inicio;
                $data->data_termino = $request->termo_compromisso_termino;
                $data->save();
            }

            if($data->nome == 'termo de responsabilidade'){
                $data->data_inicio = $request->termo_responsabilidade_inicio;
                $data->data_termino = $request->termo_responsabilidade_termino;
                $data->save();
            }
            
            if($data->nome == 'relatorio de acompanhamento'){
                $data->data_inicio = $request->relatorio_acompanhamento_inicio;
                $data->data_termino = $request->relatorio_acompanhamento_termino;
                $data->save();
            }     
        }
        
        // verifica se datas foram salvos
        // if($todas_datas->save()) {
        //     return redirect()->back()->with(session()->flash('success', 'Datas atualizadas.'));
        // }
        
        return redirect()->back()->with(session()->flash('success', 'Datas atualizadas.'));
        // return back()->with(session()->flash('error', 'Erro ao atualizar datas.'));
    }
    

    // Get's Professor
    
    public function visualizarProfessores() {

        if(request()->has('n')){
            
            $professores = Professor::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image', 'area_de_interesse')
                                    ->where('name', 'LIKE', '%' . request('n') . '%')
                                    ->orderBy('name', 'asc')
                                    ->paginate($this->TotalItensPágina)
                                    ->appends('n', request('n'));

        } else {
            $professores = Professor::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image', 'area_de_interesse')
                                    ->orderBy('name', 'asc')
                                    ->paginate($this->TotalItensPágina);
        }

        // dd($professores);
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
            $alunos = User::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image')
                            ->where('name', 'LIKE', '%' . request('n') . '%')
                            ->orderBy('name', 'asc')
                            ->paginate($this->TotalItensPágina)
                            ->appends('n', request('n'));

        } else{
            $alunos = User::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image')
                            ->orderBy('name', 'asc')
                            ->paginate($this->TotalItensPágina);
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

            // Enviar email
            \Mail::to($professor->email)->send(new BemVindo($professor->name, 'professor'));

            if(count(\Mail::failures()) > 0) {
                return redirect()->back()->with(session()->flash('error', 'Erro ao enviar email de notificação.'));
            }
            
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
            'tcc' => 'required',
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
            $tcc->tcc = $request->tcc;

            if($tcc->save()) {

                // Enviar email
                \Mail::to($aluno->email)->send(new BemVindo($aluno->name));

                if(count(\Mail::failures()) > 0) {
                    return redirect()->back()->with(session()->flash('error', 'Erro ao enviar email de notificação.'));
                }

                return redirect()->back()->with(session()->flash('success', 'Aluno cadastrado.'));
                
            } else {
                return back()->with(session()->flash('error', 'Erro ao cadastrar Aluno.'));
            }
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
