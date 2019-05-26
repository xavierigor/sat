<div class="modal fade" id="enviarSolicitacao" tabindex="-1" role="dialog" aria-labelledby="enviarSolicitacaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enviarSolicitacaoLabel">Enviar Solicitação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja enviar uma Solicitação de Orientação de Tcc para
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <form method="POST" action="{{ route('aluno.solicitar-professor.tcc') }}">
                    @csrf
                    
                    <input hidden value="" class="prof_solicitado" id="prof_solicitado" name="prof_solicitado">
                    <button type="submit" class="btn btn-primary">Sim</button>
                </form>
            </div>
        </div>
    </div>
</div>