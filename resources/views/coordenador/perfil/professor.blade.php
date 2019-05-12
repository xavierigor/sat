@extends('layouts.admin')

@section('title', $professor->name)

@section('header')
<i class="fas fa-user fa-fw"></i> {{ $professor->name }}
@endsection

@section('content')

    <div class="container">
        <div class="row p-3 text-center text-md-left">
            <div class="col-md-4 col-sm-5">
                ​<img src="{{ asset('images/user.png') }}" class="rounded-circle img-fluid" alt="avatar" width="200" height="200">
            </div>
            <div class="col-md-8 col-sm-7 pt-4">
                <h5>
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{ $professor->name }}
                </h5><br>
                <h5>
                    <i class="fas fa-at fa-fw"></i>
                    {{ $professor->email }}
                </h5><br>
                @if($professor->telefone) 
                    <h5>
                        <i class="fas fa-phone fa-fw"></i>
                        {{ $professor->telefone }}
                    </h5>
                @endif
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <div class="col-md-12">
                <h5>Área de interesse:</h5>
                <p>{{ $professor->area_de_interesse ? $professor->area_de_interesse : 'Não especificada' }}</p>
            </div>
        </div>
    </div>

@endsection