<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Solicitacao;
use App\User;
use App\Professor;

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
    }

    public function recusarSolicitacao(Request $request)
    {
    }
    
}
