@extends('layouts.admin')

@section('title', 'Alterar Senha')

@section('header')
<i class="fas fa-key fa-fw mr-2"></i> Perfil <i class="fas fa-angle-right fa-fw"></i> Alterar Senha
@endsection

@section('content')
<div>
    <form class="form-prevent-mult-submits" action="{{ route('professor.salvar.senha') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="senha_atual">Senha Atual</label>
                <input class="form-control {{ $errors->has('senha_atual') ? 'border-danger' : ''}}" type="password" id="senha_atual" name="senha_atual">
                {!! $errors->first('senha_atual', '<small class="text-danger">:message</small>') !!}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nova_senha">Nova Senha</label>
                <input class="form-control {{ $errors->has('nova_senha') ? 'border-danger' : ''}}" type="password" id="nova_senha" name="nova_senha">
                {!! $errors->first('nova_senha', '<small class="text-danger">:message</small>') !!}
                <small class="form-text text-muted">
                    Mínimo 6 caracteres
                </small>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nova_senha_confirmation">Confirmar Nova Senha</label>
                <input class="form-control {{ $errors->has('nova_senha_confirmation') ? 'border-danger' : ''}}" type="password" id="nova_senha_confirmation" name="nova_senha_confirmation">
                {!! $errors->first('nova_senha_confirmation', '<small class="text-danger">:message</small>') !!}
            
            </div>
        </div>

        <button type="submit" class="btn btn-primary button-prevent-mult-submits">
            <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
            Salvar
        </button>
    </form>
</div>
@endsection