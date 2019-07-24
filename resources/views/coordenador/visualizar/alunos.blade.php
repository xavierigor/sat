@extends('layouts.admin')

@section('title', 'Alunos Cadastrados')

@section('header')
<i class="fas fa-user-graduate fa-fw mr-2"></i> Aluno <i class="fas fa-angle-right fa-fw"></i> Alunos Cadastrados
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
                    <button type="submit" class="btn btn-outline-primary btn-sm" value="Buscar">
                        Buscar
                        <i class="fas fa-search fa-fw ml-1"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    @if($alunos->count() > 0)
        @include('includes.modal.visualizacao-usuario.verAluno')
        @include('includes.modal.remocao-usuario.removerAluno')


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->name }}</td>
                            <td>{{ $aluno->email }}</td>
                            <td>{{ $aluno->matricula }}</td>
                            <td>
                                <button href="#" role="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                    data-target="#visualizarAluno" data-nome="{{ $aluno->name }}"
                                    data-matricula="{{ $aluno->matricula }}" data-telefone="{{ $aluno->telefone }}"
                                    data-email="{{ $aluno->email }}" data-image="{{ $aluno->image }}"
                                    data-data_nasc="{{ DateTime::createFromFormat('Y-m-d', $aluno->data_nasc)->format('d/m/Y') }}"
                                    title="Ver">
                                    <i class="fas fa-eye fa-fw"></i>
                                </button>
                                <!-- <button role="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </button> -->
                                <button title="Excluir" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                    data-target="#removerAluno" data-nome="{{ $aluno->name }}" data-id="{{ $aluno->id }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $alunos->links() }}
        </div>

    @else
        <p>Nenhum aluno encontrado</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-visualizar.js') }}"></script>
    <script src="{{ asset('js/modal-remover.js') }}"></script>
@endsection