<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Hashids;
use Auth;

class PublicController extends Controller
{
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
        $orientadores = Professor::all();
        
        if(Auth::user()->tcc->prof_solicitado) {
            $professor_solicitado = Professor::where('id', Auth::user()->tcc->prof_solicitado)->first();
        } else {
            $professor_solicitado = null;
        }

        return view('public.orientadores.index')->with(['orientadores' => $orientadores, 'prof_solicitado' => $professor_solicitado]);
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
