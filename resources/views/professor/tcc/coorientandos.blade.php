@extends('layouts.admin')

@section('title', 'Coorientandos')

@section('header')
<i class="fas fa-user-graduate fa-fw"></i> Coorientandos
@endsection

@section('content')

    @if($coorientacoes->count() > 0)

        <small class="text-uppercase text-muted mr-1">Suas coorientações</small>
        <br><br>

        <!-- Importar modal cancelar Coorientacao -->
        @include('includes.modal.coorientacao.remover-coorientando')

        @foreach($coorientacoes as $coorientacao)
            <div class="div-personalizada">
                <div class="div-img-media">
                    @if($coorientacao->coorientando->image)
                        <div class="circle img-perfil-media">
                            ​<img src="{{ asset('storage/perfil/users/' . $coorientacao->coorientando->image) }}"  alt="imagem do perfil">
                        </div>
                    @else
                        <div class="circle img-perfil-media">
                        ​    <img src="{{ asset('images/user.png') }}" alt="imagem do perfil">
                        </div>
                    @endif
                </div>
                <div class="text-md-left row d-flex my-auto">
                    <div class="col-md-12 col-sm-12">
                        <div class="m-auto ">
                            <h6 class="d-inline-block">
                                <a class="d-inline-block" href="#">
                                    {{ $coorientacao->coorientando->name }}   
                                </a>
                                é seu coorientando.
                            </h6>
                        </div>
                        <div class="m-auto ">
                            <!-- Chamar modal cancelar orientação -->
                            <button title="Cancelar" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                            data-target="#removerCoorientando" data-nome="{{ $coorientacao->coorientando->name }}"
                            data-id="{{ $coorientacao->coorientando->id }}">
                                Cancelar Coorientação
                                <i class="fas fa-times fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach

    @else
        <p>Nenhum coorientando.</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-co-o-rientacao.js') }}"></script>
@endsection