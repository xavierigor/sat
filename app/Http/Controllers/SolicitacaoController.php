<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Solicitacao;
use App\User;
use App\Professor;
use App\Tcc;

class SolicitacaoController extends Controller
{
    // Variavel que armazena o numero de itens que sera mostrado na paginação
    private $TotalItensPágina = 10;



    public function solicitacoes(){
        // Buscando solicitacoes atribuidas ao professor autenticado
        $todas_solicitacoes = Solicitacao::Where('solicitado_id', Auth::guard('professor')->user()->id )
                                            ->orderBy('created_at', 'desc')
                                            ->paginate($this->TotalItensPágina);

        // Adicionando atributos extras na collection $todas_solicitacoes para enviar pra view
        $todas_solicitacoes->map(function ($solicitacao) {
            $aluno = User::where('id', $solicitacao->solicitante_id)->first();

            $solicitacao['id_solicitacao'] = $solicitacao->id;
            $solicitacao['aluno_id'] = $solicitacao->solicitante_id;
            $solicitacao['aluno_nome'] = $aluno->name;
            $solicitacao['aluno_foto'] = $aluno->image;
            return $solicitacao;
        });


        // dd($todas_solicitacoes);
        return view('professor.solicitacoes')->with('todas_solicitacoes', $todas_solicitacoes);
    }


    public function aceitarSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::where('id', $request->solicitacao_id)->first();
        
        // Mudar campo 'professor solicitado' no Tcc do aluno para null
        $aluno = User::where('id', $request->aluno_id)->first();
        $aluno->tcc->prof_solicitado = null;
        $aluno->tcc->orientador_id = Auth::guard('professor')->user()->id;
        
        // Deletar solicitacao de orientacao com id informado E atualizar campos tcc do aluno
        if($solicitacao->delete() && $aluno->tcc->save()) {
            return redirect()->back()->with(session()->flash('info', 'Solicitação de Orientação de TCC recusada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao recusar Solicitação de Orientação de TCC.'));

    }

    public function recusarSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::where('id', $request->solicitacao_id)->first();
        
        // Mudar campo 'professor solicitado' no Tcc do aluno para null
        $aluno = User::where('id', $request->aluno_id)->first();
        $aluno->tcc->prof_solicitado = null;
        
        // Deletar solicitacao de orientacao com id informado E atualizar campo tcc do aluno
        if($solicitacao->delete() && $aluno->tcc->save()) {
            return redirect()->back()->with(session()->flash('info', 'Solicitação de Orientação de TCC recusada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao recusar Solicitação de Orientação de TCC.'));
    }
    
}
