@extends('layouts.master')

@section('title', 'Documentos Modelo')

@section('header')
    <i class="far fa-file-alt fa-fw mr-2"></i> Documentos Modelo
@endsection

@section('content')

    @if($documentos->count() > 0)

        @if(Auth::guard('coordenador')->check())
            @include('includes.modal.remover-documento.modelo.remover')
        @endif

        @foreach($documentos as $documento)
            <div class="documento mb-4">
                <small class="text-secondary d-block">
                    <i class="far fa-calendar-alt fa-fw mr-1"></i>
                    {{ $documento->created_at->format('d-m-Y') }}
                </small>

                <p class="my-0 d-inline font-weight-bold">{{ $documento->titulo }}</p>

                <small class="text-muted">
                    ({{ $documento->nome }})
                </small>

                <div>
                    <a target="_blank" href="{{ asset('storage/documentos/modelo/'. $documento->nome) }}">Ver</a>
                    <a class="mx-1" href="{{ asset('storage/documentos/modelo/'. $documento->nome) }}" download>Baixar</a>
                    @if(Auth::guard('coordenador')->check())
                        <a href="#" data-toggle="modal" data-target="#removerDocumentoModelo"
                        data-id="{{ $documento->id }}" data-nome="{{ $documento->nome }}">
                            Excluir
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
            
        <div class="mt-5">
            {{ $documentos->links() }}
        </div>
    @else
        <p>Nenhum documento modelo encontrado.</p>
    @endif
@endsection

@if(Auth::guard('coordenador')->check())
    @section('scripts')
        <script src="{{ asset('js/modal-remover.js') }}"></script>
    @endsection
@endif