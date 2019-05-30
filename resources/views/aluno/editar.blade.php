@extends('layouts.admin')

@section('title', 'Editar Perfil')

@section('header')
<i class="fas fa-user-graduate fa-fw mr-2"></i> Perfil <i class="fas fa-angle-right fa-fw"></i> Editar Perfil
@endsection

@section('content')
<div>
    <form method="POST" action="{{ route('aluno.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name">Nome Completo</label>
                <input value="{{ Auth::user()->name }}" type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}" id="name" name="name">
                {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="form-group col-md-4">
                <label for="matricula">Matrícula</label>
                <input disabled value="{{ Auth::user()->matricula }}" type="number" class="form-control {{ $errors->has('matricula') ? 'border-danger' : ''}}" id="matricula" name="matricula">
                {!! $errors->first('matricula', '<small class="text-danger">:message</small>') !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input value="{{ Auth::user()->email }}" type="email" class="form-control {{ $errors->has('email') ? 'border-danger' : ''}}" id="email" name="email">
                {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="form-group col-md-3">
                <label for="data_nasc">Data de Nascimento</label>
                <input value="{{ Auth::user()->data_nasc }}" type="date" class="form-control {{ $errors->has('data_nasc') ? 'border-danger' : ''}}" id="data_nasc" name="data_nasc">
                {!! $errors->first('data_nasc', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="form-group col-md-3">
                <label for="telefone">Telefone</label>
                <!-- Adicionar máscara no input -->
                <input value="{{ Auth::user()->telefone }}" type="tel" class="form-control {{ $errors->has('telefone') ? 'border-danger' : ''}}" id="telefone" name="telefone" placeholder="(00) 0 0000-0000">
                {!! $errors->first('telefone', '<small class="text-danger">:message</small>') !!}
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group pr-3">
                @if(Auth::user()->image)
                    ​<img src="{{ asset('storage/perfil/users/' . Auth::user()->image) }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="60px" height="60px">
                @else
                ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="60px" height="60px">
                @endif
            </div>
            <div class="form-group">
                <label for="email">Foto</label>
                <input type="file" class="form-control-file {{ $errors->has('image') ? 'border-danger' : ''}}" name="image"  id="image">
                {!! $errors->first('image', '<small class="text-danger">:message</small>') !!}
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
    </form>
</div>
@endsection