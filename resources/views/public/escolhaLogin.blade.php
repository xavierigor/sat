@extends('layouts.auth')

@section('title', 'Iniciar Sessão')

@section('content')
    <div class="text-center mb-4">
        <i class="fas fa-user-circle fa-3x" style="color:rgba(0,0,0,0.8)"></i>
    </div>
    <div>
        <a class="mb-3" href="{{ route('login') }}">Aluno</a>
        <a class="mb-3" href="#">Professor</a>
        <a href="{{ route('coordenador.showLogin') }}">Coordenador</a>
    </div>
@endsection