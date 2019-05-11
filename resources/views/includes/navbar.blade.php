<nav class="navbar navbar-expand-md navbar-light bg-light" id="nav">
    {{-- @if((Auth::guard('coordenador')->check() && Request::is('/coordenador/*')) || (Auth::guard('professor')->check() && Request::is('/professor/*'))) --}}
    @if((Auth::guard('coordenador')->check() && Request::is('coordenador', 'coordenador/*')) || (Auth::guard('professor')->check() && Request::is('professor', 'professor/*')) || (Auth::check() && Request::is('home', 'home/*')))
        <span class="toggle-sidebar" onclick="toggleSidebar()">
            <i class="fas fa-bars fa-lg"></i>
        </span>
    @endif

    <div class="navbar-brand">
        <a href={{route('public.index')}}>
            <img draggable="false" src="{{ asset('images/logo.png') }}" alt="logo" class="img-fluid">
        </a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbar">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('public.agenda') }}">Agenda de TCC's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('public.documentosModelo') }}">Documentos Modelo</a>
            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->

            {{-- @guest
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalCenter">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        @if(Auth::guard('coordenador')->check())
                            <a href={{route('coordenador.dashboard')}} class="dropdown-item">Painel de Controle</a>
                        @else
                            <a href={{url('/home')}} class="dropdown-item">Painel de Controle</a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest --}}


            @if(!Auth::check() && !Auth::guard('coordenador')->check() && !Auth::guard('professor')->check())
                <li class="nav-item entrar">
                    <a href="{{ route('public.escolhaLogin') }}" class="nav-link">Entrar<i class="fas fa-sign-in-alt ml-2"></i></a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                @if(Auth::guard('coordenador')->check())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('coordenador')->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href={{route('coordenador.dashboard')}} class="dropdown-item">
                                <i class="fas fa-tachometer-alt mr-1 fa-fw"></i>
                                Painel de Controle
                            </a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-1 fa-fw"></i>
                                {{ __('Sair') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @elseif(Auth::guard('professor')->check())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('professor')->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href={{route('professor.dashboard')}} class="dropdown-item">
                                <i class="fas fa-tachometer-alt mr-1 fa-fw"></i>
                                Painel de Controle
                            </a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-1 fa-fw"></i>
                                {{ __('Sair') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href={{url('/home')}} class="dropdown-item">
                                <i class="fas fa-tachometer-alt mr-1 fa-fw"></i>
                                Painel de Controle
                            </a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-1 fa-fw"></i>
                                {{ __('Sair') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</nav>
