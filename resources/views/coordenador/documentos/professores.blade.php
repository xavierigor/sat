@extends('layouts.admin')

@section('title', 'Documentos de Professores')

@section('header')
<i class="fas fa-user-graduate fa-fw mr-2"></i> Professores <i class="fas fa-angle-right fa-fw"></i> Documentos
@endsection

@section('content')

    <div class="text-center mb-5">
        <form action="{{ route('coordenador.documentos.professores') }}" name="buscarNome" method="get"
            enctype="multipart/form-data">
            {{-- @csrf --}}
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
        @include('includes.modal.visualizacao-usuario.verProfessor')
        <!-- @include('includes.modal.remocao-usuario.removerProfessor') -->


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Documentos</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($professores as $professor)
                        <tr>
                            <td>{{ $professor->name }}</td>
                            <td>
                                <div>
                                    Termo de responsabilidade: 
                                        @if( $professor->tr_status == "enviado")
                                            <b class="text-success">recebido</b>
                                            <a title="Ver documento" href="{{ asset('storage/documentos/professor/' . $professor->termo_de_responsabilidade) }}" target="_blank" class="tc mx-1 text-decoration-none text-secondary">
                                                <i class="fas fa-eye fa-fw"></i>
                                            </a>
                                            <a title="Download" href="{{ asset('storage/documentos/professor/' . $professor->termo_de_responsabilidade) }}" download class="tc text-secondary">
                                                <i class="fas fa-download fa-fw"></i>
                                            </a>
                                        @elseif( $professor->tr_status == "pendente")   
                                            <b class="text-info">pendente</b>
                                        @endif
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#visualizarProfessor"
                                    data-nome="{{ $professor->name }}" data-matricula="{{ $professor->matricula }}"
                                    data-telefone="{{ $professor->telefone }}" data-email="{{ $professor->email }}"
                                    data-image="{{ $professor->image }}"
                                    data-data_nasc="{{ DateTime::createFromFormat('Y-m-d', $professor->data_nasc)->format('d/m/Y') }}"
                                    data-area_de_interesse="{{ $professor->area_de_interesse }}" title="Visualizar Perfil">
                                    <i class="fas fa-eye fa-fw"></i>
                                </button>
                                <!-- <button role="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </button> -->
                                <!-- <button title="Excluir" type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                    data-target="#removerProfessor" data-nome="{{ $professor->name }}" data-id="{{ $professor->id }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </button> -->
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
        <p>Nenhum professor encontrado.</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-visualizar.js') }}"></script>
    <!-- <script src="{{ asset('js/modal-remover.js') }}"></script> -->
@endsection