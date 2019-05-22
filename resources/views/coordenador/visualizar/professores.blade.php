@extends('layouts.admin')

@section('title', 'Professores Cadastrados')

@section('header')
<i class="fas fa-user fa-fw"></i> Professores Cadastrados
@endsection

@section('content')
    @if($professores->count() > 0)

        @include('includes.modal.visualizarProfessor')
        @include('includes.modal.removerProfessor')

        <div class="text-center">
            <form action="{{ route('coordenador.visualizar.professores') }}" name="buscarNome" method="get" enctype="multipart/form-data">
                <input type="text" name="name" />
                <button type="submit" class="btn btn-outline-primary" value="Buscar">Buscar</button>
            </form>
        </div>

        <div class="table-responsive text-center">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Matrícula</th>
                        {{-- <th scope="col">Telefone</th> --}}
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
                            {{-- <td>{{ $professor->telefone }}</td> --}}
                            <td>
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#visualizarProfessor"
                                data-nome="{{ $professor->name }}" data-matricula="{{ $professor->matricula }}"
                                data-telefone="{{ $professor->telefone }}" data-email="{{ $professor->email }}" data-image="{{ $professor->image }}"
                                data-data_nasc="{{ DateTime::createFromFormat('Y-m-d', $professor->data_nasc)->format('d/m/Y') }}"
                                data-area_de_interesse="{{ $professor->area_de_interesse }}" title="Ver">
                                    <i class="fas fa-eye fa-fw"></i>
                                </button>
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

    <div class="d-flex justify-content-center">
        {{ $professores->links() }}
    </div>

    @else
        <p>Nenhum professor encontrado</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-visualizar.js') }}"></script>
    <script src="{{ asset('js/modal-remover.js') }}"></script>
@endsection