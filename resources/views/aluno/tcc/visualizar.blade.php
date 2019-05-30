@extends('layouts.admin')

@section('title', 'Visualizar TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Visualizar
@endsection

@section('content')
    <div>
        <div>
            <h5>Título</h5>
            <p>{{ Auth::user()->tcc->titulo }}</p>
        </div>
        <div>
            <h5>Área de Pesquisa</h5>
            <p>{{ Auth::user()->tcc->area_de_pesquisa }}</p>
        </div>
        
    </div>
@endsection