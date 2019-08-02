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

                <small class="text-uppercase text-muted mr-1">Solicitações recebidas</small>
                <br><br>

                @foreach($todas_solicitacoes as $solicitacao)

                    <div class="div-personalizada">

                        <div class="div-img-solicitacao">
                            @if($solicitacao->solicitante->image)
                                ​<img src="{{ asset('storage/perfil/users/' . $solicitacao->solicitante->image) }}" class="img-perfil-solicitacao" alt="imagem do perfil">
                            @else
                            ​    <img src="{{ asset('images/user.png') }}" class="img-perfil-solicitacao" alt="imagem do perfil">
                            @endif
                        </div>
                        
                        <div class="text-md-left">
                            
                            <div class="m-auto ">
                                @if($solicitacao->tipo_solicitacao == "orientacao")
                                    <h6 class="d-inline-block">
                                        Orientar TCC de
                                        <a href="#" class="d-inline-block">
                                            <h6>{{ $solicitacao->solicitante->name }}</h6>
                                        </a>?
                                    </h6>
                                @elseif($solicitacao->tipo_solicitacao == "coorientacao")
                                    <h6 class="d-inline-block">
                                        Coorientar TCC de
                                        <a href="#" class="d-inline-block">
                                            <h6>{{ $solicitacao->solicitante->name }}</h6>
                                        </a>?
                                    </h6>
                                @endif
                            </div>
                            @if($solicitacao->tipo_solicitacao == "orientacao" && Auth::guard('professor')->user()->disponivel_orient == false)
                                <p>Você já atingiu o número máximo de orientandos.</p>
                            @else
                                <div class="m-auto ">
                                    <!-- Chamar modal aceitar solicitacao -->
                                    <button title="Aceitar" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal"
                                        data-target="#aceitarSolicitacao" data-nome="{{ $solicitacao->solicitante->name }}" 
                                        data-alunoid="{{ $solicitacao->solicitante->id }}"  data-tiposolic="{{ $solicitacao->tipo_solicitacao }}"
                                        data-idsolic="{{ $solicitacao->id }}">
                                        Aceitar
                                        <i class="fas fa-check fa-fw"></i>
                                    </button>
                                    <!-- Chamar modal cancelar solicitacao -->
                                    <button title="Recusar" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                        data-target="#recusarSolicitacao" data-nome="{{ $solicitacao->solicitante->name }}"
                                        data-alunoid="{{ $solicitacao->solicitante->id }}"  data-tiposolic="{{ $solicitacao->tipo_solicitacao }}"
                                        data-idsolic="{{ $solicitacao->id }}">
                                        Recusar
                                        <i class="fas fa-times fa-fw"></i>
                                    </button>
                                </div>
                            @endif

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