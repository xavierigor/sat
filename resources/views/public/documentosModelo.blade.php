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
            <div class="documento">
                <small class="text-secondary float-right">
                    Cadastrado em: 
                    <i class="far fa-calendar-alt fa-fw mr-1"></i>
                    {{ $documento->created_at->format('d-m-Y') }}
                </small>

                <p class="my-0 d-inline font-weight-bold">{{ $documento->titulo }}</p>

                <!-- <small class="text-muted">
                    ({{ $documento->nome }})
                </small> -->

                <div class="mt-3">
                    <a class="mr-1 text-decoration-none text-secondary" target="_blank" href="{{ asset('storage/documentos/modelo/'. $documento->nome) }}">
                        <i class="far fa-eye fa-fw"></i>
                        Ver
                    </a>
                    &centerdot;
                    <a class="mr-1 text-decoration-none text-secondary" href="{{ asset('storage/documentos/modelo/'. $documento->nome) }}" download>
                        <i class="fas fa-file-download fa-fw"></i>
                        Baixar
                    </a>
                    @if(Auth::guard('coordenador')->check())
                        &centerdot;
                        <a href="#" class="mr-1 text-decoration-none text-secondary" data-toggle="modal" data-target="#removerDocumentoModelo"
                        data-id="{{ $documento->id }}" data-nome="{{ $documento->nome }}">
                            <i class="fas fa-trash-alt fa-fw"></i>
                            Excluir
                        </a>
                    @endif
                </div>
                <hr>
            </div>
        @endforeach
            
        <div class="mt-5">
            {{ $documentos->links() }}
        </div>
    @else
        <p>Nenhum documento modelo cadastrado.</p>
    @endif
@endsection

@if(Auth::guard('coordenador')->check())
    @section('scripts')
        <script src="{{ asset('js/modal-remover.js') }}"></script>
    @endsection
@endif