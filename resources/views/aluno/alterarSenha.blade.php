@extends('layouts.admin')

@section('title', 'Alterar Senha')

@section('header')
<i class="fas fa-key fa-fw mr-2"></i> Perfil <i class="fas fa-angle-right fa-fw"></i> Alterar Senha
@endsection

@section('content')
<div>

    <div class="d-flex justify-content-between">            
        <small class="form-text text-muted mb-4">
            Os campos com <span class="text-danger">*</span> são obrigatórios
        </small>
        <!-- <a class="tc text-decoration-none text-secondary" onclick="mostrarSenha()" title="Mostrar e esconder senha">
            <i class="fas fa-eye fa-fw"></i>
        </a> -->
    </div>

    <form class="form-prevent-mult-submits" action="{{ route('aluno.salvar.senha') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="senha_atual">
                    Senha Atual <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <input class="input-senha form-control form-control-sm {{ $errors->has('senha_atual') ? 'border-danger' : ''}}" type="password" id="senha_atual" name="senha_atual">
                    <div class="input-group-append">
                        <button class="button-senha btn btn-outline-secondary-2 btn-sm" type="button" onclick="mostrarSenha()" title="Mostrar e esconder senha">
                            <i class="fas fa-eye fa-fw"></i>
                        </button>
                    </div>
                </div>
                {!! $errors->first('senha_atual', '<small class="text-danger">:message</small>') !!}
                <small class="form-text text-muted">
                    Digite a senha usada atualmente
                </small>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nova_senha">
                    Nova Senha <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <input class="input-senha form-control form-control-sm {{ $errors->has('nova_senha') ? 'border-danger' : ''}}" type="password" id="nova_senha" name="nova_senha">
                    <div class="input-group-append">
                        <button class="button-senha btn btn-outline-secondary-2 btn-sm" type="button" onclick="mostrarSenha()" title="Mostrar e esconder senha">
                            <i class="fas fa-eye fa-fw"></i>
                        </button>
                    </div>
                </div>
                {!! $errors->first('nova_senha', '<small class="text-danger">:message</small>') !!}
                <small class="form-text text-muted">
                Digite uma nova senha com no mínimo 6 caracteres
                </small>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nova_senha_confirmation">
                    Confirmar Nova Senha <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <input class="input-senha form-control form-control-sm {{ $errors->has('nova_senha_confirmation') ? 'border-danger' : ''}}" type="password" id="nova_senha_confirmation" name="nova_senha_confirmation">
                    <div class="input-group-append">
                        <button class="button-senha btn btn-outline-secondary-2 btn-sm" type="button" onclick="mostrarSenha()" title="Mostrar e esconder senha">
                            <i class="fas fa-eye fa-fw"></i>
                        </button>
                    </div>
                </div>
                {!! $errors->first('nova_senha_confirmation', '<small class="text-danger">:message</small>') !!}
                <small class="form-text text-muted">
                    Repita a nova senha para confirmar
                </small>
            </div>
        </div>

        <button type="submit" class="mt-2 btn btn-primary btn-sm button-prevent-mult-submits" title="Salvar nova senha">
            <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
            Salvar Senha
        </button>
    </form>
</div>
@endsection