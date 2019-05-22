@extends('layouts.admin')

@section('title', 'Visualizar Tcc')

@section('header')
<i class="fas fa-scroll fa-fw"></i> Visualizar Tcc
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
        {{-- <div>
            <h5>Orientador</h5>
            <p>{{ Auth::user()->tcc->orientador }}</p>
        </div> --}}
    </div>
@endsection