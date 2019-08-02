<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tcc;
use App\Professor;
use App\Solicitacao;
use App\Notificacao;
use App\Orientacao;
use App\Coorientacao;
use Carbon;
use Storage;
use Validator;


class TccController extends Controller
{

    private $TotalUsuariosPágina = 5;

    public function __construct() {
        $this->middleware('auth');
    }

    // GET'S

    public function create()
    {
        return view('aluno.tcc.cadastrar');
    }

    public function visualizar()
    {
         // Buscando se há algum orientador e seu dados
        $orientacao = Orientacao::select('id', 'orientador_id')
                                ->where("aluno_id", Auth::user()->id)
                                ->with(['orientador:id,name'])
                                ->first();
        $coorientacao = Coorientacao::select('id','coorientador_id')
                                    ->where('aluno_id', Auth::user()->id)
                                    ->with('coorientador:id,name')
                                    ->get();
        // dd($coorientacao);
        return view('aluno.tcc.visualizar')->with(['orientacao' => $orientacao,
                                                'coorientacao' => $coorientacao]);
    }
    
    public function editar()
    {
        return view('aluno.tcc.editar');
    }
    
    public function orientador()
    {
        // O método verifica se o aluno já tem orientador ou solicitação enviada e
        // retorna para a view uma variável contendo apenas o que será mostrado na tela

        // Buscando se há algum orientador e seu dados
        $orientacao = Orientacao::select('id', 'orientador_id')
                                ->where("aluno_id", Auth::user()->id)
                                ->with(['orientador:id,name,image'])
                                ->first();
                     
        if($orientacao){
            return view('aluno.tcc.orientador')->with('orientacao', $orientacao);

        } else {

            // Buscando se há algum professor solicitado e seu dados
            $solicitacao = Solicitacao::select('id', 'solicitado_id')
                                        ->where([['solicitante_id', '=', Auth::user()->id],
                                                ['tipo_solicitacao', '=', 'orientacao']])
                                        ->with(['solicitado:id,name,image'])
                                        ->first();

            if($solicitacao){
                return view('aluno.tcc.orientador')->with('solicitacao', $solicitacao);
            
            } else {

                $professores = Professor::select('id', 'name', 'email', 'area_de_interesse')
                            ->where('disponivel_orient', true)

                            // Verifica filtro de nome
                            ->when(request()->has('nome'), function ($q2) {
                                return $q2->where('name', 'LIKE', '%' . request('nome') . '%');
                            })
                            // Verifica filtro de ordem
                            ->when(request()->has('filtroordenar'), function ($q3) {
                                if(request('filtroordenar') == 'desc'){
                                    return $q3->orderBy('name', 'desc');
                                } else{
                                    return $q3->orderBy('name', 'asc');
                                }
                            })
                            ->paginate($this->TotalUsuariosPágina)
                            ->appends([['nome', request('nome')],
                                        ['filtroordenar', request('filtroordenar')]]);

                // Retorna para a página uma varivel com os professores que serão exibidos
                return view('aluno.tcc.orientador')->with('professores', $professores)
                                                            ->withInput(request()->only('filtroordenar'),
                                                                        request()->only('nome'));
            }
        }

    }

    public function coorientadores()
    {

        
        $coorientacoes = Coorientacao::select('id', 'coorientador_id')
                                        ->where("aluno_id", Auth::user()->id)
                                        ->with(['coorientador:id,name,image'])
                                        ->get();

        $solicitacoes = Solicitacao::select('id', 'solicitado_id')
                                    ->where([['solicitante_id', '=', Auth::user()->id],
                                            ['tipo_solicitacao', '=', 'coorientacao']])
                                    ->with(['solicitado:id,name,image'])
                                    ->get();
                                
        // Coletando o id de todos os professores coorientadores ou já solicitados pelo aluno
        // para não exibilos na lista de solicitar
        $indisponiveis_solicitar = collect();

        if($coorientacoes){
            foreach ($coorientacoes as $corientacao) {
                $indisponiveis_solicitar->add($corientacao->coorientador->id);
            }
        }
        
        if($solicitacoes){
            foreach ($solicitacoes as $solicitacao) {
                $indisponiveis_solicitar->add($solicitacao->solicitado->id);
            }
        }

        $professores = Professor::select('id', 'name', 'email', 'area_de_interesse')
                            ->where('disponivel_coorient', true)

                            // Verifica filtro de nome
                            ->when(request()->has('nome'), function ($q2) {
                                return $q2->where('name', 'LIKE', '%' . request('nome') . '%');
                            })
                            // Verifica filtro de ordem
                            ->when(request()->has('filtroordenar'), function ($q3) {
                                if(request('filtroordenar') == 'desc'){
                                    return $q3->orderBy('name', 'desc');
                                } else{
                                    return $q3->orderBy('name', 'asc');
                                }
                            })
                            ->paginate($this->TotalUsuariosPágina)
                            ->appends([['nome', request('nome')],
                                        ['filtroordenar', request('filtroordenar')]]);

        // Retorna para a página uma varivel com os professores que serão exibidos
        return view('aluno.tcc.coorientadores')->with(['solicitacoes' => $solicitacoes,
                                                        'coorientacoes' => $coorientacoes,
                                                        'professores' => $professores])
                                                ->withInput(request()->only('filtroordenar'),
                                                            request()->only('nome'));
    }

