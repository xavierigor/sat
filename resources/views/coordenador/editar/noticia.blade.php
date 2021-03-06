@extends('layouts.admin')

@section('title', 'Editar Notícia')

@section('header')
<i class="fas fa-newspaper fa-fw mr-2"></i> Editar Notícia
@endsection

@section('content')
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <small class="d-block mb-3">Os campos com <span class="text-danger">*</span> são obrigatórios</small>

        <form class="form-prevent-mult-submits quill-form" method="POST" action="{{ route('coordenador.noticia.update', Hashids::encode($noticia->id)) }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="titulo">Título <span class="text-danger">*</span></label>
                    <input value="{{ $noticia->titulo }}" type="text" class="form-control form-control-sm {{ $errors->has('titulo') ? 'border-danger' : ''}}" id="titulo" name="titulo">
                    {!! $errors->first('titulo', '<small class="text-danger">:message</small>') !!}
                    <small class="form-text text-muted">
                        Título da notícia
                    </small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="corpo">Corpo da notícia <span class="text-danger">*</span></label>
                    <textarea rows="10" type="text" class="form-control form-control-sm {{ $errors->has('corpo') ? 'border-danger' : ''}}" id="corpo" name="corpo">
                        {{ $noticia->corpo }}
                    </textarea>
                    {!! $errors->first('corpo', '<small class="text-danger">:message</small>') !!}
                </div>
            </div>

            <button type="submit" class="btn btn-primary button-prevent-mult-submits">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Salvar
            </button>
        </form>
    </div>

@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'corpo' );
    </script>
@endsection
