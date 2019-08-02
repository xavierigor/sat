@extends('layouts.admin')

@section('title', 'Documentos de Professores')

@section('header')
<i class="fas fa-user-graduate fa-fw mr-2"></i> Professores <i class="fas fa-angle-right fa-fw"></i> Documentos
@endsection

@section('content')

<small class="text-uppercase text-muted mr-1">Buscar Professores</small>
    <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right"
    title="Use a caixa de pesquisa para buscar por o nome de algum professor e os tollbuttons para filtrar e ordenar os resultador de pesquisa"></i>
    
    <div class="text-center mt-2 mb-3">
        <form action="{{ route('coordenador.visualizar.professores') }}" name="buscarNome" method="get"
            enctype="multipart/form-data">
            {{-- @csrf --}}
            <div class="form-inline justify-content-between">
                <div class="form-group">
                    <div class="mr-4 mb-2 input-group">
                        <input value="{{ request('nome') }}" class="form-control form-control-sm" placeholder="Nome do professor" type="text" name="nome">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary-2 btn-sm" type="button" title="Buscar professor">
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
                    
                    <div class="mb-2 ordenar-toolbar btn-group" role="group" aria-label="Escolher entre ordenar lista ascedentemente ou decrecentemente">
                        <input value="{{ request('filtroordenar') ? request('filtroordenar') : 'asc' }}" class="filtroordenar form-control form-control-sm" type="hidden" name="filtroordenar">
                        <button type="submit" class="ordenar-toolbar-asc btn btn-sm {{ (request('filtroordenar') == 'asc' || request('filtroordenar') == '') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Asc
                        </button>
                        <button type="submit" class="ordenar-toolbar-desc btn btn-sm {{ (request('filtroordenar') == 'desc') ? 'btn-secondary-2' : 'btn-outline-secondary-2' }}">
                            Desc
                        </button>
                    </div>
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
                                        @if( $professor->documentos->tr_status == "enviado")
                                            <b class="text-success">recebido em {{ $professor->documentos->updated_at->format('d/m/Y') }}</b>
                                            <a title="Ver documento" href="{{ asset('storage/documentos/professor/' . $professor->documentos->termo_de_responsabilidade) }}" target="_blank" class="tc mx-1 text-decoration-none text-secondary">
                                                <i class="fas fa-eye fa-fw"></i>
                                            </a>
                                            <a title="Baixar documento" href="{{ asset('storage/documentos/professor/' . $professor->documentos->termo_de_responsabilidade) }}" download class="tc text-secondary">
                                                <i class="fas fa-file-download fa-fw"></i>
                                            </a>
                                        @elseif( $professor->documentos->tr_status == "pendente" || !$professor->documentos->tr_status)   
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
                                    data-area_de_interesse="{{ $professor->area_de_interesse }}" title="Visualizar perfil">
                                    <i class="fas fa-user fa-fw"></i>
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

        <div class="mt-2 d-flex justify-content-end">
            {{ $professores->links() }}
        </div>

    @else
        <p>Nenhum professor encontrado.</p>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/modal-visualizar.js') }}"></script>
    {{-- <script src="{{ asset('js/modal-remover.js') }}"></script> --}}
@endsection