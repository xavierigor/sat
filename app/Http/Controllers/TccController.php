<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tcc;
use App\Professor;


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

            $professor = Professor::where('id', $tcc->orientador)->first();
            
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
            if(request()->has('name')){
            
                $professores = Professor::where('name', 'LIKE', '%' . request('name') . '%')
                                ->where('disponivel_orient', true)
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->TotalItensPágina)
                                ->appends('name', request('name'));
    
            } else{

                $professores = Professor::where('disponivel_orient', true)
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->TotalItensPágina);
            }

            return view('aluno.tcc.orientador')->with('professores', $professores);
            
        }

    }

    public function cancelarSolicitacao()
    {
        $aluno = Auth::user();
    
        $tcc = Tcc::where('user_id', $aluno->id)->first();
        $tcc->prof_solicitado = null;
    
        if($tcc->save()) {
    
            return redirect()->back()->with(session()->flash('success', 'Solicitação de Orientação de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Solicitação de Orientação de TCC.'));
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
        $aluno = Auth::user();
    
        $tcc = Tcc::where('user_id', $aluno->id)->first();
        $tcc->prof_solicitado = $request->prof_solicitado;
    
        if($tcc->save()) {
    
            return redirect()->back()->with(session()->flash('success', 'Solicitação de Orientação de TCC enviada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao Solicitar Orientação de TCC.'));
    }
    
}
