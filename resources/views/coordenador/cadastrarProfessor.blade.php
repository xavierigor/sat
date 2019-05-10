@extends('layouts.admin')

@section('title', 'Painel de Controle')

@section('header')
    <i class="fas fa-user fa-fw"></i> Cadastrar Professor
@endsection

@section('content')
    <div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- Hello <b>{{Auth::user()->name}}</b>, you are logged in as <b>Coordenador</b>! -->

        <form method="POST" action="{{ route('coordenador.salvarProfessor') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="inputAddress">Nome Completo</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Nome completo do professor">
                </div>
                <div class="form-group col-md-5">
                    <label for="inputPassword4">Matrícula</label>
                    <input type="number" class="form-control" id="inputPassword4" placeholder="012345678">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="professor@gmail.com">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
@endsection
