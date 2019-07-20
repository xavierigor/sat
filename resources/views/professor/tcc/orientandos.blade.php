@extends('layouts.admin')

@section('title', 'Orientandos')

@section('header')
<i class="fas fa-user-graduate fa-fw"></i> Orientandos
@endsection

@section('content')

    @if($orientacoes->count() > 0)

        <!-- Importar modal cancelar Orientacao -->
        @include('includes.modal.orientacao.remover-orientando')

        @foreach($orientacoes as $orientacao)
            <div class="div-personalizada">
                <div class="div-img-media">
                    @if($orientacao->orientando->image)
                        ​<img src="{{ asset('storage/perfil/users/' . $orientacao->orientando->image) }}"  class="img-perfil-media" alt="imagem do perfil">
                    @else
                    ​    <img src="{{ asset('images/user.png') }}" class="img-perfil-media" alt="imagem do perfil">
                    @endif
                </div>
                <div class="text-md-left row d-flex my-auto">
                    <div class="col-md-12 col-sm-12">
                        <div class="m-auto ">
                            <h6 class="d-inline-block">
                                <a class="d-inline-block" href="#">
                                    {{ $orientacao->orientando->name }}   
                                </a>
                                é seu orientando.
                            </h6>
                        </div>
                        <div class="m-auto ">
                            <!-- Chamar modal cancelar orientação -->
                            <button title="Cancelar" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                            data-target="#removerOrientando" data-nome="{{ $orientacao->orientando->name }}"
                            data-id="{{ $orientacao->orientando->id }}">
                                Cancelar Orientação
                                <i class="fas fa-times fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach

    @else
        <p>Nenhum orientando.</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-co-o-rientacao.js') }}"></script>
@endsection