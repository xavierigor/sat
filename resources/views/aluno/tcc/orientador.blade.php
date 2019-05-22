@extends('layouts.admin')

@section('title', 'Orientador')

@section('header')
<i class="fas fa-scroll fa-fw"></i> Orientador
@endsection

@section('content')

<div class="orientadores">


    @if($orientadores->count() > 0)
    <!-- Verificar se já existe um orientador associado ao aluno -->
    @if($tccAluno->orientador_id)

    <div class="row  text-center text-md-left">
        <div class="col-md-3 col-ms-12">
            @if($tccAluno->orientador_foto)
            ​<img src="{{ asset('storage/perfil/users/' . $tccAluno->orientador_foto) }}" class="rounded-circle"
                alt="{{Auth::user()->image}}" width="180px" height="180px">
            @else
            ​ <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px"
                height="180px">
            @endif
        </div>
        <div class="col-md-8 col-ms-12 pt-2">
            <h3>Você já tem um orientador.</h3>
            <a href="{{ route('public.orientador.perfil', Hashids::encode($tccAluno->orientador_id)) }}">
                {{ $tccAluno->orientador_nome }}
            </a>
        </div>
    </div>
    <hr>

    @else

    @if($tccAluno->prof_solicitado)
    <div class="row  text-center text-md-left">
        <div class="col-md-3 col-ms-12">
            @if($tccAluno->prof_solicitado_foto)
            ​<img src="{{ asset('storage/perfil/users/' . $tccAluno->prof_solicitado_foto) }}" class="rounded-circle"
                alt="{{Auth::user()->image}}" width="180px" height="180px">
            @else
            ​ <img src="{{ asset('images/user.png') }}" class="rounded-circle" alt="avatar" width="180px"
                height="180px">
            @endif
        </div>
        <div class="col-md-8 col-ms-12 pt-2">
            <h3>Solicitação de orientação de TCC enviada</h3>
            <a href="{{ route('public.orientador.perfil', Hashids::encode($tccAluno->prof_solicitado)) }}">
                <h4>{{ $tccAluno->prof_solicitado_nome }}</h4>
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
                    {{-- <th scope="col">Telefone</th> --}}
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
                    {{-- <td>{{ $orientador->telefone }}</td> --}}
                    <td>{{ $orientador->area_de_interesse }}</td>

                    @if(!$tccAluno->prof_solicitado)
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
@else
<p>Nenhum orientador cadastrado</p>
@endif

@endsection