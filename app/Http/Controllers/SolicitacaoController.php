<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Solicitacao;
use App\User;
use App\Professor;
use App\Tcc;
use App\Orientacao;
use App\Coorientacao;

class SolicitacaoController extends Controller
{
    // Variavel que armazena o numero de itens que sera mostrado na paginação
    private $TotalItensPágina = 10;



    public function solicitacoes(){
        // Buscando solicitacoes atribuidas ao professor autenticado + os dados do solicitante definidos no "WITH"
        $todas_solicitacoes = Solicitacao::select('id', 'tipo_solicitacao', 'solicitante_id')
                                            ->Where('solicitado_id', Auth::guard('professor')->user()->id )
                                            ->with('solicitante:id,name,image')
                                            ->orderBy('created_at', 'desc')
                                            ->paginate($this->TotalItensPágina);

        return view('professor.solicitacoes')->with('todas_solicitacoes', $todas_solicitacoes);
    }

    public function aceitarSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::where('id', $request->solicitacao_id)->first();
    
        // Verificar se é orientacao ou coorientacao
        if($request->tipo_solicitacao == "orientacao"){
            // Mudar campo 'professor solicitado' no Tcc do aluno para null
            $aluno = User::where('id', $request->aluno_id)->first();
            $aluno->tcc->orientador_id = Auth::guard('professor')->user()->id;

            // Criar nova orientacao
            $orientacao = new Orientacao;
            $orientacao->orientador_id = Auth::guard('professor')->user()->id;
            $orientacao->aluno_id = $request->aluno_id;
                    
            // Deletar solicitacao de orientacao com id informado, criar novo orientacao e atualizar campos tcc do aluno
            if($solicitacao->delete() && $aluno->tcc->save() && $orientacao->save()) {
                return redirect()->back()->with(session()->flash('info', 'Solicitação de Orientação de TCC aceita.'));
            } 

            return redirect()->back()->with(session()->flash('error', 'Erro ao aceitar Solicitação de Orientação de TCC.'));
            
        } else if ($request->tipo_solicitacao == "coorientacao") {

            // Criar nova coorientacao
            $coorientacao = new Coorientacao;
            $coorientacao->coorientador_id = Auth::guard('professor')->user()->id;
            $coorientacao->aluno_id = $request->aluno_id;
                    
            if($solicitacao->delete() && $coorientacao->save()) {
                return redirect()->back()->with(session()->flash('info', 'Solicitação de Coorientação de TCC aceita.'));
            } 
            
            return redirect()->back()->with(session()->flash('error', 'Erro ao aceitar Solicitação de Coorientação de TCC.'));
        }

    }

    public function recusarSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::where('id', $request->solicitacao_id)->first();
        
        // Verificar tipo para mensagem
        if($request->tipo_solicitacao == "orientacao"){
            $tipo_solicitacao = "Orientação";            
        } else if ($request->tipo_solicitacao == "coorientacao") {
            $tipo_solicitacao = "Coorientação";
        }
            
        // Deletar solicitacao com id informado
        if($solicitacao->delete()) {
            return redirect()->back()->with(session()->flash('info', 'Solicitação de ' . $tipo_solicitacao . ' de TCC recusada.'));
        }
        return redirect()->back()->with(session()->flash('error', 'Erro ao recusar Solicitação de ' . $tipo_solicitacao . ' de TCC.'));
    
    }
    
}
