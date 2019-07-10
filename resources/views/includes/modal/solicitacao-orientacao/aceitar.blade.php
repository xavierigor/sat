<div class="modal fade" id="aceitarSolicitacao" tabindex="-1" role="dialog" aria-labelledby="aceitarSolicitacaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aceitarSolicitacaoLabel">Aceitar Solicitação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja aceitar a Solicitação de Orientação de Tcc recebida de
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <form method="POST" action="{{ route('professor.solicitacao.aceitar') }}">
                    @csrf
                    <input hidden value="" class="tipo_solicitacao" id="tipo_solicitacao" name="tipo_solicitacao">
                    <input hidden value="" class="solicitacao_id" id="solicitacao_id" name="solicitacao_id">
                    <input hidden value="" class="aluno_id" id="aluno_id" name="aluno_id">
                    
                    <button type="submit" class="btn btn-primary">Sim</button>
                </form>
            </div>
        </div>
    </div>
</div>