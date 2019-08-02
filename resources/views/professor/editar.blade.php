@extends('layouts.admin')

@section('title', 'Editar Perfil')

@section('header')
<i class="fas fa-user fa-fw mr-2"></i> Perfil <i class="fas fa-angle-right fa-fw"></i> Editar
@endsection

@section('content')
<div>

    <small class="d-block mb-3">Os campos com <span class="text-danger">*</span> são obrigatórios</small>

    <form class="form-prevent-mult-submits" method="POST" action="{{ route('professor.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name">Nome Completo <span class="text-danger">*</span></label>
                <input value="{{ Auth::user()->name }}" type="text" class="form-control form-control-sm {{ $errors->has('name') ? 'border-danger' : ''}}" id="name" name="name">
                {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="form-group col-md-4">
                <label for="matricula">Matrícula</label>
                <input disabled value="{{ Auth::user()->matricula }}" type="number" class="form-control form-control-sm {{ $errors->has('matricula') ? 'border-danger' : ''}}" id="matricula" name="matricula">
                {!! $errors->first('matricula', '<small class="text-danger">:message</small>') !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input value="{{ Auth::user()->email }}" type="email" class="form-control form-control-sm {{ $errors->has('email') ? 'border-danger' : ''}}" id="email" name="email">
                {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
                <small class="form-text text-muted">
                    Seu email que será usado como login
                </small>
            </div>
            <div class="form-group col-md-3">
                <label for="data_nasc">Data de Nascimento <span class="text-danger">*</span></label>
                <input value="{{ Auth::user()->data_nasc }}" type="date" class="form-control form-control-sm {{ $errors->has('data_nasc') ? 'border-danger' : ''}}" id="data_nasc" name="data_nasc">
                {!! $errors->first('data_nasc', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="form-group col-md-3">
                <label for="telefone">Telefone</label>
                <input value="{{ Auth::user()->telefone }}" type="tel" class="phone_with_ddd form-control form-control-sm {{ $errors->has('telefone') ? 'border-danger' : ''}}" id="telefone" name="telefone" placeholder="(00) 0 0000-0000">
                {!! $errors->first('telefone', '<small class="text-danger">:message</small>') !!}
            </div>
        </div>

        <div class="mt-2 form-row">
            <div class="form-group">
                <div class="d-flex">
                    @if(Auth::user()->image)
                        <div class="circle img-perfil-pequena mr-3">
                            ​<img src="{{ asset('storage/perfil/professores/' . Auth::user()->image) }}" alt="imagem de perfil">
                        </div>
                    @else
                        <div class="circle img-perfil-pequena mr-3">
                    ​       <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="imagem de perfil">
                        </div>
                    @endif
                    <div class="my-auto">
                        <label for="email">Imagem de Perfil</label>
                        <input type="file" class="form-control-file {{ $errors->has('image') ? 'border-danger' : ''}}" name="image"  id="image">
                        {!! $errors->first('image', '<small class="text-danger">:message</small>') !!}
                        <small class="form-text text-muted">
                            Apenas arquivos: .jpeg, .png e .gif
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="mt-2 btn btn-primary btn-sm button-prevent-mult-submits" title="Salvar alterações">
            <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
            Salvar Alterações
        </button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
@endsection