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

        Olá <strong>{{Auth::user()->name}}</strong>, seja bem-vindo(a) ao SAT!<br>
    </div>
@endsection
