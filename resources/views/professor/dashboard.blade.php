@extends('layouts.admin')

@section('title', 'Painel de Controle')

@section('header')
<i class="fas fa-tachometer-alt fa-fw mr-2"></i> Painel de Controle
@endsection

@section('content')
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Olá <b>{{Auth::user()->name}}</b>, seja bem-vindo ao SAT!<br>
        Você está logado(a) como <b>Professor</b>.
    </div>
@endsection
