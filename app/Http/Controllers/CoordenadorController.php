<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\User;
use App\Tcc;
use App\Data;
use App\Defesa;
use App\Noticia;
use Auth;
use App\Notificacao;
use App\Mail\BemVindo;

class CoordenadorController extends Controller
{

    private $TotalNotificacoesPagina = 20;

    
    // Variavel que armazena o numero de itens que sera mostrado na paginação
    private $TotalUsuariosPágina = 5;
    
    public function __construct() {
        $this->middleware('auth:coordenador');
    }
    
    
    public function dashboard() {
        $alunos = User::count();
        $professores = Professor::count();
        $noticias = Noticia::count();

        // Implementar defesa mais próxima ou defesa de hoje?
        return view('coordenador.dashboard')
                ->with([
                    'alunos' => $alunos,
                    'professores' => $professores,
                    'noticias' => $noticias,
                ]);
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

        $professores = Professor::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image', 'area_de_interesse')

                    // Verifica filtro de nome
                    ->when(request()->has('nome'), function ($q2) {
                        return $q2->where('name', 'LIKE', '%' . request('nome') . '%');
                    })
                    // Verifica filtro de ordem
                    ->when(request()->has('filtroordenar'), function ($q3) {
                        // Verifica ordenação por
                        if(request()->has('filtroordenarpor') && request('filtroordenarpor') == 'cadastro'){
                            $ordenar_por = 'created_at';
                        } else{
                            $ordenar_por = 'name';
                        }

                        if(request('filtroordenar') == 'desc'){
                            return $q3->orderBy( $ordenar_por, 'desc');
                        } else{
                            return $q3->orderBy( $ordenar_por, 'asc');
                        }
                    })
                    ->paginate($this->TotalUsuariosPágina)
                    ->appends([['nome', request('nome')],
                                ['filtroordenar', request('filtroordenar')],
                                ['filtroordenarpor', request('filtroordenarpor')]]);

        // Retorna para a página uma varivel com os aluno (Users) que serão exibidos
        return view('coordenador.visualizar.professores')->with('professores', $professores)
                                                    ->withInput(request()->only('filtroordenarpor'),
                                                                request()->only('filtroordenar'),
                                                                request()->only('nome'));
    }

    public function cadastrarProfessor() {
        return view('coordenador.cadastrar.professor');
    }
    public function documentosProfessores() {

        $professores = Professor::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image', 'area_de_interesse')

                    // Verifica filtro de nome
                    ->when(request()->has('nome'), function ($q2) {
                        return $q2->where('name', 'LIKE', '%' . request('nome') . '%');
                    })
                    // Verifica filtro de ordem
                    ->when(request()->has('filtroordenar'), function ($q3) {
                        // Verifica ordenação por
                        if(request()->has('filtroordenarpor') && request('filtroordenarpor') == 'cadastro'){
                            $ordenar_por = 'created_at';
                        } else{
                            $ordenar_por = 'name';
                        }

                        if(request('filtroordenar') == 'desc'){
                            return $q3->orderBy( $ordenar_por, 'desc');
                        } else{
                            return $q3->orderBy( $ordenar_por, 'asc');
                        }
                    })
                    ->with('documentos')
                    ->paginate($this->TotalUsuariosPágina)
                    ->appends([['nome', request('nome')],
                                ['filtroordenar', request('filtroordenar')],
                                ['filtroordenarpor', request('filtroordenarpor')]]);

        // Retorna para a página uma varivel com os aluno (Users) que serão exibidos
        return view('coordenador.documentos.professores')->with('professores', $professores)
                                                    ->withInput(request()->only('filtroordenarpor'),
                                                                request()->only('filtroordenar'),
                                                                request()->only('nome'));
    }

