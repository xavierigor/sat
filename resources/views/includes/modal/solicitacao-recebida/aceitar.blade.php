<div class="modal fade" id="aceitarSolicitacao" tabindex="-1" role="dialog" aria-labelledby="aceitarSolicitacaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="aceitarSolicitacaoLabel">Aceitar Solicitação</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja aceitar a solicitação de <span class="model-tipo-solicitacao"></span> de Tcc recebida de
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <form class="form-prevent-mult-submits" method="POST" action="{{ route('professor.solicitacao.aceitar') }}">
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