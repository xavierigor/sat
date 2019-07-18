@extends('layouts.admin')

@section('title', 'Documentos TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Documentos
@endsection


@section('content')

    @include('includes.modal.remover-documento.remover')

    <div class="documentos">
        <small class="form-text text-muted mb-4">
            <span class="text-danger">*</span> Apenas arquivos: pdf, odt, doc, docx
        </small>
        <form class="form-prevent-mult-submits" action="{{ route('aluno.store.documentos') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="termo_de_compromisso" class="d-block font-weight-bold">Termo de Compromisso</label>

                @if($termo_de_compromisso)
                    <div class="d-block mb-2">
                        <a target="_blank" 
                        href="{{asset('storage/documentos/tcc/'.$termo_de_compromisso)}}">
                            {{$termo_de_compromisso}}
                        </a>
                    </div>
                    <div class="d-inline-block mt-1">
                        <a title="Baixar" href="{{asset('storage/documentos/tcc/'.$termo_de_compromisso)}}"
                        download class="btn btn-sm btn-outline-success">
                            <i class="fas fa-file-download fa-fw"></i>
                            Baixar
                        </a>
                        <a title="Remover" data-toggle="modal" data-target="#removerDocumento" href="#" 
                        class="btn btn-sm btn-outline-danger" data-nome="{{ $termo_de_compromisso }}"
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

            <div class="form-group mt-5">
                <label for="rel_acompanhamento" class="d-block font-weight-bold">Relatório de Acompanhamento</label>
                @if($rel_acompanhamento)
                    <div class="d-block mb-2">
                        <a target="_blank" 
                        href="{{asset('storage/documentos/tcc/'.$rel_acompanhamento)}}">
                            {{$rel_acompanhamento}}
                        </a>
                    </div>
                    <div class="d-inline-block mt-1">
                        <a title="Baixar" href="{{asset('storage/documentos/tcc/'.$rel_acompanhamento)}}"
                        download class="btn btn-sm btn-outline-success">
                            <i class="fas fa-file-download fa-fw"></i>
                            Baixar
                        </a>
                        <a title="Remover" data-toggle="modal" data-target="#removerDocumento" href="#" 
                        class="btn btn-sm btn-outline-danger" data-nome="{{ $rel_acompanhamento }}"
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

            <button type="submit" class="btn btn-primary mt-4 button-prevent-mult-submits">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Salvar
            </button>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-remover.js') }}"></script>
@endsection