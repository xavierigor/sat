@extends('layouts.master')

@section('title', 'Painel de Controle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Coordenador</b> Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello <b>{{Auth::user()->name}}</b>, you are logged in as <b>Coordenador</b>!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
