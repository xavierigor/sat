@extends('layouts.admin')

@section('title', 'Alunos Cadastrados')

@section('header')
<i class="fas fa-user-graduate fa-fw"></i> Alunos Cadastrados
@endsection

@section('content')
    @if($alunos->count() > 0)

        @include('includes.modal.removerAluno')

        <div class="table-responsive text-center">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($alunos as $aluno)
                        <tr>
                            <th scope="row">{{ $aluno->id }}</th>
                            <td>{{ $aluno->name }}</td>
                            <td>{{ $aluno->email }}</td>
                            <td>{{ $aluno->matricula }}</td>
                            <td>{{ $aluno->telefone }}</td>
                            <td>
                                <a href="#" role="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Visualizar Perfil">
                                        <i class="fas fa-eye fa-fw"></i>
                                    </a>
                                <!-- <button role="button" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-pencil-alt fa-fw"></i>
                                </button> -->
                                <button title="Excluir" type="button" class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#removerAluno" data-nome="{{ $aluno->name }}" data-id="{{ $aluno->id }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Nenhum aluno encontrado</p>
    @endif
@endsection