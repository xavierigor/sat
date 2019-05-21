@extends('layouts.admin')

@section('title', 'Visualizar Perfil')

@section('header')
<i class="fas fa-user fa-fw"></i> Visualizar Perfil
@endsection

@section('content')
<div class="container">
    <div class="row p-3 text-center text-md-left">
        <div class="col-md-4 col-sm-12">
        @if(Auth::user()->image)
            ​<img src="{{ asset('storage/perfil/professores/' . Auth::user()->image) }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="180px" height="180px">
            <!-- ​<img src="{{ asset('storage/perfil/professores/​Auth::user()->image') }}" class="rounded-circle" alt="{{Auth::user()->image}}" width="180" height="180"> -->
        @else
        ​   <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180" height="180">
        @endif
        </div>
        <div class="col-md-8 col-sm-12 row">
            <div class="col-md-6 col-sm-12 pt-4">
                <h5>
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{ Auth::user()->name }}
                </h5><br>
                <h5>
                    <i class="fas fa-at fa-fw"></i>
                    {{ Auth::user()->email }}
                </h5><br>
                <h5>
                    <i class="fas fa-phone fa-fw"></i>
                    @if(Auth::user()->telefone) 
                        {{ Auth::user()->telefone }}
                    @else
                        (--) - ---- ----
                    @endif
                </h5>
            </div>
            <div class="col-md-6 col-sm-12 pt-4">
                <h5>
                    <i class="fas fa-calendar-alt fa-fw"></i>
                    {{ DateTime::createFromFormat('Y-m-d', Auth::user()->data_nasc)->format('d/m/Y') }}
                </h5><br>
                <h5>
                    <i class="fas fa-id-badge fa-fw"></i>
                    {{ Auth::user()->matricula }}
                </h5>
            </div>
        </div>
    </div>
    <hr>
    <div class="row p-3">
        <div>
            <h5>Área de Interesse:</h5>
            <p>{{ Auth::user()->area_de_interesse ? Auth::user()->area_de_interesse : 'Não especificada' }}</p>
        </div>
            
    </div>
</div>

@endsection