@extends('layouts.admin')

@section('title', 'Notificações')

@section('header')
<i class="fas fa-bell fa-fw mr-2"></i> Notificações
@endsection

@section('content')

    <div class="todas_notificacoes">

        @isset($todas_notificacoes)
            @if($todas_notificacoes->count() > 0)
                
                @php
                    $cont_novas = $novas_notificacoes
                @endphp

                @foreach($todas_notificacoes as $notificacao)

                    @if($cont_novas > 0)
                        <div class="caixa-notificacao text-info">
                            <div class="data-notificacao d-flex justify-content-end">
                                <small>{{ date("d/m/Y", strtotime($notificacao->updated_at) ) }}</small>
                            </div>
                            <div class="mensagem-notificacao">
                                <h6 class="font-weight-bold">{{$notificacao->mensagem}} (nova) </h6>
                            </div>
                        </div>
                        <hr>
                        @php
                            $cont_novas -= 1
                        @endphp
                    @else
                        <div class="caixa-notificacao">
                            <div class="data-notificacao d-flex justify-content-end">
                                <small>{{ date("d/m/Y", strtotime($notificacao->updated_at) ) }}</small>
                            </div>
                            <div class="mensagem-notificacao">
                                <h6>{{$notificacao->mensagem}}</h6>
                            </div>
                        </div>
                        <hr>
                    @endif
                    
                @endforeach

                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $todas_notificacoes->links() }}
                </div>

            @else
                <p>Nenhuma notificação recebida.</p>
            @endif
        @endisset 
    </div>

@endsection

@section('scripts')
@endsection