@extends('layouts.admin')

@section('title', 'Documentos')

@section('header')
<i class="fas fa-file-pdf fa-fw"></i> Documentos
@endsection


@section('content')

    @include('includes.modal.remover-documento.professor.remover')

    <div class="documentos">
        @if($tr_status == "enviado")

            <h6>Arquivos enviados para coordenador.</h6>
            <a href="{{ route('professor.cancelar-envio.documentos') }}" class="mt-4 btn btn-outline-danger button-prevent-mult-submits">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Cancelar
            </a>
        @else
            <small class="form-text text-muted mb-4">
                <span class="text-danger">*</span> Apenas arquivos: pdf, odt, doc, docx
            </small>
            <form class="form-prevent-mult-submits" action="{{ route('professor.store.documentos') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="termo_de_responsabilidade" class="d-block font-weight-bold">Termo de Responsabilidade</label>

                    @if($termo_de_responsabilidade)
                        <div class="d-block mb-2">
                            <a target="_blank" 
                            href="{{asset('storage/documentos/professor/'.$termo_de_responsabilidade)}}">
                                {{$termo_de_responsabilidade}}
                            </a>
                        </div>
                        <div class="d-inline-block mt-1">
                            <a title="Baixar" href="{{asset('storage/documentos/professor/'.$termo_de_responsabilidade)}}"
                            download class="btn btn-sm btn-outline-success">
                                <i class="fas fa-file-download fa-fw"></i>
                                Baixar
                            </a>
                            <a title="Remover" data-toggle="modal" data-target="#removerDocumento" href="#" 
                            class="btn btn-sm btn-outline-danger" data-nome="{{ $termo_de_responsabilidade }}"
                            data-documento="termo_de_responsabilidade">
                                <i class="fas fa-trash-alt fa-fw"></i>
                                Remover
                            </a>
                        </div>
                    @else
                        <input type="file" name="termo_de_responsabilidade" id="termo_de_responsabilidade" 
                        class="d-inline-block {{ $errors->has('termo_de_responsabilidade') ? 'border-danger' : ''}}">
                    @endif

                    {!! $errors->first('termo_de_responsabilidade', '<small class="text-danger d-block mt-2">:message</small>') !!}
                </div>

                <button type="submit" class="btn btn-primary mt-4 button-prevent-mult-submits">
                    <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                    Salvar
                </button>
                <a href="{{ route('professor.enviar.documentos') }}" class="mt-4 btn btn-outline-primary button-prevent-mult-submits">
                    <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                    Enviar arquivo para o Coordenador
                </a>
            </form>

        @endif
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-remover.js') }}"></script>
@endsection