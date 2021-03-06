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

                    <li data-toggle="collapse" data-target="#aluno" class="collapsed {{ Request::is('*/aluno/cadastrar') || Request::is('*/alunos/visualizar') || Request::is('*/alunos/documentos') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user-graduate fa-fw"></i> Alunos <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('*/aluno/cadastrar') || Request::is('*/alunos/visualizar') || Request::is('*/alunos/documentos') ? 'show' : '' }}" id="aluno">
                        <li class="{{ Request::is('*/aluno/cadastrar') ? 'active' : ''}}"><a href="{{route('coordenador.cadastrar.aluno')}}">Cadastrar Aluno</a></li>
                        <li class="{{ Request::is('*/alunos/visualizar') ? 'active' : ''}}"><a href="{{ route('coordenador.visualizar.alunos') }}">Alunos Cadastrados</a></li>
                        <li class="{{ Request::is('*/alunos/documentos') ? 'active' : ''}}"><a href="{{ route('coordenador.documentos.alunos') }}">Documentos de Alunos</a></li>

                    </ul>
        
                    <li data-toggle="collapse" data-target="#professor" class="collapsed {{ Request::is('*/professor/cadastrar') || Request::is('*/professores/visualizar') || Request::is('*/professores/documentos') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user fa-fw"></i> Professores <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('*/professor/cadastrar') || Request::is('*/professores/visualizar') || Request::is('*/professores/documentos') ? 'show' : '' }}" id="professor">
                        <li class="{{ Request::is('*/professor/cadastrar') ? 'active' : ''}}"><a href="{{route('coordenador.cadastrar.professor')}}">Cadastrar Professor</a></li>
                        <li class="{{ Request::is('*/professores/visualizar') ? 'active' : ''}}"><a href="{{ route('coordenador.visualizar.professores') }}">Professores Cadastrados</a></li>
                        <li class="{{ Request::is('*/professores/documentos') ? 'active' : ''}}"><a href="{{ route('coordenador.documentos.professores') }}">Documentos de Professores</a></li>
                    </ul>

                    <li class="collapsed {{ Request::is('*/datas') ? 'active' : '' }}">
                        <a href="{{ route('coordenador.datas') }}">
                            <i class="fas fa-calendar fa-fw"></i>
                            Datas
                        </a>
                    </li>
        
                    <li data-toggle="collapse" data-target="#site" class="collapsed {{ Request::is('*/defesa/cadastrar') || Request::is('*/noticia/cadastrar') || Request::is('*/documento-modelo/cadastrar') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-globe-americas fa-fw"></i> Site <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('*/defesa/cadastrar') || Request::is('*/noticia/cadastrar') || Request::is('*/documento-modelo/cadastrar') ? 'show' : '' }}" id="site">
                        <li class="{{ Request::is('*/defesa/cadastrar') ? 'active' : ''}}">
                            <a href="{{ route('coordenador.defesa.create') }}">Cadastrar Defesa</a>
                        </li>
                        <li class="{{ Request::is('*/noticia/cadastrar') ? 'active' : ''}}">
                            <a href="{{ route('coordenador.noticia.create') }}">Cadastrar Notícia</a>
                        </li>
                        <li class="{{ Request::is('*/documento-modelo/cadastrar') ? 'active' : ''}}">
                            <a href="{{ route('coordenador.dm.create') }}">Cadastrar Documento Modelo</a>
                        </li>
                    </ul>

                @elseif(Auth::guard('professor')->check())

                    <li class="collapsed">
                        <a href="{{ route('coordenador.dashboard') }}" class="{{ Request::is('professor') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Painel de Controle
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#perfil-prof" class="collapsed {{ Request::is('professor/editar') || Request::is('professor/perfil') || Request::is('professor/senha/alterar') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user fa-fw"></i> Perfil <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('professor/editar') || Request::is('professor/perfil') || Request::is('professor/senha/alterar')? 'show' : '' }}" id="perfil-prof">
                        <li class="{{ Request::is('professor/perfil') ? 'active' : ''}}"><a href="{{ route('professor.perfil') }}">Visualizar</a></li>
                        <li class="{{ Request::is('professor/editar') ? 'active' : ''}}"><a href="{{ route('professor.editar') }}">Editar</a></li>
                        <li class="{{ Request::is('professor/senha/alterar') ? 'active' : ''}}"><a href="{{ route('professor.alterar.senha') }}">Alterar Senha</a></li>
                    </ul>
                    
                    <li data-toggle="collapse" data-target="#tcc-prof" class="collapsed {{ Request::is('professor/tcc/orientandos') || Request::is('professor/tcc/coorientandos') || Request::is('professor/tcc/documentos') || Request::is('professor/solicitacoes') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user fa-fw"></i> TCC <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('professor/tcc/orientandos') || Request::is('professor/tcc/coorientandos') || Request::is('professor/tcc/documentos') || Request::is('professor/solicitacoes') ? 'show' : '' }}" id="tcc-prof">
                        <li class="{{ Request::is('professor/solicitacoes') ? 'active' : ''}}">
                            <a href="{{ route('professor.solicitacoes') }}">
                                Solicitações
                                @if(Auth::guard('professor')->user()->solicitacoes->count() > 0)
                                    <span class='ml-2 badge badge-light'>{{Auth::guard('professor')->user()->solicitacoes->count()}}</span>
                                @endif
                            </a>
                        </li>
                        <li class="{{ Request::is('professor/tcc/orientandos') ? 'active' : ''}}"><a href="{{ route('professor.orientandos.tcc') }}">Orientandos</a></li>
                        <li class="{{ Request::is('professor/tcc/coorientandos') ? 'active' : ''}}"><a href="{{ route('professor.coorientandos.tcc') }}">Coorientandos</a></li>
                        <li class="{{ Request::is('professor/tcc/documentos') ? 'active' : ''}}"><a href="{{ route('professor.documentos.tcc') }}">Documentos</a></li>
                    </ul>

                @elseif(Auth::guard(null))

                    <li class="collapsed">
                        <a href="{{ route('aluno.dashboard') }}" class="{{ Request::is('aluno') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt fa-fw"></i>
                            Painel de Controle
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#perfil-aluno" class="collapsed {{ Request::is('aluno/editar') || Request::is('aluno/perfil') || Request::is('aluno/senha/alterar') ? 'active' : '' }}">
                        <a href="#" class="dropdown-option">
                            <i class="fas fa-user-graduate fa-fw"></i> Perfil <i class="fas fa-chevron-down fa-fw"></i>
                        </a>
                    </li>
                    <ul class="sub-menu collapse {{ Request::is('aluno/editar') || Request::is('aluno/perfil') || Request::is('aluno/senha/alterar') ? 'show' : '' }}" id="perfil-aluno">
                        <li class="{{ Request::is('aluno/perfil') ? 'active' : ''}}"><a href="{{ route('aluno.perfil') }}">Visualizar</a></li>
                        <li class="{{ Request::is('aluno/editar') ? 'active' : ''}}"><a href="{{ route('aluno.editar') }}">Editar</a></li>
                        <li class="{{ Request::is('aluno/senha/alterar') ? 'active' : ''}}"><a href="{{ route('aluno.alterar.senha') }}">Alterar Senha</a></li>
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
                        <li class="{{ Request::is('aluno/tcc/coorientadores') ? 'active' : ''}}"><a href="{{ route('aluno.coorientadores.tcc') }}">Coorientadores</a></li>
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

