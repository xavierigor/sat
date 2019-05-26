@extends('layouts.admin')

@section('title', 'Orientador')

@section('header')
<i class="fas fa-scroll fa-fw"></i> Orientador
@endsection

@section('content')

    <div class="orientadores">

        <!-- Se já existe um orientador associado ao aluno -->
        @isset($orientador)

            <div class="row  text-center text-md-left">
                <div class="col-md-3 col-ms-12">
                    @if($orientador->orientador_foto)
                        ​<img src="{{ asset('storage/perfil/professores/' . $orientador->orientador_foto) }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="180px" height="180px">
                    @else
                    ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px" height="180px">
                    @endif
                </div>
                <div class="col-md-8 col-ms-12 pt-2">
                    <h3>Você já tem um orientador.</h3>
                    <a href="{{ route('public.orientador.perfil', Hashids::encode($orientador->orientador_id)) }}">
                        {{ $orientador->orientador_nome }}
                    </a>
                </div>
            </div>
            <hr>
        @endisset

        <!-- Se existe um professor solicitado pelo aluno -->
        @isset($profSolicitado)
            <div class="row  text-center text-md-left">
                <div class="col-md-3 col-ms-12">
                    @if($profSolicitado->prof_solicitado_foto)
                        ​<img src="{{ asset('storage/perfil/professores/' . $profSolicitado->prof_solicitado_foto) }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="180px" height="180px">
                    @else
                    ​    <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px" height="180px">
                    @endif
                </div>
                <div class="col-md-8 col-ms-12 pt-2">
                    <h3>Solicitação de orientação de TCC enviada</h3>
                    <a href="{{ route('public.orientador.perfil', Hashids::encode($profSolicitado->prof_solicitado)) }}">
                        <h4>{{ $profSolicitado->prof_solicitado_nome }}</h4>
                    </a>
                    <br>
                    <a class="btn btn-danger" href="{{ route('aluno.cancelar-solicitacao.tcc') }}">
                        Cancelar Solicitação
                    </a>
                </div>
            </div>
            <br>
        @endisset

        <!-- Se o aluno ainda tem que solicitar um professor para orientação -->
        @isset($orientadores)

            <div class="text-center mb-5">
                <form action="{{ route('aluno.orientador.tcc') }}" name="buscarNome" method="get"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-inline justify-content-center">
                        <div class="form-group mr-2 w-50">
                            <input class="form-control w-100" placeholder="Nome do professor" type="text" name="name">
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

            @if($orientadores->count() > 0)

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
                            @foreach($orientadores as $orientador)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('public.orientador.perfil', Hashids::encode($orientador->id)) }}">
                                            {{ $orientador->name }}
                                        </a>
                                    </th>
                                    <td>{{ $orientador->email }}</td>
                                    <td>{{ $orientador->area_de_interesse }}</td>

                                    <td>
                                        <form action="{{ route('aluno.solicitar-professor.tcc') }}" method="post">
                                            @csrf
                                            <input value="{{ $orientador->id }}" id="prof_solicitado" name="prof_solicitado" type="hidden">
                                            <button class="btn btn-primary">
                                                Solicitar
                                                <i class="fas fa-paper-plane fa-fw"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $orientadores->links() }}
                </div>

            @else
                <p>Nenhum orientador encontrado</p>
            @endif

        @endisset    
    </div>

@endsection