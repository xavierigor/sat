@extends('layouts.admin')

@section('title', 'Documentos de Alunos')

@section('header')
<i class="fas fa-user-graduate fa-fw mr-2"></i> Alunos <i class="fas fa-angle-right fa-fw"></i> Documentos
@endsection

@section('content')

    <div class="text-center mb-5">
        <form action="{{ route('coordenador.documentos.alunos') }}" name="buscarNome" method="get"
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
                        <th scope="col">Tcc</th>
                        <th scope="col">Documentos</th>
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
                            <td>
                                <div>
                                    Termo de compromisso: 
                                        @if( $aluno->tcc->tc_status == "enviado")
                                            <b class="text-success">recebido</b>
                                            <a title="Ver documento" href="{{ asset('storage/documentos/tcc/' . $aluno->tcc->termo_de_compromisso) }}" target="_blank" class="tc mx-1 text-decoration-none text-secondary">
                                                <i class="fas fa-eye fa-fw"></i>
                                            </a>
                                            <a title="Download" href="{{ asset('storage/documentos/tcc/' . $aluno->tcc->termo_de_compromisso) }}" download class="tc text-secondary">
                                                <i class="fas fa-download fa-fw"></i>
                                            </a>
                                        @elseif( $aluno->tcc->tc_status == "pendente")   
                                            <b class="text-info">pendente</b>
                                        @endif
                                </div>
                                @if( $aluno->tcc->tcc == "tcc 2")
                                    <div>
                                    Relatório de acompanhamento: 
                                        @if( $aluno->tcc->ra_status == "enviado")
                                            <b class="text-success">recebido</b>
                                            <a title="Ver documento" href="{{ asset('storage/documentos/tcc/' . $aluno->tcc->rel_acompanhamento) }}" target="_blank" class="tc mx-1 text-decoration-none text-secondary">
                                                <i class="fas fa-eye fa-fw"></i>
                                            </a>
                                            <a title="Download" href="{{ asset('storage/documentos/tcc/' . $aluno->tcc->rel_acompanhamento) }}" download class="tc text-secondary">
                                                <i class="fas fa-download fa-fw"></i>
                                            </a>
                                        @elseif( $aluno->tcc->ra_status == "pendente")   
                                            <b class="text-info">pendente</b>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td>
                                <button href="#" role="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                    data-target="#visualizarAluno" data-nome="{{ $aluno->name }}"
                                    data-matricula="{{ $aluno->matricula }}" data-telefone="{{ $aluno->telefone }}"
                                    data-email="{{ $aluno->email }}" data-image="{{ $aluno->image }}"
                                    data-data_nasc="{{ DateTime::createFromFormat('Y-m-d', $aluno->data_nasc)->format('d/m/Y') }}"
                                    title="Visualizar Perfil">
                                    <i class="fas fa-eye fa-fw"></i>
                                </button>
                                <!-- <button role="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </button> -->
                                <!-- <button title="Excluir" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                    data-target="#removerAluno" data-nome="{{ $aluno->name }}" data-id="{{ $aluno->id }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button> -->
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
    <!-- <script src="{{ asset('js/modal-remover.js') }}"></script> -->
@endsection