@extends('layouts.admin')

@section('title', 'Solicitar Coorientadores de TCC')

@section('header')
<i class="fas fa-scroll fa-fw mr-2"></i> Tcc <i class="fas fa-angle-right fa-fw"></i> Coorientadores <i class="fas fa-angle-right fa-fw"></i> Solicitar
@endsection

@section('content')

    <div class="coorientadores">

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
                @include('includes.modal.solicitar-co-orientacao.confirmar')
            
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
    <script src="{{ asset('js/modal-solicitacao-co-orientador.js') }}"></script>
@endsection