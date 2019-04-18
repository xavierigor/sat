<div id="mySidenav" class="sidenav open">
    {{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> --}}
    <h3>
        {{Auth::getDefaultDriver() == 'web' ? 'Aluno' : Auth::getDefaultDriver()}}
    </h3>
    <a href="#" class="{{ Request::is('cadastrar/aluno') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        Aluno
    </a>
    <a href="#" class="{{ Request::is('tcc') ? 'active' : '' }}">
        <i class="fas fa-scroll"></i>
        TCC
    </a>
</div>