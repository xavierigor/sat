<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Hashids;

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

        return view('public.orientadores.index')->with('orientadores', $orientadores);
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
