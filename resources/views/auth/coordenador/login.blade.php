@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-form">
        <form method="POST" action="{{ route('coordenador.login') }}">
            @csrf

            @include('includes.forms.login')
        </form>
    </div>
@endsection
