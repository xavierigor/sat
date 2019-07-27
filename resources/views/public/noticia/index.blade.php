@extends('layouts.master')

@section('title', "Notícias")

@section('header')
    <i class="fas fa-newspaper fa-fw mr-2"></i> Notícias
@endsection

@section('content')

    @if($noticias->count() > 0)

        @if(Auth::guard('coordenador')->check())
            @include('includes.modal.noticia.remover')
        @endif

        @foreach($noticias as $noticia)
            <div class="mb-4">
                <div class="d-block">
                    <a class="font-weight-bold" href="{{ route('public.noticia.show', Hashids::encode($noticia->id)) }}">
                        {!! $noticia->titulo !!}
                    </a>
                </div>
                <small>{{ $noticia->autor->name }}, {{ $noticia->created_at->diffForHumans() }}</small>

                @if(Auth::guard('coordenador')->check() && Auth::guard('coordenador')->user()->id == $noticia->autor->id)
                    <div class="ml-3 d-inline-block">
                        <a href="{{ route('coordenador.noticia.edit', Hashids::encode($noticia->id)) }}" 
                        class="text-secondary text-decoration-none" title="Editar">
                            <i class="fas fa-pen fa-fw"></i>
                        </a>
                        &centerdot;
                        <a href="#" data-toggle="modal" data-target="#removerNoticia" 
                        data-id="{{ $noticia->id }}" class="text-secondary" title="Excluir">
                            <i class="far fa-trash-alt fa-fw"></i>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach

        <div class="mt-5">
            {{ $noticias->links() }}
        </div>
    @else
        <p>Nenhuma notícia encontrada.</p>
    @endif
@endsection

@if(Auth::guard('coordenador')->check())
    @section('scripts')
        <script src="{{ asset('js/modal-remover.js') }}"></script>
    @endsection
@endif