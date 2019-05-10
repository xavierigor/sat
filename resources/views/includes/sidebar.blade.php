<div id="mySidenav" class="sidenav">
    <h3>{{Auth::getDefaultDriver() == 'web' ? 'Aluno' : Auth::getDefaultDriver()}}</h3>

    <div>

        @if(Auth::guard('coordenador')->check()) {{-- Se for coordenador --}}
            <a href="#" class="{{ Request::is('cadastrar/aluno') ? 'active' : '' }}">
                <i class="fas fa-user-tie fa-fw"></i>
                Coordenador
            </a>
            <a href="#" class="{{ Request::is('cadastrar/aluno') ? 'active' : '' }}">
                <i class="fas fa-user fa-fw"></i>
                Professores
            </a>
            <a href="{{route('coordenador.cadastrarProfessor')}}" class="{{ Request::is('cadastrar/aluno') ? 'active' : '' }}">
                <i class="fas fa-user fa-fw"></i>
                Cadastrar Professores
            </a>
            <a href="#" class="{{ Request::is('cadastrar/aluno') ? 'active' : '' }}">
                <i class="fas fa-user-graduate fa-fw"></i>
                Alunos
            </a>
        @elseif(Auth::guard(null)) {{-- Se for aluno --}}
            <a href="#" class="{{ Request::is('tcc') ? 'active' : '' }}">
                <i class="fas fa-file-alt fa-fw"></i>
                TCC
            </a>
        @endif
        
        <a href="#" class="{{ Request::is('tcc') ? 'active' : '' }}">
            <i class="fas fa-cog fa-fw"></i>
            Opções
        </a>

    </div>
</div>