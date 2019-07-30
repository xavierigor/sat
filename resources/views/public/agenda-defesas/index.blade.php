@extends('layouts.master')

@section('title', "Agenda de Defesas")

@section('header')
    <i class="far fa-calendar-alt fa-fw mr-2"></i> Agenda de Defesas
@endsection

@section('content')

<div class="table-responsive">

    @if($defesas->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Aluno</th>
                    <th scope="col">Título do Tcc</th>
                    <th scope="col">Orientador (Primeiro Avaliador)</th>
                    <th scope="col">Segundo Avaliador</th>
                    <th scope="col">Terceiro Avaliador</th>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Sala</th>
                </tr>
            </thead>

            <tbody>
                @foreach($defesas as $defesa)
                    <tr>
                        <td>{{ $defesa->aluno->name }}</td>
                        <td>{{ $defesa->aluno->tcc->titulo }}</td>
                        <td>{{ $defesa->getOrientador()->name ?? $defesa->getOrientador() }}</td>
                        <td>{{ $defesa->getSegundoAvaliador()->name ?? $defesa->getSegundoAvaliador() }}</td>
                        <td>{{ $defesa->getTerceiroAvaliador()->name ?? $defesa->getTerceiroAvaliador() }}</td>
                        <td>{{ DateTime::createFromFormat('Y-m-d', $defesa->data)->format('d/m/Y') }}</td>
                        <td>{{ $defesa->hora }}</td>
                        <td>{{ $defesa->sala }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            {{ $defesas->links() }}
        </div>
    @else
        <p>Nenhuma defesa encontrada.</p>
    @endif
</div>

@endsection