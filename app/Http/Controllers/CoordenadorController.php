<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordenadorController extends Controller
{
    public function dashboard() {
        return view('coordenador.dashboard');
    }
    public function cadastrarProfessor() {
        return view('coordenador.cadastrarProfessor');
    }
    
    
    // Autenticar dados do cadastro
    public function salvarProfessor() {
        return view('coordenador.dashboard');
    }

}
