@extends('layouts.master')

@section('title', 'Orientadores')

@section('header')
<i class="fas fa-user fa-fw"></i> Orientadores
@endsection

@section('content')
<div class="orientadores">
    @if($orientadores->count() > 0)
    @if(Auth::user()->tcc->orientador_id)

    <div class="row  text-center text-md-left">
        <div class="col-md-3 col-ms-12">
            @if(Auth::user()->tcc->orientador_foto)
            ​<img src="{{ asset('storage/perfil/users/' . Auth::user()->tcc->orientador_foto) }}" class="rounded-circle"
                alt="{{Auth::user()->image}}" width="180px" height="180px">
            @else
            ​ <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px"
                height="180px">
            @endif
        </div>
        <div class="col-md-8 col-ms-12 pt-2">
            <h3>Você já tem um orientador.</h3>
            <a href="{{ route('public.orientador.perfil', Hashids::encode(Auth::user()->tcc->orientador_id)) }}">
                {{ Auth::user()->tcc->orientador_nome }}
            </a>
        </div>
    </div>
    <hr>

    @else

    @if($prof_solicitado)
    <div class="row  text-center text-md-left">
        <div class="col-md-3 col-ms-12">
            @if($prof_solicitado->image)
            ​<img src="{{ asset('storage/perfil/users/' . $prof_solicitado->image) }}" class="rounded-circle"
                alt="{{Auth::user()->image}}" width="180px" height="180px">
            @else
            ​ <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px"
                height="180px">
            @endif
        </div>
        <div class="col-md-8 col-ms-12 pt-2">
            <h3>Solicitação de orientação de TCC enviada</h3>
            <a href="{{ route('public.orientador.perfil', Hashids::encode(Auth::user()->tcc->prof_solicitado)) }}">
                <h4>{{ $prof_solicitado->name }}</h4>
            </a>
            <br>
            <a class="btn btn-danger" href="{{ route('aluno.cancelar-solicitacao.tcc') }}">
                Cancelar Solicitação
            </a>
        </div>
    </div>
    <br>
    @endif

    @if($orientadores->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Área de Interesse</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orientadores as $orientador)
                <tr>
                    <th scope="row">
                        <a href="{{ route('public.orientador.perfil', Hashids::encode($orientador->id)) }}">
                            {{ $orientador->name }}
                        </a>
                    </th>
                    <td>{{ $orientador->email }}</td>
                    <td>{{ $orientador->area_de_interesse }}</td>

                    @if(!Auth::user()->tcc->prof_solicitado)
                    @if(Auth::check())
                    <td>
                        <form action="{{ route('aluno.solicitar-professor.tcc') }}" method="post">
                            @csrf
                            <input value="{{ $orientador->id }}" id="prof_solicitado" name="prof_solicitado"
                                type="hidden">
                            <button class="btn btn-primary">
                                Solicitar
                                <i class="fas fa-paper-plane fa-fw"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>Nenhum orientador cadastrado</p>
    @endif
</div>

@endif

{{-- <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Área de Interesse</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach($orientadores as $orientador)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('public.orientador.perfil', Hashids::encode($orientador->id)) }}">
{{ $orientador->name }}
</a>
</th>
<td>{{ $orientador->email }}</td>
<td>{{ $orientador->area_de_interesse }}</td>
@if(Auth::check())
<td>
    <button class="btn btn-primary">Solicitar</button>
</td>
@endif
</tr>
@endforeach
</tbody>
</table>
</div> --}}
@else
<p>Nenhum orientador cadastrado</p>
@endif
</div>
@endsection