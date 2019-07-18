<div class="modal fade" id="recusarSolicitacao" tabindex="-1" role="dialog" aria-labelledby="recusarSolicitacaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recusarSolicitacaoLabel">Recusar Solicitação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja recusar a solicitação de <span class="model-tipo-solicitacao"></span> de TCC recebida de
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <form class="form-prevent-mult-submits" method="POST" action="{{ route('professor.solicitacao.recusar') }}">
                    @csrf
                    <input hidden value="" class="tipo_solicitacao" id="tipo_solicitacao" name="tipo_solicitacao">
                    <input hidden value="" class="solicitacao_id" id="solicitacao_id" name="solicitacao_id">
                    <input hidden value="" class="aluno_id" id="aluno_id" name="aluno_id">
                    
                    <button type="submit" class="btn btn-primary button-prevent-mult-submits">
                        <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                        Sim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>