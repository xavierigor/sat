@extends('layouts.admin')

@section('title', 'Editar TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Editar
@endsection

@section('content')
    <div>
        <form class="form-prevent-mult-submits" method="POST" action="{{ route('aluno.atualizar.tcc') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="titulo">Título</label>
                    <input value="{{ Auth::user()->tcc->titulo }}" type="text" class="form-control form-control-sm {{ $errors->has('titulo') ? 'border-danger' : ''}}" id="titulo" name="titulo">
                    {!! $errors->first('titulo', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">
                        Título do Tcc
                    </small>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="area_de_pesquisa">Área de Pesquisa</label>
                    <input value="{{ Auth::user()->tcc->area_de_pesquisa }}" type="text" class="form-control form-control-sm {{ $errors->has('area_de_pesquisa') ? 'border-danger' : ''}}" id="area_de_pesquisa" name="area_de_pesquisa">
                    {!! $errors->first('area_de_pesquisa', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">
                        Aréa de pesquisa do Tcc
                    </small>
                </div>
            </div>

            <button type="submit" class="mt-2 btn btn-primary btn-sm button-prevent-mult-submits btn-sm" title="Salvar alterações">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Salvar Alterações
            </button>
        </form>
    </div>
@endsection