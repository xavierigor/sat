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

    public function documentosModelo() {
        return view('public.documentosModelo');
    }

    public function orientadores() {

        // Se for pesquisado algum nome de professor
        if(request()->has('name')){
            
            $orientadores = Professor::where('name', 'LIKE', '%' . request('name') . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate($this->TotalItensPágina)
                            ->appends('name', request('name'));

        } else{

            $orientadores = Professor::orderBy('created_at', 'desc')
                            ->paginate($this->TotalItensPágina);
        }

        return view('public.orientadores.index')->with(['orientadores' => $orientadores]);
    }

    public function perfilOrientador($id) {
        try {
            $orientador = Professor::where('id', Hashids::decode($id))->first();
        } catch(\Exception $e) {
            return abort(404);
        }

        return view('public.orientadores.show')->with('orientador', $orientador);
    }
}
