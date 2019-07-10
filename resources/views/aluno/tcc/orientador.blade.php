@extends('layouts.admin')

@section('title', 'Orientador TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Orientador
@endsection

@section('content')

    <div class="orientadores">

        <!-- Se já existe um orientador associado ao aluno -->
        @isset($orientador)

            <!-- Importar modal cancelar Orientacao -->
            @include('includes.modal.orientacao.cancelar')

            <div class="row  text-center text-md-left">
                <div class="col-md-3 col-ms-12">
                    @if($orientador->orientador_foto)
                        ​<img src="{{ asset('storage/perfil/professores/' . $orientador->orientador_foto) }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="180px" height="180px">
                    @else
                    ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px" height="180px">
                    @endif
                </div>
                <div class="col-md-8 col-ms-12 pt-2">
                    <h3>Você tem um orientador.</h3>
                    <a href="{{ route('public.orientador.perfil', Hashids::encode($orientador->orientador_id)) }}">
                        {{ $orientador->orientador_nome }}
                    </a>
                    <br>
                    <br>
                    <!-- Chamar modal cancelar orientação -->
                    <button title="Cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#cancelarOrientacao" data-nome="{{ $orientador->orientador_nome }}">
                        Cancelar Orientação
                        <i class="fas fa-times fa-fw"></i>
                    </button>
                </div>
            </div>
            <hr>
        @endisset

        <!-- Se existe um professor solicitado pelo aluno -->
        @isset($profSolicitado)
    
            <!-- Importar modal cancelar solicitacao -->
            @include('includes.modal.solicitar-orientacao.cancelar')

            <div class="row text-center text-md-left">
                <div class="col-md-3 col-ms-12">
                    @if($profSolicitado->prof_solicitado_foto)
                        ​<img src="{{ asset('storage/perfil/professores/' . $profSolicitado->prof_solicitado_foto) }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="180px" height="180px">
                    @else
                    ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px" height="180px">
                    @endif
                </div>
                <div class="col-md-9 col-ms-12 pt-4">
                    <h5>Solicitação de orientação de TCC enviada</h5>
                    <a href="{{ route('public.orientador.perfil', Hashids::encode($profSolicitado->prof_solicitado)) }}">
                        <h5>{{ $profSolicitado->prof_solicitado_nome }}</h5>
                    </a>
                    <br>
                    <!-- Chamar modal cancelar solicitacao -->
                    <button title="Cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#cancelarSolicitacao" data-nome="{{ $profSolicitado->prof_solicitado_nome }}">
                        Cancelar Solicitação
                        <i class="fas fa-times fa-fw"></i>
                    </button>
                </div>
            </div>
            <br>
        @endisset

        <!-- Se o aluno ainda tem que solicitar um professor para orientação -->
        @isset($professores)

            <div class="text-center mb-5">
                <form action="{{ route('aluno.orientador.tcc') }}" name="buscarNome" method="get"
                enctype="multipart/form-data">
                    <div class="form-inline justify-content-center">
                        <div class="form-group mr-2 w-50">
                            <input value="{{ request('n') }}" class="form-control w-100" placeholder="Nome do orientador" type="text" name="n">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" value="Buscar">
                                Buscar
                                <i class="fas fa-search fa-fw ml-1"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            @if($professores->count() > 0)

                <!-- Importar modal confirmar envio de solicitacao -->
                @include('includes.modal.solicitar-orientacao.confirmar')
            
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Área de Interesse</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach($professores as $professor)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('public.orientador.perfil', Hashids::encode($professor->id)) }}">
                                            {{ $professor->name }}
                                        </a>
                                    </th>
                                    <td>{{ $professor->email }}</td>
                                    <td>{{ $professor->area_de_interesse }}</td>

                                    <td>
                                        <!-- Chamar modal enviar solicitacao -->
                                        <button title="Solicitar" type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#enviarSolicitacao" data-nome="{{ $professor->name }}" data-id="{{ $professor->id }}">
                                            Solicitar
                                            <i class="fas fa-paper-plane fa-fw"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $professores->links() }}
                </div>

            @else
                <p>Nenhum professor encontrado</p>
            @endif

        @endisset    
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/modal-orientacao.js') }}"></script>
    <script src="{{ asset('js/modal-solicitacao-orientador.js') }}"></script>
@endsection