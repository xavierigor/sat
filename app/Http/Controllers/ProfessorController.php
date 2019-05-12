<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function __construct() {
        $this->middleware('auth:professor');
    }

    public function dashboard() {
        return view('professor.dashboard');
    }
}
