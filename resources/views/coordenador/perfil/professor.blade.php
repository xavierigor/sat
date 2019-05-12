@extends('layouts.admin')

@section('title', 'Painel de Controle')

@section('header')
<i class="fas fa-user-plus fa-fw"></i> Perfil Professor
@endsection

@section('content')


    <!-- <tbody>
        <tr>
            <th scope="row">{{ $professor->id }}</th>
            <td>{{ $professor->name }}</td>
            <td>{{ $professor->email }}</td>
            <td>{{ $professor->matricula }}</td>
            <td>{{ $professor->telefone }}</td>
        </tr>
    </tbody> -->

    <div class="container">

        <div class="row p-3">
            <div class="col-xl-4">
                ​<img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="Cinque Terre" width="200" height="200">
            </div>
            <div class="col-xl-8 pt-4">
                <h5>
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{ $professor->name }}
                </h5><br>
                <h5>
                    <i class="fas fa-at fa-fw"></i>
                    {{ $professor->email }}
                </h5><br>   
                <h5>
                    <i class="fas fa-phone fa-fw"></i>
                    {{ $professor->telefone }}
                </h5>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <div class="">
                <h5>Area de interesse:</h5>
                <p>{{ $professor->area_de_interesse }}</p>
            </div>
        </div>
    </div>
    


@endsection