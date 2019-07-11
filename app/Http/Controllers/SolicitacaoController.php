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
        // Buscando solicitacoes atribuidas ao professor autenticado
        $todas_solicitacoes = Solicitacao::Where('solicitado_id', Auth::guard('professor')->user()->id )
                                            ->orderBy('created_at', 'desc')
                                            ->paginate($this->TotalItensPágina);

        // Adicionando atributos extras na collection $todas_solicitacoes para enviar pra view
        $todas_solicitacoes->map(function ($solicitacao) {
            $aluno = User::where('id', $solicitacao->solicitante_id)->first();

            // $solicitacao['id_solicitacao'] = $solicitacao->id;
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
        
        if($request->tipo_solicitacao == "orientacao"){
            // Mudar campo 'professor solicitado' no Tcc do aluno para null
            $aluno = User::where('id', $request->aluno_id)->first();
            $aluno->tcc->prof_solicitado = null;
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
        
        if($request->tipo_solicitacao == "orientacao"){
            // Mudar campo 'professor solicitado' no Tcc do aluno para null
            $aluno = User::where('id', $request->aluno_id)->first();
            $aluno->tcc->prof_solicitado = null;
            
            // Deletar solicitacao de orientacao com id informado E atualizar campo tcc do aluno
            if($solicitacao->delete() && $aluno->tcc->save()) {
                return redirect()->back()->with(session()->flash('info', 'Solicitação de Orientação de TCC recusada.'));
            } 
            return redirect()->back()->with(session()->flash('error', 'Erro ao recusar Solicitação de Orientação de TCC.'));

        } else if ($request->tipo_solicitacao == "coorientacao") {
            if($solicitacao->delete()) {
                return redirect()->back()->with(session()->flash('info', 'Solicitação de Coorientação de TCC recusada.'));
            }
            return redirect()->back()->with(session()->flash('error', 'Erro ao recusar Solicitação de Coorientação de TCC.'));
        }
    
    }
    
}
