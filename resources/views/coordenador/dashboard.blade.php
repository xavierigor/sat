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


        <div class="row mb-2 mb-md-3">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="dashboard-card purple">
                    <div class="icon">
                        <i class="fas fa-user-graduate fa-fw fa-lg"></i>
                    </div>
                    <div class="info">
                        <strong class="d-block">{{ $alunos }}</strong>
                        Alunos cadastrados
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="dashboard-card blue">
                    <div class="icon">
                        <i class="fas fa-user fa-fw fa-lg"></i>
                    </div>
                    <div class="info">
                        <strong class="d-block">{{ $professores }}</strong>
                        Professores cadastrados
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="dashboard-card green">
                    <div class="icon">
                        <i class="fas fa-newspaper fa-fw fa-lg"></i>
                    </div>
                    <div class="info">
                        <strong class="d-block">{{ $noticias }}</strong>
                        Notícias cadastradas
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <!-- Implementar ainda -->
                <!-- Defesa mais próxima ou defesa de hoje? -->
                <div class="dashboard-card pink large">
                    <div class="icon">
                        <i class="far fa-calendar-alt fa-fw fa-lg"></i>
                    </div>
                    <div class="info">
                        <strong class="d-block">Aluno, às 08:00hrs na sala 406</strong>
                        Defesa mais próxima/Defesa de hoje
                    </div>
                </div>
            </div>
        </div>

        {{-- Olá <b>{{Auth::user()->name}}</b>, seja bem-vindo(a) ao SAT!<br> --}}
    </div>
@endsection
