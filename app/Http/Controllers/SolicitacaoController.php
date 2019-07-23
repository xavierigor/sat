<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Professor;
use App\Tcc;
use App\Solicitacao;
use App\Notificacao;
use App\Orientacao;
use App\Coorientacao;
use App\Mail\SolicitacaoOrientacaoAceita;

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

        return view('professor.tcc.solicitacoes')->with('todas_solicitacoes', $todas_solicitacoes);
    }

    public function aceitarSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::where('id', $request->solicitacao_id)->first();
    
        // Verificar se é orientacao ou coorientacao
        if($request->tipo_solicitacao == "orientacao"){
            
            // Verificar se pode orientar
            if(Auth::guard('professor')->user()->disponivel_orient == true){

                // Mudar campo 'orientador_id'
                $aluno = User::where('id', $request->aluno_id)->first();
                $aluno->tcc->orientador_id = Auth::guard('professor')->user()->id;

                // Criar nova orientacao
                $orientacao = new Orientacao;
                $orientacao->orientador_id = Auth::guard('professor')->user()->id;
                $orientacao->aluno_id = $request->aluno_id;
                
                // Atualizando dados de orientador
                Auth::guard('professor')->user()->num_orientandos += 1;
                if(Auth::guard('professor')->user()->num_orientandos >= 5){
                    Auth::guard('professor')->user()->disponivel_orient = false;
                }
                                
                // Deletar solicitacao de orientacao com id informado, criar novo orientacao e atualizar campos tcc do aluno
                if($solicitacao->delete() && $aluno->tcc->save() && $orientacao->save() && Auth::guard('professor')->user()->save()) {
                    
                    // Enviar email
                    \Mail::to($aluno->email)->send(new SolicitacaoOrientacaoAceita($aluno->name, Auth::guard('professor')->user()->name));

                    if(count(\Mail::failures()) > 0) {
                        return redirect()->back()->with(session()->flash('error', 'Erro ao enviar email de notificação.'));
                    }

                    // Criar nova Notificacao
                    $notificacao = new Notificacao;
                    $notificacao->tipo_usuario = "aluno";
                    $notificacao->notificado_id = $request->aluno_id;
                    $notificacao->mensagem =  Auth::guard('professor')->user()->name . " aceitou a sua solicitação de orientação de Tcc.";
                    $notificacao->save();

                    // Add +1 em novas solicitacoes de usuario'
                    $aluno = User::where('id', $request->aluno_id)->first();
                    $aluno->novas_notificacoes += 1;
                    $aluno->save();

                    return redirect()->back()->with(session()->flash('info', 'Solicitação de Orientação de TCC aceita.'));
                } 

                return redirect()->back()->with(session()->flash('error', 'Erro ao aceitar Solicitação de Orientação de TCC.'));

            } else {
                return redirect()->back()->with(session()->flash('error', 'Erro ao aceitar Solicitação de Orientação de TCC. Você já atingiu o número máximo de orientandos.'));
            } 

        } else if ($request->tipo_solicitacao == "coorientacao") {
            
            // Criar nova coorientacao
            $coorientacao = new Coorientacao;
            $coorientacao->coorientador_id = Auth::guard('professor')->user()->id;
            $coorientacao->aluno_id = $request->aluno_id;
                   
            // Atualizando dados de orientador
            Auth::guard('professor')->user()->num_coorientandos += 1;

            if($solicitacao->delete() && $coorientacao->save() && Auth::guard('professor')->user()->save()) {

                // Criar nova Notificacao
                $notificacao = new Notificacao;
                $notificacao->tipo_usuario = "aluno";
                $notificacao->notificado_id = $request->aluno_id;
                $notificacao->mensagem =  Auth::guard('professor')->user()->name . " aceitou a sua solicitação de coorientação de Tcc.";
                $notificacao->save();

                // Add +1 em novas solicitacoes de usuario'
                $aluno = User::where('id', $request->aluno_id)->first();
                $aluno->novas_notificacoes += 1;
                $aluno->save();

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
            
            // Criar nova Notificacao
            $notificacao = new Notificacao;
            $notificacao->tipo_usuario = "aluno";
            $notificacao->notificado_id = $request->aluno_id;
            $notificacao->mensagem =  Auth::guard('professor')->user()->name . " recusou a sua solicitação de " . $tipo_solicitacao . " de Tcc.";
            $notificacao->save();

            // Add +1 em novas solicitacoes de usuario'
            $aluno = User::where('id', $request->aluno_id)->first();
            $aluno->novas_notificacoes += 1;
            $aluno->save();

            return redirect()->back()->with(session()->flash('info', 'Solicitação de ' . $tipo_solicitacao . ' de TCC recusada.'));
        }
        return redirect()->back()->with(session()->flash('error', 'Erro ao recusar Solicitação de ' . $tipo_solicitacao . ' de TCC.'));
    
    }
    
}
