<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tcc;
use App\Professor;
use App\Solicitacao;
use Storage;
use Validator;


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
        $tcc = Auth::user()->tcc;

        $termo_de_compromisso = $tcc->termo_de_compromisso;
        $rel_acompanhamento = $tcc->rel_acompanhamento;

        return view('aluno.tcc.documentos')
        ->with(['termo_de_compromisso' => $termo_de_compromisso, 'rel_acompanhamento' => $rel_acompanhamento]);
    }

    
    // POST'S
    public function storeDocumento(Request $request)
    {
        $tcc = Auth::user()->tcc;

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
            $termo_compromisso_fileNameToStore = $tcc->termo_de_compromisso;
        }

        if($request->hasFile('rel_acompanhamento')) {
            $rel_acompanhamento_filenameWithExt = $request->file('rel_acompanhamento')->getClientOriginalName();

            $rel_acompanhamento_filename = pathinfo($rel_acompanhamento_filenameWithExt, PATHINFO_FILENAME);

            $rel_acompanhamento_ext = $request->file('rel_acompanhamento')->getClientOriginalExtension();
            
            $rel_acompanhamento_fileNameToStore = $rel_acompanhamento_filename.'_'.time().'.'.$rel_acompanhamento_ext;
            $rel_acompanhamento_path = $request->file('rel_acompanhamento')->storeAs('documentos/tcc', $rel_acompanhamento_fileNameToStore);
        } else {
            $rel_acompanhamento_fileNameToStore = $tcc->rel_acompanhamento;
        }

        $this->validate($request, [
            'termo_de_compromisso' => 'max:10000|nullable|mimes:pdf,odt,doc,docx|required_without_all:rel_acompanhamento',
            'rel_acompanhamento' => 'max:10000|nullable|mimes:pdf,odt,doc,docx|required_without_all:termo_de_compromisso',
        ],
        [
            'required_without_all' => 'Pelo menos um dos campos é obrigatório'
        ]);

        // Se já houver um arquivo armazenado
        if($request->hasFile('termo_de_compromisso') && $tcc->termo_de_compromisso != null) {
            Storage::delete('documentos/tcc/'.$tcc->termo_de_compromisso);
        }
        if($request->hasFile('rel_acompanhamento') && $tcc->rel_acompanhamento != null) {
            Storage::delete('documentos/tcc/'.$tcc->rel_acompanhamento);
        }
        $tcc->termo_de_compromisso = $termo_compromisso_fileNameToStore ?? null;
        $tcc->rel_acompanhamento = $rel_acompanhamento_fileNameToStore ?? null;

        if(!$tcc->save()) {
            return redirect()->back()->with(session()->flash('error', 'Erro ao realizar upload do(s) arquivo(s).'));
        }

        return redirect()->back()->with(session()->flash('success', 'Upload realizado com sucesso.'));
    }

    public function destroyDocumento(Request $request)
    {
        $tcc = Auth::user()->tcc;

        if(Storage::delete('documentos/tcc/'.$tcc->{$request->documento})){
            $tcc->{$request->documento} = null;
            $tcc->save();

            return redirect()->back()->with(session()->flash('success', 'Arquivo removido.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Houve um erro ao remover o arquivo.'));
    }
    
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
