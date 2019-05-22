<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tcc;


class TccController extends Controller
{

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
        return view('aluno.tcc.orientador');
    }
    
    // POST'S
    
    public function atualizar(Request $request)
    {
        
        $this->validate($request, [
            'titulo' => 'max:300',
            'area_de_pesquisa' => 'max:300',
        ]);
            
        $aluno = Auth::user();

// OBS : Não estava conseguindo atualizar utilizando o modelo de
// armazenamento de dados com relacionamento do ELoquent

        // $tcc = new Tcc;
        // $tcc->titulo = $request->titulo;
        // $tcc->area_de_pesquisa = $request->area_de_pesquisa;

        $tcc = Tcc::where('user_id', $aluno->id)->first();;
        $tcc->titulo = $request->titulo;
        $tcc->area_de_pesquisa = $request->area_de_pesquisa;
        
        // dd($tcc);
        // if($aluno->tcc()->save($tcc)) {
        if($tcc->save()) {

            return redirect()->back()->with(session()->flash('success', 'Dados de TCC Atualizados.'));
        } 

        return redirect()->back()->with(session()->flash('error', 'Erro ao Atualizar dados de TCC.'));
    }

}
