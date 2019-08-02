@extends('layouts.admin')

@section('title', 'Orientandos')

@section('header')
<i class="fas fa-user-graduate fa-fw"></i> Orientandos
@endsection

@section('content')

    @if($orientacoes->count() > 0)

        <small class="text-uppercase text-muted mr-1">Suas orientações</small>
        <br><br>

        <!-- Importar modal cancelar Orientacao -->
        @include('includes.modal.orientacao.remover-orientando')
        @include('includes.modal.documentos.documentos-orientando')

        @foreach($orientacoes as $orientacao)
            <div class="div-personalizada">
                <div class="div-img-media">
                    @if($orientacao->orientando->image)
                        <div class="circle img-perfil-media">
                            ​<img src="{{ asset('storage/perfil/users/' . $orientacao->orientando->image) }}"  alt="imagem do perfil">
                        </div>
                    @else
                        <div class="circle img-perfil-media">
                        ​    <img src="{{ asset('images/user.png') }}" alt="imagem do perfil">
                        </div>
                    @endif
                </div>
                <div class="text-md-left row d-flex my-auto">
                    <div class="col-md-12 col-sm-12">
                        <div class="m-auto">
                            <h6 class="d-inline-block">
                                <a class="d-inline-block" href="#">
                                    {{ $orientacao->orientando->name }}   
                                </a>
                                é seu orientando.
                                <span class="ml-2 badge badge-secondary">
                                    {{ $orientacao->orientando->tcc->tcc }}
                                </span>
                            </h6>
                        </div>
                        <div class="m-auto">
                            <button type="button" class="mr-1 btn btn-outline-primary btn-sm"
                            data-documentos="{{ $orientacao->orientando->tcc->documentos }}"
                            data-tc_updated_at="{{ $orientacao->orientando->tcc->documentos->tc_updated_at ? $orientacao->orientando->tcc->documentos->tc_updated_at->format('d/m/Y H:i') : '' }}"
                            data-ra_updated_at="{{ $orientacao->orientando->tcc->documentos->ra_updated_at ? $orientacao->orientando->tcc->documentos->ra_updated_at->format('d/m/Y H:i') : '' }}"
                            data-nome="{{ $orientacao->orientando->name }}" data-id="{{ $orientacao->orientando->id }}"
                            data-tcc="{{ $orientacao->orientando->tcc->tcc }}"
                            data-toggle="modal" data-target="#mostrarDocumentos">
                                Documentos
                                <i class="fas fa-file-pdf fa-fw"></i>
                            </button>

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
    <script src="{{ asset('js/modal-documentos.js') }}"></script>
@endsection