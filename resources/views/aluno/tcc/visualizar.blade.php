@extends('layouts.admin')

@section('title', 'Visualizar Tcc')

@section('header')
<i class="fas fa-scroll fa-fw"></i> Visualizar Tcc
@endsection

@section('content')
    <div>
        <div>
            <h4>Título</h4>
            <p>{{ Auth::user()->tcc->titulo }}</p>
        </div>
        <div>
            <h4>Área de Pesquisa</h4>
            <p>{{ Auth::user()->tcc->area_de_pesquisa }}</p>
        </div>
        {{-- <div>
            <h4>Orientador</h4>
            <p>{{ Auth::user()->tcc->orientador }}</p>
        </div> --}}
    </div>
@endsection