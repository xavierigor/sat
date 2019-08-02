@extends('layouts.master')

@section('title', 'Professores')

@section('header')
<i class="fas fa-user fa-fw mr-2"></i> Professores
@endsection

@section('content')

    <div class="professores">

        <small class="text-uppercase text-muted mr-1">Buscar Professores</small>
        <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right"
        title="Use a caixa de pesquisa para buscar por o nome de algum professor e os tollbuttons para filtrar e ordenar os resultador de pesquisa"></i>
        
        <div class="text-center mt-2 mb-3">
            <form action="{{ route('public.professores') }}" name="buscarNome" method="get"
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
                                    <a href="{{ route('public.professores.perfil', Hashids::encode($professor->id)) }}">
                                        {{ $professor->name }}
                                    </a>
                                </th>
                                <td>{{ $professor->email }}</td>
                                <td>{{ $professor->area_de_interesse }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="mt-2 d-flex justify-content-end">
                {{ $professores->links() }}
            </div>

        @else
            <p>Nenhum professor encontrado.</p>
        @endif

    </div>

@endsection