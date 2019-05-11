@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-form">
        <form method="POST" action="{{ route('professor.login') }}">
            @csrf

            @include('includes.forms.login')
        </form>

        <div class="row">
            <a class="voltar-escolha-login" title="Voltar" href="{{ route('public.escolhaLogin') }}">
                <i class="fas fa-arrow-left fa-fw"></i>
                Não sou professor
            </a>
        </div>
    </div>
@endsection
