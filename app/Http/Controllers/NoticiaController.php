<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as R;
use App\Noticia;
use Hashids;
use Auth;
use Validator;
use Carbon;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $TotalItensPágina = 5;

    public function __construct() {
        $this->middleware('auth:coordenador', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        // Não pode ser dessa forma pq assim não retorna as informações do coordenador (dono do post)
        // a não ser que sejam especificadas, uma por uma

        // $noticias = Noticia::select('id', 'titulo', 'corpo', 'created_at')
        //                         ->orderBy('created_at', 'desc')
        //                         ->paginate($this->TotalItensPágina);

        $noticias = Noticia::orderBy('created_at', 'desc')->paginate($this->TotalItensPágina);

        return view('public.noticia.index')->with('noticias', $noticias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coordenador.cadastrar.noticia');
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
            'titulo' => 'required|max:200|unique:noticias',
            'corpo' => 'required|max:2999',
        ]);

        $noticia = new Noticia;
        $noticia->titulo = $request->titulo;
        $noticia->corpo = $request->corpo;
        $noticia->coordenador_id = Auth::user()->id;

        if($noticia->save()) {
            return redirect()->back()->with(session()->flash('success', 'Notícia publicada.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao publicar notícia.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // $noticia = Noticia::select('id', 'titulo', 'corpo', 'created_at')
            //                     ->where('id', Hashids::decode($id))
            //                     ->first();
            $noticia = Noticia::where('id', Hashids::decode($id))->first();
        } catch(\Exception $e) {
            return abort(404);
        }
        
        return view('public.noticia.show')->with('noticia', $noticia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $noticia = Noticia::where('id', Hashids::decode($id))->first();
        } catch(\Exception $e) {
            return abort(404);
        }

        return view('coordenador.editar.noticia')->with('noticia', $noticia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo' => 'required|max:200',
            'corpo' => 'required|max:2999',
        ]);

        $noticia = Noticia::where('id', Hashids::decode($id))->first();

        $noticia->titulo = $request->titulo;
        $noticia->corpo = $request->corpo;
        $noticia->updated_at = Carbon\Carbon::now();

        if($noticia->save()) {
            return redirect()->back()->with(session()->flash('success', 'Notícia atualizada.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao editar notícia.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $noticia = Noticia::find($request->id);

        if($noticia->delete()) {
            if(R::is('noticias')) {
                return redirect()->route('public.noticia.index')->with(session()->flash('success', 'Notícia removida.'));
            }
            return redirect()->back()->with(session()->flash('success', 'Notícia removida.'));
        }

        return redirect()->back()->with(session()->flash('error', 'Erro ao remover notícia.'));
    }
}
