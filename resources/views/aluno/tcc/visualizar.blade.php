@extends('layouts.admin')

@section('title', 'Visualizar TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Visualizar
@endsection

@section('content')
    <div>
        <small class="text-uppercase text-muted mr-1">Dados sobre o Tcc</small>
        <div class="mt-3 mb-4">
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

        <small class="text-uppercase text-muted mr-1">Orientação e Coorientação</small>
        <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right"
        title="Os dados dessa sessão são preenchidos quando um professor aceitar sua solicitação de orientação ou coorientação."></i>
        
        <div class='mt-3'>
            <div>
                <h6 class="font-weight-bold">Orientador</h6>
                <p>{{ $orientacao->orientador->name ?? 'Não definido' }}</p>
            </div>
            <div>
                <h6 class="font-weight-bold">Coorientadores</h6>
                @foreach($coorientacao as $coorientador)
                    <p>{{ $coorientador->name }}</p>
                @endforeach
            </div>
        </div>
        
    </div>
@endsection