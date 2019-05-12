@extends('layouts.admin')

@section('title', 'Professores Cadastrados')

@section('header')
<i class="fas fa-user fa-fw"></i> Professores Cadastrados
@endsection

@section('content')
    @if($professores->count() > 0)

        @include('includes.modal.removerProfessor')

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
                    @foreach($professores as $professor)
                        <tr>
                            <th scope="row">{{ $professor->id }}</th>
                            <td>{{ $professor->name }}</td>
                            <td>{{ $professor->email }}</td>
                            <td>{{ $professor->matricula }}</td>
                            <td>{{ $professor->telefone }}</td>
                            <td>
                                <a href="{{ route('coordenador.perfil.professor', [$professor->id]) }}" role="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Visualizar Perfil">
                                    <i class="fas fa-eye fa-fw"></i>
                                </a>
                                <!-- <button role="button" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Editar Professor">
                                    <i class="fas fa-pencil-alt fa-fw"></i>
                                </button> -->
                                <button title="Excluir" type="button" class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#removerProfessor" data-nome="{{ $professor->name }}" data-id="{{ $professor->id }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Nenhum professor encontrado</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-remover.js') }}"></script>
@endsection