    // Get's User/Aluno
    public function visualizarAlunos() {
            
        // Busca alunos (Users) filtrados por tipo de tcc e com o nome pesquisado, retorna ordenados e paginados
        // usa o método 'appends' para persistir a pesquisa quando trocada a página
        $alunos = User::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image')
                    
                    // Verifica filtro de disciplina
                    ->when( ( request()->has('filtrotcc') && request('filtrotcc') != 'todos'), function ($q) {
                        $alunos = Tcc::select('id','user_id')
                                            ->where('disciplina', request('filtrotcc'))
                                            ->get();
                        $alunos_id = [];
                        foreach ($alunos as $aluno) {
                            array_push($alunos_id, $aluno->user_id);
                        }
                        return $q->whereIn('id', $alunos_id);
                    })
                    // Verifica filtro de nome
                    ->when(request()->has('nome'), function ($q2) {
                        return $q2->where('name', 'LIKE', '%' . request('nome') . '%');
                    })
                    // Verifica filtro de ordem
                    ->when(request()->has('filtroordenar'), function ($q3) {
                        // Verifica ordenação por
                        if(request()->has('filtroordenarpor') && request('filtroordenarpor') == 'cadastro'){
                            $ordenar_por = 'created_at';
                        } else{
                            $ordenar_por = 'name';
                        }
                        
                        if(request('filtroordenar') == 'desc'){
                            return $q3->orderBy( $ordenar_por, 'desc');
                        } else{
                            return $q3->orderBy( $ordenar_por, 'asc');
                        }
                    })
                    ->with('tcc:id,user_id,disciplina')
                    ->paginate($this->TotalUsuariosPágina)
                    ->appends([['nome', request('nome')],
                                ['filtrotcc', request('filtrotcc')],
                                ['filtroordenar', request('filtroordenar')],
                                ['filtroordenarpor', request('filtroordenarpor')]]);

        // Retorna para a página uma varivel com os aluno (Users) que serão exibidos
        return view('coordenador.visualizar.alunos')->with('alunos', $alunos)
                                                    ->withInput(request()->only('filtrotcc'),
                                                                request()->only('filtroordenarpor'),
                                                                request()->only('filtroordenar'),
                                                                request()->only('nome'));
    }

    public function cadastrarAluno() {
        return view('coordenador.cadastrar.aluno');
    }
    public function documentosAlunos() {
        
        $alunos = User::select('id', 'name', 'email', 'data_nasc', 'matricula', 'telefone', 'image')
                    
                    // Verifica filtro de disciplina
                    ->when( ( request()->has('filtrotcc') && request('filtrotcc') != 'todos'), function ($q) {
                        $alunos = Tcc::select('id','user_id')
                                            ->where('disciplina', request('filtrotcc'))
                                            ->get();
                        $alunos_id = [];
                        foreach ($alunos as $aluno) {
                            array_push($alunos_id, $aluno->user_id);
                        }
                        return $q->whereIn('id', $alunos_id);
                    })
                    // Verifica filtro de nome
                    ->when(request()->has('nome'), function ($q2) {
                        return $q2->where('name', 'LIKE', '%' . request('nome') . '%');
                    })
                    // Verifica filtro de ordem
                    ->when(request()->has('filtroordenar'), function ($q3) {
                        // Verifica ordenação por
                        if(request()->has('filtroordenarpor') && request('filtroordenarpor') == 'cadastro'){
                            $ordenar_por = 'created_at';
                        } else{
                            $ordenar_por = 'name';
                        }
                        
                        if(request('filtroordenar') == 'desc'){
                            return $q3->orderBy( $ordenar_por, 'desc');
                        } else{
                            return $q3->orderBy( $ordenar_por, 'asc');
                        }
                    })
                    ->with('tcc:id,user_id,disciplina','tcc.documentos')
                    ->paginate($this->TotalUsuariosPágina)
                    ->appends([['nome', request('nome')],
                                ['filtrotcc', request('filtrotcc')],
                                ['filtroordenar', request('filtroordenar')],
                                ['filtroordenarpor', request('filtroordenarpor')]]);

        // Retorna para a página uma varivel com os aluno (Users) que serão exibidos
        return view('coordenador.documentos.alunos')->with('alunos', $alunos)
                                                    ->withInput(request()->only('filtrotcc'),
                                                                request()->only('filtroordenarpor'),
                                                                request()->only('filtroordenar'),
                                                                request()->only('nome'));
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
            'disciplina' => 'required',
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
            $tcc->disciplina = $request->disciplina;

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
