@extends('layouts.admin')

@section('title', 'Coorientadores de TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Coorientadores
@endsection

@section('content')

    <div class="coorientadores">

        <!-- Se já existe um orientador associado ao aluno -->
        @isset($coorientacoes)

            <!-- Importar modal cancelar Orientacao -->
            @include('includes.modal.coorientacao.cancelar')

            @foreach($coorientacoes as $coorientacao)

                <div class="div-personalizada">
                    <div class="div-img-media">
                        @if($coorientacao->coorientador->image)
                            <div class="circle img-perfil-media">
                                ​<img src="{{ asset('storage/perfil/professores/' . $coorientacao->coorientador->image) }}"  alt="imagem do perfil">
                            </div>
                        @else
                            <div class="circle img-perfil-media">
                            ​    <img src="{{ asset('images/user.png') }}" alt="imagem do perfil">
                            </div>
                        @endif
                    </div>
                    <div class="text-md-left row d-flex my-auto">
                        <div class="col-md-12 col-sm-12">
                            <div class="m-auto ">
                                <p class="d-inline-block">
                                    <a class="d-inline-block" href="{{ route('public.professores.perfil', Hashids::encode($coorientacao->coorientador->id)) }}">
                                        {{ $coorientacao->coorientador->name }}   
                                    </a>
                                    é seu coorientador.
                                </p>
                            </div>
                            <div class="m-auto ">
                                <!-- Chamar modal cancelar orientação -->
                                <button title="Cancelar" type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                data-target="#cancelarCoorientacao" data-nome="{{ $coorientacao->coorientador->name }}"
                                data-id="{{ $coorientacao->coorientador->id }}" data-tiposolicitacao="coorientacao">
                                    Cancelar Coorientação
                                    <i class="fas fa-times fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="separador-coorientadores">
            @endforeach
            
        @endisset

        <!-- Se existe um professor solicitado pelo aluno -->
        @isset($solicitacoes)
    
            <!-- Importar modal cancelar solicitacao -->
            @include('includes.modal.solicitar-co-o-rientacao.cancelar')
            @foreach($solicitacoes as $solicitacao)
                <div class="div-personalizada">
                    <div class="div-img-solicitacao" >
                        @if($solicitacao->solicitado->image)
                            ​<img src="{{ asset('storage/perfil/professores/' . $solicitacao->solicitado->image) }}" class="img-perfil-solicitacao" alt="imagem do perfil">
                        @else
                        ​    <img src="{{ asset('images/user.png') }}" class="img-perfil-solicitacao" alt="imagem do perfil">
                        @endif
                    </div>
                    <div class="text-md-left ">
                        <div class="m-auto ">
                            <h6 class="d-inline-block mr-1">
                                Solicitação de coorientação de TCC enviada para 
                                <a class="d-inline-block" href="{{ route('public.professores.perfil', Hashids::encode($solicitacao->solicitado->id)) }}">
                                    <h6>{{ $solicitacao->solicitado->name }}</h6>
                                </a>.
                            </h6>
                        </div>
                        <div class="m-auto ">
                            <!-- Chamar modal cancelar solicitacao -->
                            <button title="Cancelar" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                data-target="#cancelarSolicitacao" data-nome="{{ $solicitacao->solicitado->name }}"
                                data-id="{{ $solicitacao->solicitado->id }}" data-tiposolicitacao="coorientacao">
                                Cancelar
                                <i class="fas fa-times fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr class="separador-coorientadores">
            @endforeach

        @endisset

        <!-- Se o aluno ainda tem que solicitar um professor para coorientação -->
        @isset($professores)
            <div class="text-center mb-5">
                <form action="{{ route('aluno.coorientadores.tcc') }}" name="buscarNome" method="get"
                enctype="multipart/form-data">
                    <div class="form-inline justify-content-center">
                        <div class="form-group mr-2 w-50">
                            <input value="{{ request('n') }}" class="form-control form-control-sm w-100" placeholder="Nome do professor" type="text" name="n">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-sm" value="Buscar">
                                Buscar
                                <i class="fas fa-search fa-fw ml-1"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if($professores->count() > 0)

                <!-- Importar modal confirmar envio de solicitacao -->
                @include('includes.modal.solicitar-co-o-rientacao.confirmar')

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
                                        <a href="{{ route('public.professores.perfil', Hashids::encode($professor->id)) }}">
                                            {{ $professor->name }}
                                        </a>
                                    </th>
                                    <td>{{ $professor->email }}</td>
                                    <td>{{ $professor->area_de_interesse }}</td>

                                    <td>
                                        <!-- Chamar modal enviar solicitacao -->
                                        <button title="Solicitar" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#enviarSolicitacao" data-nome="{{ $professor->name }}" 
                                            data-id="{{ $professor->id }}" data-tipoSolicitacao="coorientacao">
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
    <script src="{{ asset('js/modal-co-o-rientacao.js') }}"></script>
    <script src="{{ asset('js/modal-solicitacao-co-o-rientador.js') }}"></script>
@endsection