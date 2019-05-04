<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
