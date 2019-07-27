@extends('layouts.master')

@section('title')
    {{ $noticia->titulo }}
@endsection

@section('header')
    <i class="fas fa-newspaper fa-fw mr-2"></i> {{ $noticia->titulo }}
@endsection

@section('content')

    <div class="d-block mb-2">
        <a href="{{ route('public.noticia.index') }}">
            <i class="fas fa-long-arrow-alt-left fa-fw"></i>
            Voltar
        </a>
        
        @if(Auth::guard('coordenador')->check() && Auth::guard('coordenador')->user()->id == $noticia->autor->id)
            <div class="float-right ml-3">
                <a href="{{ route('coordenador.noticia.edit', Hashids::encode($noticia->id)) }}"
                class="text-secondary text-decoration-none" title="Editar">
                    <i class="fas fa-pen fa-fw"></i>
                </a>
                &centerdot;
                <a href="#" class="text-secondary" title="Excluir" data-toggle="modal" 
                data-target="#removerNoticia" data-id="{{ $noticia->id }}">
                    <i class="far fa-trash-alt fa-fw"></i>
                </a>
            </div>

            @include('includes.modal.noticia.remover')
        @endif
        <small class="float-right">
            Última atualização {{ $noticia->updated_at->diffForHumans() }}
        </small>
    </div>

    <p class="text-secondary">
        por <span class="font-weight-bold">{{ $noticia->autor->name }}</span>&#10240;&centerdot;&#10240;{{ $noticia->created_at->format('d-m-Y') }}
    </p>

    <div class="mt-5" style="word-break: break-word;">
        {!! $noticia->corpo !!}
    </div>
@endsection

@if(Auth::guard('coordenador')->check())
    @section('scripts')
        <script src="{{ asset('js/modal-remover.js') }}"></script>
    @endsection
@endif