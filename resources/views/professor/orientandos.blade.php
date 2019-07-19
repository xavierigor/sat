@extends('layouts.admin')

@section('title', 'Orientandos')

@section('header')
<i class="fas fa-user-graduate fa-fw"></i> Orientandos
@endsection

@section('content')
<div class="text-center mb-5">
        <form action="{{ route('coordenador.visualizar.alunos') }}" name="buscarNome" method="get"
            enctype="multipart/form-data">
            {{-- @csrf --}}
            <div class="form-inline justify-content-center">
                <div class="form-group mr-2 w-50">
                    <input value="{{ request('n') }}" class="form-control form-control-sm w-100" placeholder="Nome do aluno" type="text" name="n">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm" value="Buscar">
                        Buscar
                        <i class="fas fa-search fa-fw ml-1"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    @if($orientandos->count() > 0)
        @include('includes.modal.visualizacao-usuario.verAluno')
        @include('includes.modal.remocao-usuario.removerAluno')


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orientandos as $orientando)
                        <tr>
                            <td>{{ $orientando->name }}</td>
                            <td>{{ $orientando->email }}</td>
                            <td>{{ $orientando->telefone }}</td>
                            <td>
                                <button href="#" role="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#visualizarAluno" data-nome="{{ $orientando->name }}"
                                    data-matricula="{{ $orientando->matricula }}" data-telefone="{{ $orientando->telefone }}"
                                    data-email="{{ $orientando->email }}" data-image="{{ $orientando->image }}"
                                    data-data_nasc="{{ DateTime::createFromFormat('Y-m-d', $orientando->data_nasc)->format('d/m/Y') }}"
                                    title="Ver">
                                    <i class="fas fa-eye fa-fw"></i>
                                </button>
                                <a href="#" title="Documentos" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-file-pdf fa-fw"></i>
                                </a>
                                <button title="Excluir" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                    data-target="#removerAluno" data-nome="{{ $orientando->name }}" data-id="{{ $orientando->id }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <div class="d-flex justify-content-center">
            {{ $orientandos->links() }}
        </div> --}}

    @else
        <p>Nenhum orientando encontrado</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-visualizar.js') }}"></script>
    <script src="{{ asset('js/modal-remover.js') }}"></script>
@endsection