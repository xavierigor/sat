@extends('layouts.admin')

@section('title', 'Cadastrar Professor')

@section('header')
<i class="fas fa-user-plus fa-fw mr-2"></i> Professor <i class="fas fa-angle-right fa-fw"></i> Cadastrar
@endsection

@section('content')
    
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <small class="d-block mb-3">Os campos com <span class="text-danger">*</span> são obrigatórios</small>

        <form class="form-prevent-mult-submits" method="POST" action="{{ route('coordenador.salvar.professor') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="name">Nome Completo <span class="text-danger">*</span></label>
                    <input value="{{ old('name') }}" type="text" class="form-control form-control-sm {{ $errors->has('name') ? 'border-danger' : ''}}" id="name" name="name">
                    {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">
                        Nome completo do professor
                    </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="matricula">Matrícula <span class="text-danger">*</span></label>
                    <input value="{{ old('matricula') }}" type="number" class="form-control form-control-sm {{ $errors->has('matricula') ? 'border-danger' : ''}}" id="matricula" name="matricula">
                    {!! $errors->first('matricula', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">
                      Matrícula do professor
                    </small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input value="{{ old('email') }}" type="email" class="form-control form-control-sm {{ $errors->has('email') ? 'border-danger' : ''}}" id="email" name="email">
                    {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">
                        Email do professor
                    </small>
                </div>
                <div class="form-group col-md-3">
                    <label for="data_nasc">Data de Nascimento <span class="text-danger">*</span></label>
                    <input value="{{ old('data_nasc') }}" type="date" class="form-control form-control-sm {{ $errors->has('data_nasc') ? 'border-danger' : ''}}" id="data_nasc" name="data_nasc">
                    {!! $errors->first('data_nasc', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">
                        A data de nascimento será usada como senha pelo professor no formato
                        <span class="font-weight-bold">ddmmaaaa</span>
                    </small>
                </div>
            </div>
            
            <button type="submit" class="mt-2 btn btn-primary btn-sm button-prevent-mult-submits" title="Cadastrar professor">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Cadastrar
            </button>            
        </form>
    </div>

@endsection
