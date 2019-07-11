@extends('layouts.admin')

@section('title', 'Coorientadores de TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Coorientadores
@endsection

@section('content')

    <div class="coorientadores">

        <!-- Se já existe um orientador associado ao aluno -->
        @isset($coorientacoes)

            <!-- Importar modal cancelar Orientacao -->
            @include('includes.modal.coorientacao.cancelar')

            @foreach($coorientacoes as $coorientacao)

                <div class="row  text-center text-md-left">
                    <div class="col-md-3 col-ms-12">
                        @if($coorientacao->coorientador->image)
                            ​<img src="{{ asset('storage/perfil/professores/' . $coorientacao->coorientador->image) }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="180px" height="180px">
                        @else
                        ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px" height="180px">
                        @endif
                    </div>
                    <div class="col-md-8 col-ms-12 pt-2">
                        <h3>Você tem um coorientador.</h3>
                        <a href="#">
                            {{ $coorientacao->coorientador->name }}
                        </a>
                        <br>
                        <br>
                        <!-- Chamar modal cancelar orientação -->
                        <button title="Cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#cancelarCoorientacao" data-nome="{{ $coorientacao->coorientador->name }}"
                            data-id="{{ $coorientacao->coorientador->id }}" data-tiposolicitacao="coorientacao">
                            Cancelar Coorientação
                            <i class="fas fa-times fa-fw"></i>
                        </button>
                    </div>
                </div>
                <hr>
            @endforeach
            
        @endisset

        <!-- Se existe um professor solicitado pelo aluno -->
        @isset($solicitacoes)
    
            <!-- Importar modal cancelar solicitacao -->
            @include('includes.modal.solicitar-co-orientacao.cancelar')
            @foreach($solicitacoes as $solicitacao)
                <div class="row text-center text-md-left">
                    <div class="col-md-3 col-ms-12">
                        @if($solicitacao->solicitado->image)
                            ​<img src="{{ asset('storage/perfil/professores/' . $solicitacao->solicitado->image) }}" class="rounded-circle" width="180px" height="180px">
                        @else
                        ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px" height="180px">
                        @endif
                    </div>
                    <div class="col-md-9 col-ms-12 pt-4">
                        <h5>Solicitação de coorientação de TCC enviada</h5>
                        <a href="#">
                            <h5>{{ $solicitacao->solicitado->name }}</h5>
                        </a>
                        <br>
                        <!-- Chamar modal cancelar solicitacao -->
                        <button title="Cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#cancelarSolicitacao" data-nome="{{ $solicitacao->solicitado->name }}"
                            data-id="{{ $solicitacao->solicitado->id }}" data-tiposolicitacao="coorientacao">
                            Cancelar Solicitação
                            <i class="fas fa-times fa-fw"></i>
                        </button>
                    </div>
                </div>
                <br>
            @endforeach
            <br><br>
            <a href="{{ route('aluno.tcc.coorientadores.solicitar') }}" class="btn btn-primary">
                Solicitar Novos Coorientadores
                <i class="fas fa-arrow-right fa-fw"></i>
            </a>

        @endisset


@endsection

@section('scripts')
    <script src="{{ asset('js/modal-co-orientacao.js') }}"></script>
    <script src="{{ asset('js/modal-solicitacao-co-orientador.js') }}"></script>
@endsection