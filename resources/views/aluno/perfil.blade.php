@extends('layouts.admin')

@section('title', 'Visualizar Perfil')

@section('header')
<i class="fas fa-user-graduate fa-fw mr-2"></i> Perfil <i class="fas fa-angle-right fa-fw"></i> Visualizar
@endsection

@section('content')

<div class="container">
    <div class="row p-3 text-center">
        <div class="col-xl-4 col-sm-12 col-md-12 d-flex">
        @if(Auth::user()->image)
            <div class="circle img-perfil">
            ​   <img src="{{ asset('storage/perfil/users/' . Auth::user()->image) }}" alt="imagem do perfil">
            </div>
        @else
            <div class="circle img-perfil">
        ​       <img src="{{ asset('images/user.png') }}" alt="imagem do perfil">
            </div>
        @endif
        </div>
        <div class="col-xl-8 col-sm-12 col-md-12 text-md-left row d-flex mx-auto">
            <div class="col-md-7 col-sm-12 pt-4">
                <h6>
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{ Auth::user()->name }}
                </h6><br>
                <h6>
                    <i class="fas fa-at fa-fw"></i>
                    {{ Auth::user()->email }}
                </h6><br>
                <h6>
                    <i class="fas fa-phone fa-fw"></i>
                    @if(Auth::user()->telefone) 
                        {{ Auth::user()->telefone }}
                    @else
                        (--) - ---- ----
                    @endif
                </h6>
            </div>
            <div class="col-md-5 col-sm-12 pt-4">
                <h6>
                    <i class="fas fa-calendar-alt fa-fw"></i>
                    {{ DateTime::createFromFormat('Y-m-d', Auth::user()->data_nasc)->format('d/m/Y') }}
                </h6><br>
                <h6>
                    <i class="fas fa-id-badge fa-fw"></i>
                    {{ Auth::user()->matricula }}
                </h6>
            </div>
        </div>
    </div>
    </div>
        <hr>
        <div class="row p-3">
            Descrição?!
                
        </div>
    </div>

@endsection