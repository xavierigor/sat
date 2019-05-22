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
        $orientadores = Professor::where('disponivel_orient', true)->paginate($this->TotalItensPágina);
        $tcc = Auth::user()->tcc;
        // $aluno = Auth::user();
        // $tcc = Tcc::where('user_id', $aluno->id)->first();

        $tccAluno = (object) [
            'orientador_id' => $tcc->orientador_id,
            'prof_solicitado' => $tcc->prof_solicitado,
            'orientador_nome' => null,
            'orientador_foto' => null,
            'prof_solicitado_nome' => null,
            'prof_solicitado_foto' => null,
        ];

        if($tcc->orientador_id){
            $professor = Professor::where('id', $tcc->orientador)->first();

            $tccAluno->orientador_nome = $professor->name;
            $tccAluno->orientador_foto = $professor->image;

        } else{

            if($tcc->prof_solicitado){
                $professor = Professor::where('id', $tcc->prof_solicitado)->first();

                $tccAluno->prof_solicitado_nome = $professor->name;
                $tccAluno->prof_solicitado_foto = $professor->image;
            }
        }

        return view('aluno.tcc.orientador')->with(['orientadores' => $orientadores, 'tccAluno' => $tccAluno]);
        // ->with('tccAluno', $tccAluno);
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
