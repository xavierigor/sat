@extends('layouts.master')

@section('title')
    {{ $noticia->titulo }}
@endsection

@section('header')
    <i class="fas fa-newspaper fa-fw mr-2"></i> <a href="{{ route('public.noticia.index') }}">Notícias</a> <i class="fas fa-angle-right fa-fw"></i> {{ $noticia->titulo }}
@endsection

@section('content')

    <div class="d-block mb-2">
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
        <div>
            <small>
                por <span class="font-weight-bold">{{ $noticia->autor->name }}</span> em {{ $noticia->created_at->format('d/m/Y') }}
            </small>
            <small class="float-right">
                Última atualização {{ $noticia->updated_at->diffForHumans() }}
            </small>
        </div>
    </div>

    <div class="mt-4" style="word-break: break-word;">
        <h1 class="m-0">
            <b>
                {{ $noticia->titulo }}
            </b>
        </h1>
        <small class="text-secondary">
            por <b>{{ $noticia->autor->name }}</b>&#10240;&centerdot;&#10240;{{ $noticia->created_at->format('d-m-Y') }}
        </small>

        <br><br><br>
        <h6>
            {!! $noticia->corpo !!}
        </h6>
    </div>
@endsection

@if(Auth::guard('coordenador')->check())
    @section('scripts')
        <script src="{{ asset('js/modal-remover.js') }}"></script>
    @endsection
@endif