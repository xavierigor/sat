@extends('layouts.master')

@section('title', $professor->name)

@section('header')
<i class="fas fa-user fa-fw mr-2"></i> <a href="{{ route('public.professores') }}" class="" >Professores</a> <i class="fas fa-angle-right fa-fw"></i> {{ $professor->name }}
@endsection

@section('content')

<div class="container">
    <div class="row p-3 text-center">
        <div class="col-xl-4 col-sm-12 col-md-6 d-flex">
        @if($professor->image)
            ​<img src="{{ asset('storage/perfil/professores/' . $professor->image) }}" class="img-perfil" alt="imagem do perfil">
        @else
        ​   <img src="{{ asset('images/user.png') }}" class="img-perfil" alt="imagem do perfil">
        @endif
        </div>
        <div class="col-xl-8 col-sm-12 col-md-6 text-md-left row d-flex m-auto">
            <div class="col-md-12 col-sm-12 pt-4">
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
                    @if($professor->telefone) 
                        {{ $professor->telefone }}
                    @else
                        (--) - ---- ----
                    @endif
                </h5>
            </div>
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