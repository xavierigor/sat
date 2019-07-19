@extends('layouts.auth')

@section('title', 'Iniciar Sessão')

@section('content')
    <div class="text-center mb-4">
        <!-- <i class="fas fa-user-circle fa-fw fa-3x" style="color: #FF0100"></i> -->
        <i class="fas fa-user-circle fa-fw fa-3x" style="color:rgba(0,0,0,0.8)"></i>
    </div>
    <div class="escolha-login">
        <a class="btn btn-outline-laranja btn-sm mb-3" href="{{ route('login') }}">Aluno</a>
        <a class="btn btn-outline-laranja btn-sm mb-3" href="{{ route('professor.showLogin') }}">Professor</a>
        <a class="btn btn-outline-laranja btn-sm " href="{{ route('coordenador.showLogin') }}">Coordenador</a>
    </div>
@endsection