<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tcc;
use App\Professor;
use App\Solicitacao;


class TccController extends Controller
{

    private $TotalItensPágina = 5;


    // GET'S

    public function create()
    {
        return view('aluno.tcc.cadastrar');
    }

    public function visualizar()
    {
        return view('aluno.tcc.visualizar');
    }
    
    public function editar()
    {
        return view('aluno.tcc.editar');
    }
    
    public function orientador()
    {
        // O método verifica se o aluno já tem orientador ou solicitação enviada e
        // retorna para a view uma variável contendo apenas o que será mostrado na tela

        $tcc = Auth::user()->tcc;

        if($tcc->orientador_id){

            $professor = Professor::where('id', $tcc->orientador_id)->first();
            
            $orientador = (object) [
                'orientador_id' => $tcc->orientador_id,
                'orientador_nome' => $professor->name,
                'orientador_foto' => $professor->image,
            ];

            return view('aluno.tcc.orientador')->with('orientador', $orientador);

        } else if($tcc->prof_solicitado){
            
            $professor = Professor::where('id', $tcc->prof_solicitado)->first();

            $profSolicitado = (object) [
                'prof_solicitado' => $tcc->prof_solicitado,
                'prof_solicitado_nome' => $professor->name,
                'prof_solicitado_foto' => $professor->image,
            ];

            return view('aluno.tcc.orientador')->with('profSolicitado', $profSolicitado);
            
        } else {

            // Se for pesquisado algum nome de orientador
            if(request()->has('n')){
            
                $professores = Professor::where('name', 'LIKE', '%' . request('n') . '%')
                                ->where('disponivel_orient', true)
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->TotalItensPágina)
                                ->appends('n', request('n'));
    
            } else{

                $professores = Professor::where('disponivel_orient', true)
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->TotalItensPágina);
            }

            return view('aluno.tcc.orientador')->with('professores', $professores)->withInput(request()->only('n'));
            
        }

    }


    public function documentos()
    {
        return view('aluno.tcc.documentos');
    }

    // POST'S
    
    public function atualizar(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'max:300',
            'area_de_pesquisa' => 'max:300',
        ]);
            
        $tcc = Auth::user()->tcc;
        $tcc->titulo = $request->titulo;
        $tcc->area_de_pesquisa = $request->area_de_pesquisa;
        
        if($tcc->save()) {
            return redirect()->back()->with(session()->flash('success', 'Dados do TCC Atualizados.'));
        } 

        return redirect()->back()->with(session()->flash('error', 'Erro ao Atualizar dados do TCC.'));
    }

    public function solicitarProfessor(Request $request)
    {
        // O método armazena o id passado via requisição 'POST' no campo 'prof_solicitado' da tabela TCC do aluno
        // Depois retorna para a página com uma mensagem (feedback) de sucesso ou erro

        $tcc = Auth::user()->tcc;
        $tcc->prof_solicitado = $request->prof_solicitado;
    
        if($tcc->save()) {

            // Criar nova solicitação
            $solicitacao = new Solicitacao;
            // $solicitacao->data_solicitacao = date('Y-m-d H:i:s');
            $solicitacao->tipo_solicitacao = "orientacao";
            $solicitacao->solicitante_id = Auth::user()->id;
            $solicitacao->solicitado_id = $request->prof_solicitado;
            $solicitacao->save();

            return redirect()->back()->with(session()->flash('info', 'Solicitação de Orientação de TCC enviada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao Solicitar Orientação de TCC.'));
    }
    
    public function cancelarSolicitacao()
    {
        // O método torna 'null' o camp 'prof_solicitado' da tabela TCC do aluno
        // Depois retorna para a página com uma mensagem (feedback) de sucesso ou erro

        $tcc = Auth::user()->tcc;
        $tcc->prof_solicitado = null;
    
        // Deletar solicitacao de orientacao com id de aluno autenticado
        $solicitacao = Solicitacao::where([
            ['solicitante_id', '=', Auth::user()->id],
            ['tipo_solicitacao', '=', 'orientacao']
        ]);

        if($tcc->save() && $solicitacao->delete() ) {    
            return redirect()->back()->with(session()->flash('info', 'Solicitação de Orientação de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Solicitação de Orientação de TCC.'));
    }

    public function cancelarOrientacao()
    {
        $tcc = Auth::user()->tcc;
        $tcc->orientador_id = null;
    
        if($tcc->save()) {
            return redirect()->back()->with(session()->flash('info', 'Orientação de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Orientação de TCC.'));
    }
    
}
