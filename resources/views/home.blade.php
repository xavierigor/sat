@extends('layouts.admin')

@section('title', 'Painel de Controle')

@section('content')

    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Hello <b>{{Auth::user()->name}}</b>, you are logged in as <b>Aluno</b>!
    </div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Aluno</b> Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello <b>{{Auth::user()->name}}</b>, you are logged in as <b>Aluno</b>!
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
