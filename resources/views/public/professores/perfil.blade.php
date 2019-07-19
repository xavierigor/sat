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
                <h6>
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{ $professor->name }}
                </h6><br>
                <h6>
                    <i class="fas fa-at fa-fw"></i>
                    {{ $professor->email }}
                </h6><br>
                <h6>
                    <i class="fas fa-phone fa-fw"></i>
                    @if($professor->telefone) 
                        {{ $professor->telefone }}
                    @else
                        (--) - ---- ----
                    @endif
                </h6>
            </div>
        </div>
    </div>
    <hr>
    <div class="row p-3">
        <div class="col-md-12">
            <h6 class="font-weight-bold">Área de interesse:</h6>
            <p>{{ $professor->area_de_interesse ? $professor->area_de_interesse : 'Não especificada' }}</p>
        </div>
    </div>
</div>

@endsection