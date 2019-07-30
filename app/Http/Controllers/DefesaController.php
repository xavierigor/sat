<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as R;
use Auth;
use Validator;
use App\Defesa;
use App\User;
use App\Professor;

class DefesaController extends Controller
{
    private $TotalItensPágina = 4;

    public function __construct() {
        $this->middleware('auth:coordenador', ['except' => ['index']]);
    }

    public function index ()
    {
        $defesas = Defesa::orderBy('created_at', 'desc')->paginate($this->TotalItensPágina);

        return view('public.agenda-defesas.index')->with('defesas', $defesas);
    }

    public function create()
    {
        // $alunos = User::select('id', 'nome', 'corpo', 'created_at')
        //                     ->where('id', Hashids::decode($id))
        //                     ->first();
        $alunos = User::all();
        $orientadores = Professor::select('id', 'name')->get();

        return view('coordenador.cadastrar.defesa')->with(['alunos' => $alunos, 'orientadores' => $orientadores]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aluno' => 'required',
            // para ser a partir de hoje | after_or_equal:now |
            'data' => 'required|date|date_format:Y-m-d',
            'hora' => 'required',
            'sala' => 'required',
        ]);

        $attrNames = array(
            'orientador-list' => 'orientador',
            'orientador-input' => 'orientador',
            'avaliador-2-list' => 'segundo avaliador',
            'avaliador-2-input' => 'segundo avaliador',
            'avaliador-3-list' => 'terceiro avaliador',
            'avaliador-3-input' => 'terceiro avaliador',
        );
        
        $validator->setAttributeNames($attrNames); 

        if(!$request->exists('orientador-list') && !$request->exists('orientador-input')) {
            $validator->addRules(['orientador-input' => 'required']);
        }

        if (!$request->exists('orientador-list') && $request->exists('orientador-input') && $request->input('orientador-input') != null) {
            $validator->addRules(['orientador-input' => 'max:100']);
        } else if ($request->exists('orientador-input')) {
            $validator->addRules(['orientador-input' => 'required']);
        }

        if(!$request->exists('avaliador-2-list') && !$request->exists('avaliador-2-input')) {
            $validator->addRules(['avaliador-2-input' => 'required']);
        }

        if (!$request->exists('avaliador-2-list') && $request->exists('avaliador-2-input') && $request->input('avaliador-2-input') != null) {
            $validator->addRules(['avaliador-2-input' => 'max:100']);
        } else if ($request->exists('avaliador-2-input')) {
            $validator->addRules(['avaliador-2-input' => 'required']);
        }

        if(!$request->exists('avaliador-3-list') && !$request->exists('avaliador-3-input')) {
            $validator->addRules(['avaliador-3-input' => 'required']);
        }

        if (!$request->exists('avaliador-3-list') && $request->exists('avaliador-3-input') && $request->input('avaliador-3-input') != null) {
            $validator->addRules(['avaliador-3-input' => 'max:100']);
        } else if ($request->exists('avaliador-3-input')) {
            $validator->addRules(['avaliador-3-input' => 'required']);
        }

        if($request->input('orientador-list') === $request->input('avaliador-2-list')) {
            $validator->addRules([
                'orientador-list' => 'different:avaliador-2-list',
                'avaliador-2-list' => 'different:orientador-list',
            ]);
        }

        if($request->input('orientador-list') == $request->input('avaliador-3-list')) {
            $validator->addRules([
                'orientador-list' => 'different:avaliador-3-list',
                'avaliador-3-list' => 'different:orientador-list',
            ]);
        }

        if($request->input('avaliador-2-list') == $request->input('avaliador-3-list')) {
            $validator->addRules([
                'avaliador-3-list' => 'different:avaliador-2-list',
                'avaliador-2-list' => 'different:avaliador-3-list',
            ]);
        }

        if($validator->passes()) {
            $defesa = new Defesa;

            $defesa->aluno_id = $request->aluno;
            $defesa->orientador_id = $request->input('orientador-list') ?? null;
            $defesa->orientador_name = $request->input('orientador-input') ?? null;
            $defesa->avaliador_2_id = $request->input('avaliador-2-list') ?? null;
            $defesa->avaliador_2_name = $request->input('avaliador-2-input') ?? null;
            $defesa->avaliador_3_id = $request->input('avaliador-3-list') ?? null;
            $defesa->avaliador_3_name = $request->input('avaliador-3-input') ?? null;
            $defesa->data = $request->data;
            $defesa->hora = $request->hora;
            $defesa->sala = $request->sala;

            if($defesa->save()) {
                return redirect()->back()->with(session()->flash('success', 'Defesa cadastrada.'));
            }
            return redirect()->back()->with(session()->flash('error', 'Erro ao cadastrar defesa.'));
        }

        return redirect()->back()->withInput($request->only(['data','hora','sala']))->withErrors($validator);
    }

    public function orientador(Request $request)
    {
        $orientador = User::where('id', $request->id)->first()->getOrientador();

        if($orientador) {
            return response()->json(['id' => $orientador->id, 'nome' => $orientador->name ]);
        }

        return response()->json(['error' => null]);
    }
}
