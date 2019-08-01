@extends('layouts.admin')

@section('title', 'Cadastrar Documento Modelo')

@section('header')
<i class="fas fa-globe-americas fa-fw mr-2"></i> Site <i class="fas fa-angle-right fa-fw"></i> Cadastrar Documento Modelo
@endsection

@section('content')
    
    <div>
        <small class="d-block mb-3">Os campos com <span class="text-danger">*</span> são obrigatórios</small>

        <form enctype="multipart/form-data" class="form-prevent-mult-submits quill-form" method="POST" action="{{ route('coordenador.dm.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nome">Nome do Documento <span class="text-danger">*</span></label>
                    <input value="{{ old('nome') }}" type="text" class="form-control form-control-sm {{ $errors->has('nome') ? 'border-danger' : ''}}" id="nome" name="nome">
                    {!! $errors->first('nome', '<small class="text-danger">:message</small>') !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="arquivo">Documento <span class="text-danger">*</span></label>
                    <input class="form-control-file {{ $errors->has('arquivo') ? 'border-danger' : ''}}" type="file" name="arquivo" id="arquivo">
                    {!! $errors->first('arquivo', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">Apenas arquivos: pdf, odt, doc, docx</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary button-prevent-mult-submits mt-3" title="Cadastrar documento modelo">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Cadastrar
            </button>
        </form>
    </div>

@endsection
