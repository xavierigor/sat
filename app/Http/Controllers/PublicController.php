<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Hashids;
use Auth;

class PublicController extends Controller
{

    private $TotalItensPágina = 10;


    public function index() {
        return view('public.index');
    }

    public function escolhaLogin() {
        return view('public.escolhaLogin');
    }
    
    public function agenda() {
        return view('public.agenda');
    }

    // public function documentosModelo() {
    //     return view('public.documentosModelo');
    // }

    public function professores() {

        // Se for pesquisado algum nome de professor
        if(request()->has('n')){
            
            $professores = Professor::select('id', 'name', 'email', 'area_de_interesse')
                            ->where('name', 'LIKE', '%' . request('n') . '%')
                            ->orderBy('name', 'asc')
                            ->paginate($this->TotalItensPágina)
                            ->appends('n', request('n'));

        } else{

            $professores = Professor::select('id', 'name', 'email', 'area_de_interesse')
                            ->orderBy('name', 'asc')
                            ->paginate($this->TotalItensPágina);
        }

        return view('public.professores.index')->with('professores', $professores)->withInput(request()->only('n'));
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
