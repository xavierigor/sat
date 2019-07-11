@extends('layouts.admin')

@section('title', 'Solicitações')

@section('header')
<i class="fas fa-user fa-fw mr-2"></i> Perfil <i class="fas fa-angle-right fa-fw"></i> Solicitações
@endsection

@section('content')

    <div class="todas_solicitacoes">

        @isset($todas_solicitacoes)
            <!-- Importar modal aceitar recusar solicitacao -->
            @include('includes.modal.solicitacao-orientacao.aceitar')
            @include('includes.modal.solicitacao-orientacao.recusar')

            @if($todas_solicitacoes->count() > 0)
                @foreach($todas_solicitacoes as $solicitacao)

                    <div class="row text-center text-md-left">
                        <div class="col-md-2 col-ms-12 d-flex">
                            @if($solicitacao->aluno_foto)
                                ​<img src="{{ asset('storage/perfil/users/' . $solicitacao->aluno_foto) }}" class="rounded-circle m-auto" width="80px" height="80px">
                            @else
                            ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle m-auto" alt="avatar" width="80px" height="80px">
                            @endif
                        </div>
                        
                        <div class="col-md-10 col-ms-12 pt-4">
                            <h5>Solicitação de {{$solicitacao->tipo_solicitacao}} de TCC recebida</h5>
                            <a href="#">
                                <h5>{{ $solicitacao->aluno_nome }}</h5>
                            </a>
                            <br>
                            <!-- Chamar modal aceitar solicitacao -->
                            <button title="Solicitar" type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#aceitarSolicitacao" data-nome="{{ $solicitacao->aluno_nome }}" 
                                data-alunoid="{{ $solicitacao->aluno_id }}"  data-tiposolic="{{ $solicitacao->tipo_solicitacao }}"
                                data-idsolic="{{ $solicitacao->id }}">
                                Aceitar
                                <i class="fas fa-paper-plane fa-fw"></i>
                            </button>
                            <!-- Chamar modal cancelar solicitacao -->
                            <button title="Recusar" type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#recusarSolicitacao" data-nome="{{ $solicitacao->aluno_nome }}"
                                data-alunoid="{{ $solicitacao->aluno_id }}"  data-tiposolic="{{ $solicitacao->tipo_solicitacao }}"
                                data-idsolic="{{ $solicitacao->id }}">
                                Recusar
                                <i class="fas fa-times fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <hr>

                @endforeach

                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $todas_solicitacoes->links() }}
                </div>

            @else
                <p>Nenhuma solicitação de orientação de Tcc recebida.</p>
            @endif
        @endisset 
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/modal-solicitacao-recebida.js') }}"></script>
@endsection