    public function documentos()
    {
        // $tcc = Auth::user()->tcc;

        // $termo_de_compromisso = $tcc->termo_de_compromisso;
        // $rel_acompanhamento = $tcc->rel_acompanhamento;

        return view('aluno.tcc.documentos');
        // ->with(['termo_de_compromisso' => $termo_de_compromisso, 'rel_acompanhamento' => $rel_acompanhamento]);
    }

    public function enviarDocumentos(){

        $aluno = Auth::user();
        $aluno->tcc->documentos->tc_status = "enviado";
        $aluno->tcc->documentos->ra_status = "enviado";
        if($aluno->tcc->documentos->save()){
            return redirect()->back()->with(session()->flash('success', 'Arquivos enviados para coordenador.'));
        }
        return redirect()->back()->with(session()->flash('error', 'Erro ao enviar arquivos para coordenador.'));
    }
    
    public function cancelarEnvioDocumentos(){

        $aluno = Auth::user();
        $aluno->tcc->documentos->tc_status = "pendente";
        $aluno->tcc->documentos->ra_status = "pendente";

        if($aluno->tcc->documentos->save()){
            return redirect()->back()->with(session()->flash('success', 'Envio de arquivos para coordenador cancelado.'));
        }
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar envio de arquivos para coordenador.'));
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

    public function storeDocumento(Request $request)
    {
        $tcc = Auth::user()->tcc;

        $this->validate($request, [
            'termo_de_compromisso' => 'max:10000|nullable|mimes:pdf,odt,doc,docx|required_without_all:rel_acompanhamento',
            'rel_acompanhamento' => 'max:10000|nullable|mimes:pdf,odt,doc,docx|required_without_all:termo_de_compromisso',
        ],
        [
            'required_without_all' => 'Pelo menos um dos campos é obrigatório'
        ]);

        if($request->hasFile('termo_de_compromisso')){
            // Pegar nome do arquivo com extensão
            $termo_compromisso_filenameWithExt = $request->file('termo_de_compromisso')->getClientOriginalName();

            // Pegar apenas o nome do arquivo
            $termo_compromisso_filename = pathinfo($termo_compromisso_filenameWithExt, PATHINFO_FILENAME);

            // Pegar apenas a extensão
            $termo_compromisso_ext = $request->file('termo_de_compromisso')->getClientOriginalExtension();
            
            $termo_compromisso_fileNameToStore = $termo_compromisso_filename.'_'.time().'.'.$termo_compromisso_ext;
            $termo_compromisso_path = $request->file('termo_de_compromisso')->storeAs('documentos/tcc', $termo_compromisso_fileNameToStore);
        } else {
            $termo_compromisso_fileNameToStore = $tcc->documentos->termo_de_compromisso;
        }

        if($request->hasFile('rel_acompanhamento')) {
            $rel_acompanhamento_filenameWithExt = $request->file('rel_acompanhamento')->getClientOriginalName();

            $rel_acompanhamento_filename = pathinfo($rel_acompanhamento_filenameWithExt, PATHINFO_FILENAME);

            $rel_acompanhamento_ext = $request->file('rel_acompanhamento')->getClientOriginalExtension();
            
            $rel_acompanhamento_fileNameToStore = $rel_acompanhamento_filename.'_'.time().'.'.$rel_acompanhamento_ext;
            $rel_acompanhamento_path = $request->file('rel_acompanhamento')->storeAs('documentos/tcc', $rel_acompanhamento_fileNameToStore);
        } else {
            $rel_acompanhamento_fileNameToStore = $tcc->documentos->rel_acompanhamento;
        }

        // Se já houver um arquivo armazenado
        if($request->hasFile('termo_de_compromisso') && $tcc->documentos->termo_de_compromisso != null) {
            Storage::delete('documentos/tcc/'.$tcc->documentos->termo_de_compromisso);
        }
        if($request->hasFile('rel_acompanhamento') && $tcc->documentos->rel_acompanhamento != null) {
            Storage::delete('documentos/tcc/'.$tcc->documentos->rel_acompanhamento);
        }
        $tcc->documentos->termo_de_compromisso = $termo_compromisso_fileNameToStore ?? null;
        $tcc->documentos->rel_acompanhamento = $rel_acompanhamento_fileNameToStore ?? null;
        $tcc->documentos->tc_updated_at = $termo_compromisso_fileNameToStore ? Carbon\Carbon::now() : null;
        $tcc->documentos->ra_updated_at = $rel_acompanhamento_fileNameToStore ? Carbon\Carbon::now() : null;

        if(!$tcc->documentos->save()) {
            return redirect()->back()->with(session()->flash('error', 'Erro ao realizar upload do(s) arquivo(s).'));
        }

        return redirect()->back()->with(session()->flash('success', 'Upload realizado com sucesso.'));
    }

    public function destroyDocumento(Request $request)
    {
        $tcc = Auth::user()->tcc;

        if(Storage::delete('documentos/tcc/'.$tcc->documentos->{$request->documento})){
            
            $tcc->documentos->{$request->documento} = null;
            if($request->documento == 'termo_de_compromisso'){
                $tcc->documentos->tc_updated_at = null;
            } else if ($request->documento == 'rel_acompanhamento') {
                $tcc->documentos->ra_updated_at = null;
            }

            if($tcc->documentos->save()){
                return redirect()->back()->with(session()->flash('success', 'Arquivo removido.'));
            } else {
                return redirect()->back()->with(session()->flash('error', 'Houve um erro ao remover o arquivo.'));
            }

        }

        return redirect()->back()->with(session()->flash('error', 'Houve um erro ao remover o arquivo.'));
    }
    
    public function cancelarOrientacao(Request $request)
    {
        $tcc = Auth::user()->tcc;

        $orientacao = Orientacao::where([
            ['aluno_id', '=', Auth::user()->id],
            ['orientador_id', '=', $request->orientador_id]
        ]);
        
        $tcc->orientador_id = null;
        
        // Atualizando dados de orientador
        $orientador = Professor::where('id', $request->orientador_id)->first();
        $orientador->num_orientandos -= 1;
        $orientador->disponivel_orient = true;
    
        if($orientacao->delete() && $tcc->save() && $orientador->save()) {

            // Criar nova Notificacao
            $notificacao = new Notificacao;
            $notificacao->tipo_usuario = "professor";
            $notificacao->notificado_id = $request->orientador_id;
            $notificacao->mensagem =  Auth::user()->name . " cancelou a sua orientação de Tcc.";
            $notificacao->save();

            // Add +1 em novas solicitacoes de usuario
            $professor = Professor::where('id', $request->orientador_id)->first();
            $professor->novas_notificacoes += 1;
            $professor->save();

            return redirect()->back()->with(session()->flash('info', 'Orientação de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Orientação de TCC.'));
    }

    public function cancelarCoorientacao(Request $request)
    {

        $coorientacao = Coorientacao::where([
            ['aluno_id', '=', Auth::user()->id],
            ['coorientador_id', '=', $request->prof_solicitado]
        ]);

        // Atualizando dados de coorientador
        $coorientador = Professor::where('id', $request->prof_solicitado)->first();
        $coorientador->num_coorientandos -= 1;
            
        if($coorientacao->delete() && $coorientador->save()) {

            // Criar nova Notificacao
            $notificacao = new Notificacao;
            $notificacao->tipo_usuario = "professor";
            $notificacao->notificado_id = $request->prof_solicitado;
            $notificacao->mensagem =  Auth::user()->name . " cancelou a sua coorientação de Tcc.";
            $notificacao->save();

            // Add +1 em novas solicitacoes de usuario
            $professor = Professor::where('id', $request->prof_solicitado)->first();
            $professor->novas_notificacoes += 1;
            $professor->save();

            return redirect()->back()->with(session()->flash('info', 'Coorientação de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Coorientação de TCC.'));
    }
    
    public function solicitarProfessor(Request $request)
    {
        // Cria nova solicitação com o tipo recebido via resquest - post
        // Depois retorna para a página com uma mensagem (feedback) de sucesso ou erro
        
        // Verificar tipo para Mensagem
        if($request->tipo_solicitacao == "orientacao"){
            $tipo_solicitacao = "Orientação";
        } else if ($request->tipo_solicitacao == "coorientacao"){
            $tipo_solicitacao = "Coorientação";
        }

        // Criar nova solicitação
        $solicitacao = new Solicitacao;
        $solicitacao->tipo_solicitacao = $request->tipo_solicitacao;
        $solicitacao->solicitante_id = Auth::user()->id;
        $solicitacao->solicitado_id = $request->prof_solicitado;

        if($solicitacao->save()){
            return redirect()->back()->with(session()->flash('info', 'Solicitação de ' . $tipo_solicitacao . ' de TCC enviada.'));
        } 

        return redirect()->back()->with(session()->flash('error', 'Erro ao Solicitar ' . $tipo_solicitacao . ' de TCC.'));

    }
    
    public function cancelarSolicitacao(Request $request)
    {
        // Deleta solicitação de orientação ou coorientação
        // depois retorna para a página com uma mensagem (feedback) de sucesso ou erro
    
        // Deletar solicitacao de co-o-rientacao com id de aluno autenticado
        $solicitacao = Solicitacao::where([
            ['solicitante_id', '=', Auth::user()->id],
            ['solicitado_id', '=', $request->prof_solicitado],
            ['tipo_solicitacao', '=', $request->tipo_solicitacao]
        ]);

        // Verificar tipo para Mensagem
        if($request->tipo_solicitacao == "orientacao"){
            $tipo_solicitacao = "Orientação";
        } else if ($request->tipo_solicitacao == "coorientacao"){
            $tipo_solicitacao = "Coorientação";
        }

        if($solicitacao->delete()) {    
            return redirect()->back()->with(session()->flash('info', 'Solicitação de ' . $tipo_solicitacao . ' de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Solicitação de' . $tipo_solicitacao . ' de TCC.'));
    }
    
}
