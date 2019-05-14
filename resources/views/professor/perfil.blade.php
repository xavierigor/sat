@extends('layouts.admin')

@section('title', 'Visualizar Perfil')

@section('header')
<i class="fas fa-user fa-fw"></i> Visualizar Perfil
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div>
            <h5>Nome:</h5>
            <p>{{ Auth::user()->name }}</p>
        </div>
        <div>
            <h5>Matrícula:</h5>
            <p>{{ Auth::user()->matricula }}</p>
        </div>
        <div>
            <h5>Email:</h5>
            <p>{{ Auth::user()->email }}</p>
        </div>
        <div>
            <h5>Data de Nascimento:</h5>
            <p>{{ DateTime::createFromFormat('Y-m-d', Auth::user()->data_nasc)->format('d/m/Y') }}</p>
        </div>
        <div>
            <h5>Telefone:</h5>
            <p>{{ Auth::user()->telefone }}</p>
        </div>
    </div>
    <div class="col-md-8">
        <div>
            <h5>Área de Interesse:</h5>
            <p>{{ Auth::user()->area_de_interesse ? Auth::user()->area_de_interesse : 'Não especificada' }}</p>
        </div>
    </div>
</div>
@endsection