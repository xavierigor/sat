@extends('layouts.master')

@section('title', $orientador->name)

@section('header')
<i class="fas fa-user fa-fw"></i> {{ $orientador->name }}
@endsection

@section('content')

    <div class="container">
        <div class="row p-3 text-center text-md-left">
            <div class="col-md-4 col-sm-5">
            @if($orientador->image)
                ​<img src="{{ asset('storage/perfil/professores/' . $orientador->image) }}" class="rounded-circle" alt="{{$orientador->image}}" width="180px" height="180px">
            @else
            ​   <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180" height="180">
            @endif
            </div>
            <div class="col-md-8 col-sm-7 pt-4">
                <h5>
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{ $orientador->name }}
                </h5><br>
                <h5>
                    <i class="fas fa-at fa-fw"></i>
                    {{ $orientador->email }}
                </h5><br>
                <h5>
                    <i class="fas fa-phone fa-fw"></i>
                    @if($orientador->telefone) 
                        {{ $orientador->telefone }}
                    @else
                        (--) - ---- ----
                    @endif
                </h5>
            </div>
        </div>
        <hr>
        <div class="row p-3">
            <div class="col-md-12">
                <h5>Área de interesse:</h5>
                <p>{{ $orientador->area_de_interesse ? $orientador->area_de_interesse : 'Não especificada' }}</p>
            </div>
        </div>
    </div>

@endsection