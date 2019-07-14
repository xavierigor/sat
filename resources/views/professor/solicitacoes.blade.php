@extends('layouts.admin')

@section('title', 'Solicitações')

@section('header')
<i class="fas fa-user fa-fw mr-2"></i> Perfil <i class="fas fa-angle-right fa-fw"></i> Solicitações
@endsection

@section('content')

    <div class="todas_solicitacoes">

        @isset($todas_solicitacoes)
            <!-- Importar modal aceitar/recusar solicitacao -->
            @include('includes.modal.solicitacao-recebida.aceitar')
            @include('includes.modal.solicitacao-recebida.recusar')

            @if($todas_solicitacoes->count() > 0)
                @foreach($todas_solicitacoes as $solicitacao)
                
                    <div class="row text-center text-center">

                        <div class="col-md-3 col-ms-12 d-flex ">
                            @if($solicitacao->solicitante->foto)
                                ​<img src="{{ asset('storage/perfil/users/' . $solicitacao->solicitante->foto) }}" class="img-perfil-solicitacao" alt="imagem do perfil">
                            @else
                            ​    <img src="{{ asset('images/user.png') }}" class="img-perfil-solicitacao" alt="imagem do perfil">
                            @endif
                        </div>
                        
                        <div class="col-md-9 col-ms-12 p-2 text-md-left ">
                            
                            <div class="m-auto ">
                                @if($solicitacao->tipo_solicitacao == "orientacao")
                                    <h5 class="d-inline-block">
                                        Orientar TCC de
                                        <a href="#" class="d-inline-block ml-1">
                                            <h5>{{ $solicitacao->solicitante->name }}</h5>
                                        </a>?
                                    </h5>
                                @elseif($solicitacao->tipo_solicitacao == "coorientacao")
                                    <h5 class="d-inline-block">
                                        Coorientar TCC de
                                        <a href="#" class="d-inline-block ml-1">
                                            <h5>{{ $solicitacao->solicitante->name }}</h5>
                                        </a>?
                                    </h5>
                                @endif
                            </div>

                            <div class="m-auto ">
                                <!-- Chamar modal aceitar solicitacao -->
                                <button title="Aceitar" type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#aceitarSolicitacao" data-nome="{{ $solicitacao->solicitante->name }}" 
                                    data-alunoid="{{ $solicitacao->solicitante->id }}"  data-tiposolic="{{ $solicitacao->tipo_solicitacao }}"
                                    data-idsolic="{{ $solicitacao->id }}">
                                    Aceitar
                                    <i class="fas fa-check fa-fw"></i>
                                </button>
                                <!-- Chamar modal cancelar solicitacao -->
                                <button title="Recusar" type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#recusarSolicitacao" data-nome="{{ $solicitacao->solicitante->name }}"
                                    data-alunoid="{{ $solicitacao->solicitante->id }}"  data-tiposolic="{{ $solicitacao->tipo_solicitacao }}"
                                    data-idsolic="{{ $solicitacao->id }}">
                                    Recusar
                                    <i class="fas fa-times fa-fw"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    <hr>

                @endforeach

                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $todas_solicitacoes->links() }}
                </div>

            @else
                <p>Nenhuma solicitação recebida.</p>
            @endif
        @endisset 
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/modal-solicitacao-recebida.js') }}"></script>
@endsection