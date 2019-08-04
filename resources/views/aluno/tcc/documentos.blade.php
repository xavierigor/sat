@extends('layouts.admin')

@section('title', 'Documentos TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Documentos
@endsection


@section('content')

    @include('includes.modal.remover-documento.remover')
    @include('includes.modal.envio-documentos.aluno.enviar')
    @include('includes.modal.envio-documentos.aluno.cancelar')

    <div class="documentos">

        <small class="text-uppercase text-muted mr-1">Seus documentos de tcc</small>
        <br><br>

        @if(Auth::user()->tcc->documentos->tc_status == "enviado")

            <h6>Arquivos enviados para coordenador.</h6>
            <a title="cancelar" data-toggle="modal" data-target="#cancelarEnvioDocumentos" href="#" 
            class="mt-4 btn btn-outline-danger">
                <i class="fas fa-times fa-fw"></i>
                Cancelar envio
            </a>
        
        @else

            <small class="form-text text-muted mb-4">
                <span class="text-danger">*</span> Apenas arquivos: pdf, odt, doc, docx
            </small>
            <form class="form-prevent-mult-submits" action="{{ route('aluno.store.documentos') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="termo_de_compromisso" class="d-block font-weight-bold">Termo de Compromisso</label>

                    @if(Auth::user()->tcc->documentos->termo_de_compromisso)
                        <div class="d-block mb-2">
                            <a target="_blank" 
                            href="{{asset('storage/documentos/tcc/'.Auth::user()->tcc->documentos->termo_de_compromisso)}}">
                                {{Auth::user()->tcc->documentos->termo_de_compromisso}}
                            </a>
                            <small class="mt-1 d-block text-muted">{{ Auth::user()->tcc->documentos->tc_updated_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <div class="d-inline-block">
                            <a title="Baixar documento" href="{{asset('storage/documentos/tcc/'.Auth::user()->tcc->documentos->termo_de_compromisso)}}"
                            download class="tc mr-1 text-decoration-none text-secondary">
                                <i class="fas fa-file-download fa-fw"></i>
                                Baixar
                            </a>
                            &centerdot;
                            <a title="Remover documento" data-toggle="modal" data-target="#removerDocumento" href="#" 
                            class="tc text-decoration-none text-secondary" data-nome="{{ Auth::user()->tcc->documentos->termo_de_compromisso }}"
                            data-documento="termo_de_compromisso">
                                <i class="fas fa-trash-alt fa-fw"></i>
                                Remover
                            </a>
                        </div>
                        
                    @else
                        <input type="file" name="termo_de_compromisso" id="termo_de_compromisso" 
                        class="d-inline-block {{ $errors->has('termo_de_compromisso') ? 'border-danger' : ''}}">
                    @endif

                    {!! $errors->first('termo_de_compromisso', '<small class="text-danger d-block mt-2">:message</small>') !!}
                </div>

                {{-- @else

                    <div class="form-group">
                        <label for="termo_de_compromisso" class="d-block font-weight-bold">Termo de Compromisso</label>

                        @if(Auth::user()->tcc->termo_de_compromisso)
                            <div class="d-block mb-2">
                                <a target="_blank" 
                                href="{{asset('storage/documentos/tcc/'.Auth::user()->tcc->termo_de_compromisso)}}">
                                    {{Auth::user()->tcc->termo_de_compromisso}}
                                </a>
                            </div>
                            <div class="d-inline-block">
                                <a title="Baixar documento" href="{{asset('storage/documentos/tcc/'.Auth::user()->tcc->termo_de_compromisso)}}"
                                download class="tc mr-1 text-decoration-none text-secondary">
                                    <i class="fas fa-file-download fa-fw"></i>
                                    Baixar
                                </a>
                                &centerdot;
                                <a title="Remover documento" data-toggle="modal" data-target="#removerDocumento" href="#" 
                                class="tc text-decoration-none text-secondary" data-nome="{{ Auth::user()->tcc->termo_de_compromisso }}"
                                data-documento="termo_de_compromisso">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                    Remover
                                </a>
                            </div>
                        @else
                            <input type="file" name="termo_de_compromisso" id="termo_de_compromisso" 
                            class="d-inline-block {{ $errors->has('termo_de_compromisso') ? 'border-danger' : ''}}">
                        @endif

                        {!! $errors->first('termo_de_compromisso', '<small class="text-danger d-block mt-2">:message</small>') !!}
                    </div> --}}

                @if(Auth::user()->tcc->disciplina == "tcc 2")
                    <div class="form-group mt-5">
                        <label for="rel_acompanhamento" class="d-block font-weight-bold">Relatório de Acompanhamento</label>
                        @if(Auth::user()->tcc->documentos->rel_acompanhamento)
                            <div class="d-block mb-2">
                                <a target="_blank" 
                                href="{{asset('storage/documentos/tcc/'.Auth::user()->tcc->rel_acompanhamento)}}">
                                    {{Auth::user()->tcc->documentos->rel_acompanhamento}}
                                </a>
                                <small class="mt-1 d-block text-muted">{{ Auth::user()->tcc->documentos->ra_updated_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div class="d-inline-block">
                                <a title="Baixar documento" href="{{asset('storage/documentos/tcc/'.Auth::user()->tcc->documentos->rel_acompanhamento)}}"
                                download class="ra mr-1 text-decoration-none text-secondary">
                                    <i class="fas fa-file-download fa-fw"></i>
                                    Baixar
                                </a>
                                &centerdot;
                                <a title="Remover documento" data-toggle="modal" data-target="#removerDocumento" href="#" 
                                class="ra text-decoration-none text-secondary" data-nome="{{ Auth::user()->tcc->documentos->rel_acompanhamento }}"
                                data-documento="rel_acompanhamento">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                    Remover
                                </a>
                            </div>
                        @else
                            <input type="file" name="rel_acompanhamento" id="rel_acompanhamento" 
                            class="d-inline-block {{ $errors->has('rel_acompanhamento') ? 'border-danger' : ''}}">
                        @endif

                        {!! $errors->first('rel_acompanhamento', '<small class="text-danger d-block mt-2">:message</small>') !!}
                    </div>
                @endif
                
                <div class="botoes mt-5">
                    
                    @if(Auth::user()->tcc->documentos->termo_de_compromisso && Auth::user()->tcc->documentos->rel_acompanhamento)
                        <a title="Enviar documentos para coordenador" data-toggle="modal" data-target="#enviarDocumentos" href="#" 
                            class="btn btn-primary">
                            Enviar para Coordenador
                            <i class="fas fa-paper-plane fa-fw"></i>
                        </a>
                    @else
                        <button type="submit" class="btn btn-primary button-prevent-mult-submits" title="Salvar documentos">
                            <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                            Salvar
                        </button>
                    @endif
                </div>
            </form>
        
        @endif
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-remover.js') }}"></script>
@endsection