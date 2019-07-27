<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentoModelo;
use Auth;
use Storage;

class DocumentoModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $TotalItensPágina = 5;

     public function __construct(){
        $this->middleware('auth:coordenador', ['except' => ['index']]);
     }

    public function index()
    {
        $documentos = DocumentoModelo::select('id', 'titulo', 'nome', 'created_at')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate($this->TotalItensPágina);

        return view('public.documentosModelo')->with('documentos', $documentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coordenador.cadastrar.documento-modelo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nome' => 'required|max:200|unique:documentos_modelo,titulo',
            'arquivo' => 'max:10000|required|mimes:pdf,odt,doc,docx',
        ]);

        if($request->hasFile('arquivo')){
            $filenameWithExt = $request->file('arquivo')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $ext = $request->file('arquivo')->getClientOriginalExtension();
            
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            $path = $request->file('arquivo')->storeAs('documentos/modelo', $fileNameToStore);
        }

        $documento = new DocumentoModelo;

        $documento->titulo = $request->nome;
        $documento->nome = $fileNameToStore ?? null;

        if(!$documento->save()) {
            return redirect()->back()->with(session()->flash('error', 'Erro ao cadastrar documento modelo.'));
        }

        return redirect()->back()->with(session()->flash('success', 'Documento modelo cadastrado.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $documento = DocumentoModelo::where('id', $request->id)->first();

        $fileName = $documento->nome;

        if($documento->delete()) {
            if(Storage::delete('documentos/modelo/'.$fileName)) {
                return redirect()->back()->with(session()->flash('success', 'Documento removido.'));
            }

            return redirect()->back()->with(session()->flash('error', 'Erro ao remover documento'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao remover documento'));
    }
}
