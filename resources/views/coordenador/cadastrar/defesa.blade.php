@extends('layouts.admin')

@section('title', 'Cadastrar Defesa')

@section('header')
<i class="fas fa-globe-americas fa-fw mr-2"></i> Site <i class="fas fa-angle-right fa-fw"></i> Cadastrar Defesa
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <small class="d-block mb-3">Os campos com <span class="text-danger">*</span> são obrigatórios</small>

        <form class="form-prevent-mult-submits" method="POST" action="{{ route('coordenador.defesa.store') }}">
            @csrf
            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="aluno">Aluno <span class="text-danger">*</span></label>
                    <select data-selected="{{ old('aluno') }}" onchange="getSelected()" class="aluno selectpicker form-control {{ $errors->has('aluno') ? 'border-danger' : ''}}" 
                    data-live-search="true" name="aluno" id="aluno">
                        @foreach($alunos as $aluno)
                            <option data-tokens="{{ $aluno->name }}" value="{{ $aluno->id }}">
                                {{ $aluno->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('aluno', '<small class="text-danger">:message</small>') !!}
                </div>
            </div>

            <small class="text-uppercase text-muted mr-1">Avaliadores</small>
            <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right"
            title="Clique no teclado para digitar o nome do avaliador caso o mesmo não possua cadastro no sistema."></i>
            
            <div class="form-row mt-2 mb-4">
                <div class="form-group col-md-4">
                    <label for="orientador">Orientador <span class="text-danger">*</span></label>

                    <a href="#" class="toggleOrientador teclado text-decoration-none text-success">
                        <i class="fas fa-keyboard fa-fw"></i>
                    </a>

                    <a href="#" class="toggleOrientador lista d-none text-decoration-none text-success">
                        <i class="fas fa-list fa-fw"></i>
                    </a>

                    <select data-selected="{{ old('orientador-list') }}" class="selectpicker professor form-control" 
                    data-live-search="true" name="orientador-list" id="orientador">
                        @foreach($orientadores as $orientador)
                            <option data-tokens="{{ $orientador->name }}" value="{{ $orientador->id }}">
                                {{ $orientador->name }}
                            </option>
                        @endforeach
                    </select>

                    <input value="{{ old('orientador-input') }}" disabled placeholder="Digite o nome do orientador" type="text" 
                    class="hide {{ $errors->has('orientador-input') ? 'border-danger' : ''}} form-control d-none" id="orientador-input" name="orientador-input">
                    <small class="form-text helperOrientador text-muted">
                        Se o aluno selecionado possuir orientador, ele será selecionado automaticamente
                    </small>
                    {!! $errors->first('orientador-input', '<small class="err-orientador-list text-danger">:message</small>') !!}
                    {!! $errors->first('orientador-list', '<small class="err-orientador-list text-danger">:message</small>') !!}
                </div>

                <div class="form-group col-md-4">
                    <label for="avaliador-2-list">Segundo Avaliador <span class="text-danger">*</span></label>

                    <a href="#" class="toggleSegundoAvaliador teclado text-decoration-none text-success">
                        <i class="fas fa-keyboard fa-fw"></i>
                    </a>

                    <a href="#" class="toggleSegundoAvaliador lista d-none text-decoration-none text-success">
                        <i class="fas fa-list fa-fw"></i>
                    </a>

                    <select class="selectpicker form-control" data-live-search="true" name="avaliador-2-list" 
                    id="avaliador-2-list">
                        @foreach($orientadores as $orientador)
                            <option data-tokens="{{ $orientador->name }}" value="{{ $orientador->id }}">
                                {{ $orientador->name }}
                            </option>
                        @endforeach
                    </select>

                    <input disabled class="form-control d-none {{ $errors->has('avaliador-2-input') ? 'border-danger' : ''}}" 
                    name="avaliador-2-input" id="avaliador-2" type="text" placeholder="Digite o nome do segundo avaliador">
                    {!! $errors->first('avaliador-2-input', '<small class="text-danger">:message</small>') !!}
                    {!! $errors->first('avaliador-2-list', '<small class="text-danger">:message</small>') !!}
                </div>

                <div class="form-group col-md-4">
                    <label for="avaliador-3-list">Terceiro Avaliador <span class="text-danger">*</span></label>

                    <a href="#" class="toggleTerceiroAvaliador teclado text-decoration-none text-success">
                        <i class="fas fa-keyboard fa-fw"></i>
                    </a>

                    <a href="#" class="toggleTerceiroAvaliador lista d-none text-decoration-none text-success">
                        <i class="fas fa-list fa-fw"></i>
                    </a>

                    <select class="selectpicker form-control" data-live-search="true" name="avaliador-3-list" 
                    id="avaliador-3-list">
                        @foreach($orientadores as $orientador)
                            <option data-tokens="{{ $orientador->name }}" value="{{ $orientador->id }}">
                                {{ $orientador->name }}
                            </option>
                        @endforeach
                    </select>

                    <input disabled class="form-control d-none {{ $errors->has('avaliador-3-input') ? 'border-danger' : ''}}" 
                    name="avaliador-3-input" id="avaliador-3" type="text" placeholder="Digite o nome do terceiro avaliador">
                    {!! $errors->first('avaliador-3-input', '<small class="text-danger">:message</small>') !!}
                    {!! $errors->first('avaliador-3-list', '<small class="text-danger">:message</small>') !!}
                </div>
            </div>

            <small class="text-uppercase mb-3 text-muted">Apresentação</small>
            <div class="form-row mt-2">
                <div class="form-group col-md-4">
                    <label for="data">Data <span class="text-danger">*</span></label>
                    <input value="{{ old('data') }}" type="date" class="form-control form-control-sm {{ $errors->has('data') ? 'border-danger' : ''}}" id="data" name="data">
                    {!! $errors->first('data', '<small class="text-danger">:message</small>') !!}
                </div>
                <div class="form-group col-md-3">
                    <label for="hora">Horário <span class="text-danger">*</span></label>
                    <input value="{{ old('hora') }}" type="text" class="time form-control form-control-sm {{ $errors->has('hora') ? 'border-danger' : ''}}" id="hora" name="hora">
                    {!! $errors->first('hora', '<small class="text-danger">:message</small>') !!}
                </div>
                <div class="form-group col-md-3">
                    <label for="sala">Sala <span class="text-danger">*</span></label>
                    <input value="{{ old('sala') }}" type="text" class="form-control form-control-sm {{ $errors->has('sala') ? 'border-danger' : ''}}" id="sala" name="sala">
                    {!! $errors->first('sala', '<small class="text-danger">:message</small>') !!}
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary button-prevent-mult-submits">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Cadastrar
            </button>
        </form>
    </div>

@endsection


@section('scripts')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/cadastrar-defesa.js') }}"></script>
@endsection
