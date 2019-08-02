<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Hashids;
use Auth;

class PublicController extends Controller
{

    private $TotalUsuariosPágina = 5;


    public function index() {
        return view('public.index');
    }

    public function escolhaLogin() {
        return view('public.escolhaLogin');
    }

    public function professores() {

        $professores = Professor::select('id', 'name', 'email', 'area_de_interesse')

                    // Verifica filtro de nome
                    ->when(request()->has('nome'), function ($q2) {
                        return $q2->where('name', 'LIKE', '%' . request('nome') . '%');
                    })
                    // Verifica filtro de ordem
                    ->when(request()->has('filtroordenar'), function ($q3) {
                        
                        if(request('filtroordenar') == 'desc'){
                            return $q3->orderBy( 'name', 'desc');
                        } else{
                            return $q3->orderBy( 'name', 'asc');
                        }
                    })
                    ->paginate($this->TotalUsuariosPágina)
                    ->appends([['nome', request('nome')],
                                ['filtroordenar', request('filtroordenar')]]);

        // Retorna para a página uma varivel com os aluno (Users) que serão exibidos
        return view('public.professores.index')->with('professores', $professores)
                                                    ->withInput(request()->only('filtroordenar'),
                                                                request()->only('nome'));
    }

    public function perfilProfessor($id) {
        try {
            $professor = Professor::select('id', 'name', 'email', 'telefone', 'area_de_interesse', 'image')
                                    ->where('id', Hashids::decode($id))
                                    ->first();

        } catch(\Exception $e) {
            return abort(404);
        }

        return view('public.professores.perfil')->with('professor', $professor);
    }
}
