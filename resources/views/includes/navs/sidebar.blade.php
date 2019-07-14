<div id="mySidenav" class="sidenav">
    <h3>{{Auth::getDefaultDriver() == 'web' ? 'Aluno' : Auth::getDefaultDriver()}}</h3>

    <div class="nav-side-menu">
        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out show">
                
                @if(Auth::guard('coordenador')->check())

                    <li class="collapsed">
                        <a href="{{ route('coordenador.dashboard') }}" class="{{ Request::is('coordenador') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Painel de Controle
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#aluno" class="collapsed {{ Request::is('*/cadastrar/aluno') || Request::is('*/visualizar/alunos') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user-graduate fa-fw"></i> Aluno <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('*/cadastrar/aluno') || Request::is('*/visualizar/alunos') ? 'show' : '' }}"" id="aluno">
                        <li class="{{ Request::is('*/cadastrar/aluno') ? 'active' : ''}}"><a href="{{route('coordenador.cadastrar.aluno')}}">Cadastrar Aluno</a></li>
                        <li class="{{ Request::is('*/visualizar/alunos') ? 'active' : ''}}"><a href="{{ route('coordenador.visualizar.alunos') }}">Alunos Cadastrados</a></li>
                    </ul>
        
                    <li data-toggle="collapse" data-target="#professor" class="collapsed {{ Request::is('*/cadastrar/professor') || Request::is('*/visualizar/professores') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user fa-fw"></i> Professor <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('*/cadastrar/professor') || Request::is('*/visualizar/professores') ? 'show' : '' }}" id="professor">
                        <li class="{{ Request::is('*/cadastrar/professor') ? 'active' : ''}}"><a href="{{route('coordenador.cadastrar.professor')}}">Cadastrar Professor</a></li>
                        <li class="{{ Request::is('*/visualizar/professores') ? 'active' : ''}}"><a href="{{ route('coordenador.visualizar.professores') }}">Professores Cadastrados</a></li>
                    </ul>
        
                    <li data-toggle="collapse" data-target="#site" class="collapsed">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-globe-americas fa-fw"></i> Site <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="site">
                        <li><a href="#">Opção 1</a></li>
                        <li><a href="#">Opção 2</a></li>
                    </ul>

                @elseif(Auth::guard('professor')->check())

                    <li class="collapsed">
                        <a href="{{ route('coordenador.dashboard') }}" class="{{ Request::is('professor') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Painel de Controle
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#perfil-prof" class="collapsed {{ Request::is('professor/editar') || Request::is('professor/perfil') || Request::is('professor/alterar/senha') || Request::is('professor/solicitacoes') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user fa-fw"></i> Perfil <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('professor/editar') || Request::is('professor/perfil') || Request::is('professor/alterar/senha') || Request::is('professor/solicitacoes')? 'show' : '' }}" id="perfil-prof">
                        <li class="{{ Request::is('professor/perfil') ? 'active' : ''}}"><a href="{{ route('professor.perfil') }}">Visualizar</a></li>
                        <li class="{{ Request::is('professor/editar') ? 'active' : ''}}"><a href="{{ route('professor.editar') }}">Editar Perfil</a></li>
                        <li class="{{ Request::is('professor/alterar/senha') ? 'active' : ''}}"><a href="{{ route('professor.alterar.senha') }}">Alterar Senha</a></li>
                        <li class="{{ Request::is('professor/solicitacoes') ? 'active' : ''}}"><a href="{{ route('professor.solicitacoes') }}">Solicitações</a></li>
                    </ul>
        
                    <li data-toggle="collapse" class="collapsed {{ Request::is('professor/orientandos') ? 'active' : '' }}">
                        <a href="{{ route('professor.orientandos') }}" class="dropdown-option">
                            <i class="fas fa-user-graduate fa-fw"></i> Orientandos
                        </a>
                    </li>
        
                    <li data-toggle="collapse" class="collapsed {{ Request::is('professor/documentos') ? 'active' : '' }}">
                        <a href="{{ route('professor.documentos') }}" class="dropdown-option">
                            <i class="fas fa-file-pdf fa-fw"></i> Documentos 
                        </a>
                    </li>

                @elseif(Auth::guard(null))

                    <li class="collapsed">
                        <a href="{{ route('aluno.dashboard') }}" class="{{ Request::is('aluno') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Painel de Controle
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#perfil-aluno" class="collapsed {{ Request::is('aluno/editar') || Request::is('aluno/perfil') || Request::is('aluno/alterar/senha') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user-graduate fa-fw"></i> Perfil <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('aluno/editar') || Request::is('aluno/perfil') || Request::is('aluno/alterar/senha') ? 'show' : '' }}" id="perfil-aluno">
                        <li class="{{ Request::is('aluno/perfil') ? 'active' : ''}}"><a href="{{ route('aluno.perfil') }}">Visualizar</a></li>
                        <li class="{{ Request::is('aluno/editar') ? 'active' : ''}}"><a href="{{ route('aluno.editar') }}">Editar Perfil</a></li>
                        <li class="{{ Request::is('aluno/alterar/senha') ? 'active' : ''}}"><a href="{{ route('aluno.alterar.senha') }}">Alterar Senha</a></li>
                    </ul>

                    <li data-toggle="collapse" data-target="#tcc-aluno" 
                    class="collapsed {{ Request::is('aluno/tcc/visualizar') || Request::is('aluno/tcc/editar') || Request::is('aluno/tcc/orientador') || Request::is('aluno/tcc/coorientadores') || Request::is('aluno/tcc/documentos') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-scroll fa-fw"></i> TCC <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('aluno/tcc/visualizar') || Request::is('aluno/tcc/editar') || Request::is('aluno/tcc/orientador') || Request::is('aluno/tcc/coorientadores') || Request::is('aluno/tcc/documentos') ? 'show' : '' }}" 
                    class="sub-menu collapse" id="tcc-aluno">
                        <li class="{{ Request::is('aluno/tcc/visualizar') ? 'active' : ''}}"><a href="{{ route('aluno.visualizar.tcc') }}">Visualizar</a></li>
                        <li class="{{ Request::is('aluno/tcc/editar') ? 'active' : ''}}"><a href="{{ route('aluno.editar.tcc') }}">Editar</a></li>
                        <li class="{{ Request::is('aluno/tcc/orientador') ? 'active' : ''}}"><a href="{{ route('aluno.orientador.tcc') }}">Orientador</a></li>
                        <li class="{{ Request::is('aluno/tcc/coorientadores') ? 'active' : ''}}"><a href="{{ route('aluno.tcc.coorientadores') }}">Coorientadores</a></li>
                        <li class="{{ Request::is('aluno/tcc/documentos') ? 'active' : ''}}"><a href="{{ route('aluno.documentos.tcc') }}">Documentos</a></li>
                    </ul>

                @endif

                <li class="collapsed">
                    <a href="#" class="{{ Request::is('opcoes') ? 'active' : '' }}">
                        <i class="fas fa-cog fa-fw"></i>
                        Opções
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>

