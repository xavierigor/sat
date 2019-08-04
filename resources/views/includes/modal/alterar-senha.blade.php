<div class="modal fade" id="alterarSenha" tabindex="-1" role="dialog" aria-labelledby="alterarSenhaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="alterarSenhaLabel">Altere sua senha</h6>
            </div>
            <div class="modal-body">
                Você precisa alterar sua senha para continuar.
            </div>
            <div class="modal-footer">
                <a href="{{ Auth::guard('professor')->check() ? route('professor.alterar.senha') : route('aluno.alterar.senha') }}" class="btn btn-primary">
                    Alterar
                </a>
            </div>
        </div>
    </div>
</div>