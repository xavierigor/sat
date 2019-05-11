@extends('layouts.admin')

@section('title', 'Painel de Controle')

@section('content')
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Olá <b>{{Auth::user()->name}}</b>, você está logado(a) como <b>Professor</b>!
    </div>
@endsection
