@extends('layouts.admin')

@section('title', 'Documentos Tcc')

@section('header')
<i class="fas fa-scroll fa-fw"></i> Documentos Tcc
@endsection

@section('content')
   
    <div class="documentos">
        <form class="mt-3">

            <div class="form-group row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="custom-file">
                            <input id="inputGroupFile01" type="file" name="documento1"  id="documento1"
                            class="custom-file-input {{ $errors->has('documento1') ? 'border-danger' : ''}}">
                            <label class="custom-file-label" for="inputGroupFile01">Documento 1</label>
                            {!! $errors->first('image', '<small class="text-danger">:message</small>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="">
                        <button title="Baixar" type="button" class="btn btn-outline-success">
                            <i class="fas fa-file-download fa-fw"></i>
                            Baixar
                        </button>
                        <button title="Remover" type="button" class="btn btn-outline-danger">
                            <i class="fas fa-trash-alt fa-fw"></i>
                            Remover
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="custom-file">
                            <input id="inputGroupFile02" type="file" name="documento2"  id="documento2"
                            class="custom-file-input {{ $errors->has('documento2') ? 'border-danger' : ''}}">
                            <label class="custom-file-label" for="inputGroupFile02">Documento 2</label>
                            {!! $errors->first('image', '<small class="text-danger">:message</small>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="">
                        <button title="Anexar" type="button" class="btn btn-outline-primary">
                            <i class="fas fa-paperclip fa-fw"></i>
                            Anexar
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <div class="custom-file">
                            <input id="inputGroupFile03" type="file" name="documento3"  id="documento3"
                            class="custom-file-input {{ $errors->has('documento3') ? 'border-danger' : ''}}">
                            <label class="custom-file-label" for="inputGroupFile03">Documento 3</label>
                            {!! $errors->first('image', '<small class="text-danger">:message</small>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="">
                        <button title="Anexar" type="button" class="btn btn-outline-primary">
                            <i class="fas fa-paperclip fa-fw"></i>
                            Anexar
                        </button>
                    </div>
                </div>
            </div>
        </form>

        
        
    </div>

@endsection