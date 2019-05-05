@extends('layouts.admin')

@section('title', 'Painel de Controle')

@section('content')
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Hello <b>{{Auth::user()->name}}</b>, you are logged in as <b>Coordenador</b>!
    </div>
@endsection
