@extends('layouts.master')

@section('title', "Agenda de Defesas")

@section('header')
    <i class="far fa-calendar-alt fa-fw mr-2"></i> Agenda de Defesas
@endsection

@section('content')

<div class="table-responsive">

    @if($defesas->count() > 0)

        @if(Auth::guard('coordenador')->check())
            @include('includes.modal.defesa.remover')
        @endif

        <div class="defesa">
            @foreach($defesas as $defesa)
                <div class="data-defesa float-right">
                    <div style="width:50px;"
                    class="data-defesa-dia px-2 py-1 rounded-top">
                        <h5 class="my-auto"><b>
                        {{ Carbon\Carbon::parse($defesa->data)->format('d') }}
                        </b></h5>
                    </div>
                    <div style="width:50px;"
                    class="data-defesa-mes px-2 py-1 rounded-bottom border-top-0">
                        <small class="my-auto">
                        {{ date("F", mktime(0, 0, 0, Carbon\Carbon::parse($defesa->data)->format('m'), 1)) }}                        
                        </small>
                    </div>
                </div>
        
                <div class="header-defesa mb-4">
                    <div class="d-flex mr-2">
                        <h5 class="mb-0">
                            <b> Banca de defesa de {{ $defesa->aluno->name }} </b>
                        </h5>
                        @if(Auth::guard('coordenador')->check())
                            <div class="ml-3 d-inline-block">
                                <a href="#" data-toggle="modal" data-target="#removerDefesa" 
                                data-id="{{ $defesa->id }}" class="text-secondary" title="Excluir">
                                    <i class="far fa-trash-alt fa-fw"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                    <small>Cadastrado em {{ $defesa->created_at }} por coordenação.</small>
                </div>
        
                <div class="ml-4">
                    <div class="d-flex">
                        <h6 class="mr-2">Título: adasdadadadad{{ $defesa->aluno->tcc->titulo }}</h6>
                    </div>
                    
                    <div class="banca mt-3">
                        <h6>Banca: {{ $defesa->aluno->tcc->titulo }}</h6>
                        <div style="list-style-type: none;">
                            <div class="d-flex inline-block m-0">
                                <p class="m-0 mr-2">Orientador:</p>
                                @if($defesa->orientador_id)
                                    <a href="{{ route('public.professores.perfil', Hashids::encode($defesa->orientador_id)) }}">
                                        {{ $defesa->getOrientador()->name }}
                                    </a>
                                @else
                                    <p class="m-0">{{ $defesa->getOrientador() }}</p>
                                @endif
                            </div>
                            <div class="d-flex inline-block m-0">
                                <p class="m-0 mr-2">Avaliador 2:</p>
                                @if($defesa->avaliador_2_id)
                                    <a href="{{ route('public.professores.perfil', Hashids::encode($defesa->avaliador_2_id)) }}">
                                        {{ $defesa->getSegundoAvaliador()->name }}
                                    </a>
                                @else
                                    <p class="m-0">{{ $defesa->getSegundoAvaliador() }}</p>
                                @endif
                            </div>
                            <div class="d-flex inline-block m-0">
                                <p class="m-0 mr-2">Avaliador 3:</p>
                                @if($defesa->avaliador_3_id)
                                    <a href="{{ route('public.professores.perfil', Hashids::encode($defesa->avaliador_3_id)) }}">
                                        {{ $defesa->getTerceiroAvaliador()->name }}
                                    </a>
                                @else
                                    <p class="m-0">{{ $defesa->getTerceiroAvaliador() }}</p>
                                @endif
                            </div>
                            
                        </div>
                    </div>

                    <p class="banca mt-3">Data: {{ $defesa->data }} &centerdot; Hora: {{ $defesa->data }} &centerdot; Local: {{ $defesa->sala }}</p>
                </div>
                
                <br><hr>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-end">
            {{ $defesas->links() }}
        </div>
    @else
        <p>Nenhuma defesa encontrada.</p>
    @endif
</div>

@endsection

@if(Auth::guard('coordenador')->check())
    @section('scripts')
        <script src="{{ asset('js/modal-remover.js') }}"></script>
    @endsection
@endif