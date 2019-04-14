<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordenadorController extends Controller
{
    public function dashboard() {
        return view('coordenador.dashboard');
    }
}
