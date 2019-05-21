@extends('layouts.master')

@section('title', 'Orientadores')

@section('header')
<i class="fas fa-user fa-fw"></i> Orientadores
@endsection

@section('content')
    <div class="orientadores">
        @if($orientadores->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            {{-- <th scope="col">Telefone</th> --}}
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
                                {{-- <td>{{ $orientador->telefone }}</td> --}}
                                <td>{{ $orientador->area_de_interesse }}</td>
                                @if(Auth::check())
                                    <td>
                                        <button class="btn btn-primary">Solicitar</button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Nenhum orientador cadastrado</p>
        @endif
    </div>
@endsection