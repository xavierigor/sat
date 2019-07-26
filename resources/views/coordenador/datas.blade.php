@extends('layouts.admin')

@section('title', 'Datas')

@section('header')
<i class="fas fa-calendar fa-fw mr-2"></i> Datas
@endsection

@section('content')

    <div class="datas">
        <form class="form-prevent-mult-submits" method="POST" action="{{ route('coordenador.salvar.datas') }}">
            @csrf
            
            @foreach($todas_datas as $data)
                
                @if($data->nome == 'definir orientador')
                    <div class="form-row">
                        <div class="col-xl-7 titulo-prazo my-auto">
                            <h6 class="font-weight-bold ">Prazo para definição de Orientador:</h6>
                        </div>

                        <div class="col-xl-5 form-row">                
                            <div class="form-group col-md-6">
                                <small for="definir_orientador_inicio">Início</small>
                                <input value="{{ old('definir_orientador_inicio') ? old('definir_orientador_inicio') :  $data->data_inicio }}" type="date" class="form-control form-control-sm {{ $errors->has('definir_orientador_inicio') ? 'border-danger' : ''}}" id="definir_orientador_inicio" name="definir_orientador_inicio">
                                {!! $errors->first('definir_orientador_inicio', '<small class="text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <small for="definir_orientador_termino">Término</small>
                                <input value="{{ old('definir_orientador_termino') ? old('definir_orientador_termino') : $data->data_termino }}" type="date" class="form-control form-control-sm {{ $errors->has('definir_orientador_termino') ? 'border-danger' : ''}}" id="definir_orientador_termino" name="definir_orientador_termino">
                                {!! $errors->first('definir_orientador_termino', '<small class="text-danger">:message</small>') !!}
                            </div>
                        </div>
                    </div>
                    <br><hr><br>
                @endif

                @if($data->nome == 'termo de compromisso')
                    <div class="form-row">
                        <div class="col-xl-7 titulo-prazo my-auto">
                            <h6 class="font-weight-bold ">Prazo para envio de documento Termo de Compromisso:</h6>
                        </div>

                        <div class="col-xl-5 form-row">                
                            <div class="form-group col-md-6">
                                <small for="termo_compromisso_inicio">Início</small>
                                <input value="{{ old('termo_compromisso_inicio') ? old('termo_compromisso_inicio') : $data->data_inicio }}" type="date" class="form-control form-control-sm {{ $errors->has('termo_compromisso_inicio') ? 'border-danger' : ''}}" id="termo_compromisso_inicio" name="termo_compromisso_inicio">
                                {!! $errors->first('termo_compromisso_inicio', '<small class="text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <small for="termo_compromisso_termino">Término</small>
                                <input value="{{ old('termo_compromisso_termino') ? old('termo_compromisso_termino') : $data->data_termino }}" type="date" class="form-control form-control-sm {{ $errors->has('termo_compromisso_termino') ? 'border-danger' : ''}}" id="termo_compromisso_termino" name="termo_compromisso_termino">
                                {!! $errors->first('termo_compromisso_termino', '<small class="text-danger">:message</small>') !!}
                            </div>
                        </div>
                    </div>
                    <br><hr><br>
                @endif

                @if($data->nome == 'termo de responsabilidade')
                    <div class="form-row">
                        <div class="col-xl-7 titulo-prazo my-auto">
                            <h6 class="font-weight-bold ">Prazo para envio de documento Termo de Responsabilidade:</h6>
                        </div>

                        <div class="col-xl-5 form-row">                
                            <div class="form-group col-md-6">
                                <small for="termo_responsabilidade_inicio">Início</small>
                                <input value="{{ old('termo_responsabilidade_inicio') ? old('termo_responsabilidade_inicio') : $data->data_inicio }}" type="date" class="form-control form-control-sm {{ $errors->has('termo_responsabilidade_inicio') ? 'border-danger' : ''}}" id="termo_responsabilidade_inicio" name="termo_responsabilidade_inicio">
                                {!! $errors->first('termo_responsabilidade_inicio', '<small class="text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <small for="termo_responsabilidade_termino">Término</small>
                                <input value="{{ old('termo_responsabilidade_termino') ? old('termo_responsabilidade_termino') : $data->data_termino }}" type="date" class="form-control form-control-sm {{ $errors->has('termo_responsabilidade_termino') ? 'border-danger' : ''}}" id="termo_responsabilidade_termino" name="termo_responsabilidade_termino">
                                {!! $errors->first('termo_responsabilidade_termino', '<small class="text-danger">:message</small>') !!}
                            </div>
                        </div>
                    </div>
                    <br><hr><br>
                @endif

                @if($data->nome == 'relatorio de acompanhamento')
                    <div class="form-row">
                        <div class="col-xl-7 titulo-prazo my-auto">
                            <h6 class="font-weight-bold ">Prazo para envio de documento Relatório de Acompanhamento:</h6>
                        </div>

                        <div class="col-xl-5 form-row">                
                            <div class="form-group col-md-6">
                                <small for="relatorio_acompanhamento_inicio">Início</small>
                                <input value="{{ old('relatorio_acompanhamento_inicio') ? old('relatorio_acompanhamento_inicio') : $data->data_inicio }}" type="date" class="form-control form-control-sm {{ $errors->has('relatorio_acompanhamento_inicio') ? 'border-danger' : ''}}" id="relatorio_acompanhamento_inicio" name="relatorio_acompanhamento_inicio">
                                {!! $errors->first('relatorio_acompanhamento_inicio', '<small class="text-danger">:message</small>') !!}
                            </div>
                            <div class="form-group col-md-6">
                                <small for="relatorio_acompanhamento_termino">Término</small>
                                <input value="{{ old('relatorio_acompanhamento_termino') ? old('relatorio_acompanhamento_termino') : $data->data_termino }}" type="date" class="form-control form-control-sm {{ $errors->has('relatorio_acompanhamento_termino') ? 'border-danger' : ''}}" id="relatorio_acompanhamento_termino" name="relatorio_acompanhamento_termino">
                                {!! $errors->first('relatorio_acompanhamento_termino', '<small class="text-danger">:message</small>') !!}
                            </div>
                        </div>
                    </div>
                    <br><hr><br>
                @endif
            @endforeach

            <button type="submit" class="btn btn-primary button-prevent-mult-submits">
                <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                Salvar Datas
            </button>
        </form>
        
    </div>

@endsection

@section('scripts')
@endsection