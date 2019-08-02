@extends('layouts.admin')

@section('title', 'Alunos Cadastrados')

@section('header')
<i class="fas fa-user-graduate fa-fw mr-2"></i> Aluno <i class="fas fa-angle-right fa-fw"></i> Alunos Cadastrados
@endsection

@section('content')

    <small class="text-uppercase text-muted mr-1">Buscar Alunos</small>
    <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right"
    title="Use a caixa de pesquisa para buscar por o nome de algum aluno e os tollbuttons para filtrar e ordenar os resultador de pesquisa"></i>
         
    <div class="text-center mt-2 mb-3">
        <form action="{{ route('coordenador.visualizar.alunos') }}" name="buscarNome" method="get"
            enctype="multipart/form-data">
            {{-- @csrf --}}
            <div class="form-inline justify-content-between">
                <div class="form-group">
                    <div class="mr-4 mb-2 input-group">
                        <input value="{{ request('nome') }}" class="form-control form-control-sm" placeholder="Nome do professor" type="text" name="nome">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary-2 btn-sm" type="button" title="Buscar aluno">
                                <i class="fas fa-search fa-fw ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-sm form-inline justify-content-left">
                    
                    <div class="mr-4 mb-2 ordenarpor-toolbar btn-group" role="group" aria-label="Escolher entre ordenar lista por nome ou data de cadastro">
                        <input value="{{ request('filtroordenarpor') ? request('filtroordenarpor') : 'name' }}" class="filtroordenarpor form-control form-control-sm" type="hidden" name="filtroordenarpor">
                        <button type="submit" class="ordenarpor-toolbar-nome btn btn-sm {{ (request('filtroordenarpor') == 'name' || request('filtroordenarpor') == '') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Nome
                        </button>
                        <button type="submit" class="ordenarpor-toolbar-cadastro btn btn-sm {{ (request('filtroordenarpor') == 'cadastro') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Cadastro
                        </button>
                    </div>
                    
                    <div class="mr-4 mb-2 ordenar-toolbar btn-group" role="group" aria-label="Escolher entre ordenar lista ascedentemente ou decrecentemente">
                        <input value="{{ request('filtroordenar') ? request('filtroordenar') : 'asc' }}" class="filtroordenar form-control form-control-sm" type="hidden" name="filtroordenar">
                        <button type="submit" class="ordenar-toolbar-asc btn btn-sm {{ (request('filtroordenar') == 'asc' || request('filtroordenar') == '') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Asc
                        </button>
                        <button type="submit" class="ordenar-toolbar-desc btn btn-sm {{ (request('filtroordenar') == 'desc') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Desc
                        </button>
                    </div>
                    
                    <div class="mb-2 tcc-toolbar btn-group" role="group" aria-label="Escolher entre mostrar na lista usários de tcc 1, tcc 2 ou de todas as disciplinas">
                        <input value="{{ request('filtrotcc') ? request('filtrotcc') : 'todos' }}" class="filtrotcc form-control form-control-sm" type="hidden" name="filtrotcc">
                        <button type="submit" class="tcc-toolbar-todos btn btn-sm {{ (request('filtrotcc') == 'todos' || request('filtrotcc') == '' ) ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Todos
                        </button>
                        <button type="submit" class="tcc-toolbar-tcc1 btn btn-sm {{ (request('filtrotcc') == 'tcc 1') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Tcc 1
                        </button>
                        <button type="submit" class="tcc-toolbar-tcc2 btn btn-sm {{ (request('filtrotcc') == 'tcc 2') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Tcc 2
                        </button>
                    </div>
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
                        <th scope="col">Disciplina</th>
                        <th scope="col">Email</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->name }}</td>
                            <td>
                                @if( $aluno->tcc->tcc == "tcc 1")
                                    <span class="badge badge-secondary">
                                        {{ $aluno->tcc->tcc }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        {{ $aluno->tcc->tcc }}
                                    </span>
                                @endif 
                            </td>
                            <td>{{ $aluno->email }}</td>
                            <td>{{ $aluno->matricula }}</td>
                            <td>
                                <button href="#" role="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                    data-target="#visualizarAluno" data-nome="{{ $aluno->name }}"
                                    data-matricula="{{ $aluno->matricula }}" data-telefone="{{ $aluno->telefone }}"
                                    data-email="{{ $aluno->email }}" data-image="{{ $aluno->image }}"
                                    data-data_nasc="{{ DateTime::createFromFormat('Y-m-d', $aluno->data_nasc)->format('d/m/Y') }}"
                                    title="Ver perfil">
                                    <i class="fas fa-user fa-fw"></i>
                                </button>
                                <!-- <button role="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </button> -->
                                <button title="Remover aluno" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                    data-target="#removerAluno" data-nome="{{ $aluno->name }}" data-id="{{ $aluno->id }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2 d-flex justify-content-end">
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