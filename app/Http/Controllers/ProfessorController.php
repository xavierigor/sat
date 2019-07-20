<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orientacao;
use App\Coorientacao;
use App\User;
use Auth;
use Hash;
use Storage;

class ProfessorController extends Controller
{
    public function __construct() {
        $this->middleware('auth:professor');
    }

    public function dashboard() {
        return view('professor.dashboard');
    }

    public function perfil() {
        return view('professor.perfil');
    }

    
    public function editar() {
        return view('professor.editar');
    }
    
    public function alterarSenha() {
        return view('professor.alterarSenha');
    }


    public function orientandos() {
        $orientacoes = Auth::user()->getOrientandos();
        return view('professor.tcc.orientandos')->with('orientacoes', $orientacoes);
    }
    
    public function coorientandos() {
        $coorientacoes = Auth::user()->getCoorientandos();
        return view('professor.tcc.coorientandos')->with('coorientacoes', $coorientacoes);
    }

    public function cancelarOrientacao(Request $request){
        $aluno = User::where('id', $request->orientando_id)->first();

        $orientacao = Orientacao::where([
            ['aluno_id', '=', $request->orientando_id],
            ['orientador_id', '=', Auth::user()->id]
        ]);
        
        $aluno->tcc->orientador_id = null;
        
        // Atualizando dados de orientador
        Auth::guard('professor')->user()->num_orientandos -= 1;
        
        if($orientacao->delete() && $aluno->tcc->save() && Auth::guard('professor')->user()->save()) {
            
            return redirect()->back()->with(session()->flash('info', 'Orientação de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Orientação de TCC.'));
    }

    public function cancelarCoorientacao(Request $request){

        $coorientacao = Coorientacao::where([
            ['aluno_id', '=', $request->coorientando_id],
            ['coorientador_id', '=', Auth::user()->id]
        ]);
        
        // Atualizando dados de orientador
        Auth::guard('professor')->user()->num_coorientandos -= 1;

        if($coorientacao->delete() && Auth::guard('professor')->user()->save()) {
 
            return redirect()->back()->with(session()->flash('info', 'Coorientação de TCC Cancelada.'));
        } 
    
        return redirect()->back()->with(session()->flash('error', 'Erro ao cancelar Coorientação de TCC.'));
    }


    public function documentos() {
        $termo_de_responsabilidade = Auth::user()->termo_de_responsabilidade;

        return view('professor.tcc.documentos')->with('termo_de_responsabilidade', $termo_de_responsabilidade);
    }

    public function storeDocumentos(Request $request)
    {
        $professor = Auth::user();

        if($request->hasFile('termo_de_responsabilidade')){
            $filenameWithExt = $request->file('termo_de_responsabilidade')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $ext = $request->file('termo_de_responsabilidade')->getClientOriginalExtension();
            
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            $path = $request->file('termo_de_responsabilidade')->storeAs('documentos/professor', $fileNameToStore);
        } else {
            $fileNameToStore = $professor->termo_de_responsabilidade;
        }

        $this->validate($request, [
            'termo_de_responsabilidade' => 'max:10000|required|mimes:pdf,odt,doc,docx',
        ]);

        if($request->hasFile('termo_de_responsabilidade') && $professor->termo_de_responsabilidade != null) {
            Storage::delete('documentos/professor/'.$professor->termo_de_responsabilidade);
        }

        $professor->termo_de_responsabilidade = $fileNameToStore ?? null;

        if(!$professor->save()) {
            return redirect()->back()->with(session()->flash('error', 'Erro ao realizar upload do(s) arquivo(s).'));
        }

        return redirect()->back()->with(session()->flash('success', 'Upload realizado com sucesso.'));
    }

    public function destroyDocumento(Request $request)
    {
        $professor = Auth::user();

        if(Storage::delete('documentos/professor/'.$professor->{$request->documento})){
            
            $professor->{$request->documento} = null;
            
            if($professor->save()){
                return redirect()->back()->with(session()->flash('success', 'Arquivo removido.'));
            } else {
                return redirect()->back()->with(session()->flash('error', 'Houve um erro ao remover o arquivo.'));
            }
        }

        return redirect()->back()->with(session()->flash('error', 'Houve um erro ao remover o arquivo.'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:128|unique:professores,email,'.Auth::user()->id.',id',
            'matricula' => 'max:9',
            'data_nasc' => 'required|date|date_format:Y-m-d',
            'telefone' => 'max:20|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $professor = Auth::user();
        $professor->name = $request->name;
        $professor->email = $request->email;
        $professor->data_nasc = $request->data_nasc;
        $professor->telefone = $request->telefone;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            if($professor->image){
                // remove old img from directory
                unlink(storage_path('app/public/perfil/professores/'.$professor->image));
            }

            $name = $professor->id.kebab_case($professor->name);

            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";

            $professor->image = $nameFile;
            $upload = $request->image->storeAs('perfil/professores', $nameFile);

            // Se upload não funcionar
            if(! $upload) {
                return redirect()->back()->with(session()->flash('error', 'Erro ao fazer upload de imagem.'));
            }
            // dd($nameFile);
        }

        if($professor->save()) {
            return redirect()->back()->with(session()->flash('success', 'Dados Atualizados.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao atualizar dados.'));
    }

    public function salvarSenha(Request $request) {
        $professor = Auth::user();

        $this->validate($request, [
            'senha_atual' => 'required|max:100',
            'nova_senha' => 'required|max:100|min:6|confirmed',
        ]);

        if(Hash::check($request->senha_atual, $professor->password)) {
            $professor->password = Hash::make($request->nova_senha);
            if($professor->save()) {
                return redirect()->back()->with(session()->flash('success', 'Senha Alterada.'));
            }

            return redirect()->back()->with(session()->flash('error', 'Erro ao Alterar Senha.'));
        } 

        return redirect()->back()->withErrors('senha_atual', 'Senha atual incorreta');
    }
}
