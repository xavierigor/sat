@extends('layouts.admin')

@section('title', 'Editar Tcc')

@section('header')
<i class="fas fa-scroll fa-fw"></i> Editar Tcc
@endsection

@section('content')
    <div>
        <form method="POST" action="{{ route('aluno.atualizar.tcc') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="titulo">Título</label>
                    <input value="{{ Auth::user()->tcc->titulo }}" type="text" class="form-control {{ $errors->has('titulo') ? 'border-danger' : ''}}" id="titulo" name="titulo">
                    {!! $errors->first('titulo', '<small class="text-danger">:message</small>') !!}
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="area_de_pesquisa">Área de Pesquisa</label>
                    <input value="{{ Auth::user()->tcc->area_de_pesquisa }}" type="text" class="form-control {{ $errors->has('area_de_pesquisa') ? 'border-danger' : ''}}" id="area_de_pesquisa" name="area_de_pesquisa">
                    {!! $errors->first('area_de_pesquisa', '<small class="text-danger">:message</small>') !!}
                </div>
                <!-- <div class="form-group col-md-6">
                    <label for="orientador">Orientador</label>
                    <input value="" type="text" class="form-control {{ $errors->has('orientador') ? 'border-danger' : ''}}" id="orientador" name="orientador">
                    {!! $errors->first('orientador', '<small class="text-danger">:message</small>') !!}
                </div> -->
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
@endsection