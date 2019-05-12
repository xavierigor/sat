<div id="mySidenav" class="sidenav">
    <h3>{{Auth::getDefaultDriver() == 'web' ? 'Aluno' : Auth::getDefaultDriver()}}</h3>

    <div class="nav-side-menu">
        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out show">
                
                @if(Auth::guard('coordenador')->check())

                    <li>
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

                    <li>
                        <a href="{{ route('coordenador.dashboard') }}" class="{{ Request::is('professor') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Painel de Controle
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#perfil-prof" class="collapsed {{ Request::is('*/cadastrar/aluno') || Request::is('*/visualizar/alunos') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user fa-fw"></i> Perfil <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="perfil-prof">
                        <li><a href="#">Opção 1</a></li>
                        <li><a href="#">Opção 2</a></li>
                    </ul>
        
                    <li data-toggle="collapse" data-target="#orientandos" class="collapsed {{ Request::is('*/cadastrar/professor') || Request::is('*/visualizar/professores') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user-graduate fa-fw"></i> Orientandos <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="orientandos">
                        <li><a href="#">Opção 1</a></li>
                        <li><a href="#">Opção 2</a></li>
                    </ul>
        
                    <li data-toggle="collapse" data-target="#doc-prof" class="collapsed">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-file-pdf fa-fw"></i> Documentos <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="doc-prof">
                        <li><a href="#">Opção 1</a></li>
                        <li><a href="#">Opção 2</a></li>
                    </ul>

                @elseif(Auth::guard(null))

                    <li>
                        <a href="{{ route('coordenador.dashboard') }}" class="{{ Request::is('home') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Painel de Controle
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#perfil-aluno" class="collapsed {{ Request::is('*/cadastrar/aluno') || Request::is('*/visualizar/alunos') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user-graduate fa-fw"></i> Perfil <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="perfil-aluno">
                        <li><a href="#">Opção 1</a></li>
                        <li><a href="#">Opção 2</a></li>
                    </ul>

                    <li data-toggle="collapse" data-target="#tcc-aluno" class="collapsed {{ Request::is('*/cadastrar/professor') || Request::is('*/visualizar/professores') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-file-alt fa-fw"></i> TCC <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="tcc-aluno">
                        <li><a href="#">Opção 1</a></li>
                        <li><a href="#">Opção 2</a></li>
                    </ul>

                @endif

                <li>
                    <a href="#" class="{{ Request::is('opcoes') ? 'active' : '' }}">
                        <i class="fas fa-cog fa-fw"></i>
                        Opções
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>

