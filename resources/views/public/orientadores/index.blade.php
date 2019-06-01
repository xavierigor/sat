@extends('layouts.master')

@section('title', 'Orientadores')

@section('header')
<i class="fas fa-user fa-fw mr-2"></i> Orientadores
@endsection

@section('content')

<div class="orientadores">

    <div class="text-center mb-5">
        <form action="{{ route('public.orientadores') }}" name="buscarNome" method="get"
            enctype="multipart/form-data">
            <div class="form-inline justify-content-center">
                <div class="form-group mr-2 w-50">
                    <input value="{{ request('n') }}" class="form-control w-100" placeholder="Nome do orientador" type="text" name="n">
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

    @if($orientadores->count() > 0)

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
                @foreach($orientadores as $orientador)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('public.orientador.perfil', Hashids::encode($orientador->id)) }}">
                                {{ $orientador->name }}
                            </a>
                        </th>
                        <td>{{ $orientador->email }}</td>
                        <td>{{ $orientador->area_de_interesse }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-center">
        {{ $orientadores->links() }}
    </div>

    @else
        <p>Nenhum professor encontrado</p>
    @endif

</div>

@endsection