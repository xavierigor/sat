<div class="modal fade" id="cancelarSolicitacao" tabindex="-1" role="dialog" aria-labelledby="cancelarSolicitacaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelarSolicitacaoLabel">Cancelar Solicitação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja cancelar a Solicitação de Orientação de Tcc enviada para
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <a href="{{ route('aluno.cancelar-solicitacao.tcc') }}" type="submit" class="btn btn-primary">
                    Sim
                </a>
            </div>
        </div>
    </div>
</div>