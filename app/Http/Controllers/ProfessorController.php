<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    
    // Isso remove a necessidade de colocar middleware em todas as rotas no arquivo routes/web.php
    public function __construct() {
        $this->middleware('auth:professor');
    }

    public function dashboard() {
        return view('professor.dashboard');
    }
}
