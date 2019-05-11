@extends('layouts.admin')

@section('title', 'Professores Cadastrados')

@section('header')
<i class="fas fa-user fa-fw"></i> Professores Cadastrados
@endsection

@section('content')
    @if($professores->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Telefone</th>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Nenhum professor encontrado</p>
    @endif
@endsection