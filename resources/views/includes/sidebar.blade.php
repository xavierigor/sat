<div id="mySidenav" class="sidenav">
    <h3>{{Auth::getDefaultDriver() == 'web' ? 'Aluno' : Auth::getDefaultDriver()}}</h3>

    <div>

        @if(Auth::guard('coordenador')->check()) {{-- Se for coordenador --}}
            <a href="#" class="{{ Request::is('cadastrar/aluno') ? 'active' : '' }}">
                <i class="fas fa-user-tie fa-fw"></i>
                Coordenador
            </a>
            <a href="{{ route('coordenador.visualizar.professores') }}" class="{{ Request::is('*/visualizar/professores') ? 'active' : '' }}">
                <i class="fas fa-user fa-fw"></i>
                Professores Cadastrados
            </a>
            <a href="{{route('coordenador.cadastrar.professor')}}" class="{{ Request::is('*/cadastrar/professor') ? 'active' : '' }}">
                <i class="fas fa-user fa-fw"></i>
                Cadastrar Professor
            </a>
            <a href="{{ route('coordenador.visualizar.alunos') }}" class="{{ Request::is('*/visualizar/alunos') ? 'active' : '' }}">
                <i class="fas fa-user-graduate fa-fw"></i>
                Alunos Cadastrados
            </a>
            <a href="{{route('coordenador.cadastrar.aluno')}}" class="{{ Request::is('*/cadastrar/aluno') ? 'active' : '' }}">
                <i class="fas fa-user-graduate fa-fw"></i>
                Cadastrar Aluno
            </a>
        @elseif(Auth::guard('professor')->check())
            <a href="#" class="{{ Request::is('tcc') ? 'active' : '' }}">
                <i class="fas fa-user fa-fw"></i>
                Professor
            </a>
            <a href="#" class="{{ Request::is('tcc') ? 'active' : '' }}">
                <i class="fas fa-user-graduate fa-fw"></i>
                Orientandos
            </a>
            <a href="#" class="{{ Request::is('tcc') ? 'active' : '' }}">
                <i class="fas fa-file-alt fa-fw"></i>
                Documentos
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