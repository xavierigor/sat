@extends('layouts.master')

@section('title', 'Professores')

@section('header')
<i class="fas fa-user fa-fw mr-2"></i> Professores
@endsection

@section('content')

    <div class="professores">

        <div class="text-center mb-5">
            <form action="{{ route('public.professores') }}" name="buscarNome" method="get"
                enctype="multipart/form-data">
                <div class="form-inline justify-content-center">
                    <div class="form-group mr-2 w-50">
                        <input value="{{ request('n') }}" class="form-control w-100" placeholder="Nome do professor" type="text" name="n">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" value="Buscar">
                            Buscar
                            <i class="fas fa-search fa-fw ml-1"></i>
                        </button>
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
            <div class="d-flex justify-content-center">
                {{ $professores->links() }}
            </div>

        @else
            <p>Nenhum professor encontrado.</p>
        @endif

    </div>

@endsection