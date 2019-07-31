@extends('layouts.admin')

@section('title', 'Visualizar TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Visualizar
@endsection

@section('content')
    <div>
        <div>
            <h6 class="font-weight-bold">Disciplina</h6>
            <p>{{ ucfirst(Auth::user()->tcc->tcc) }}</p>
        </div>
        <div>
            <h6 class="font-weight-bold">Título</h6>
            <p>{{ Auth::user()->tcc->titulo ?? 'Não definido' }}</p>
        </div>
        <div>
            <h6 class="font-weight-bold">Área de Pesquisa</h6>
            <p>{{ Auth::user()->tcc->area_de_pesquisa }}</p>
        </div>
        
    </div>
@endsection