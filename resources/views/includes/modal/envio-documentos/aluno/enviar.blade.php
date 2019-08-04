<div class="modal fade" id="enviarDocumentos" tabindex="-1" role="dialog" aria-labelledby="enviarDocumentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="enviarDocumentosLabel">Enviar Arquivos</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja enviar os documentos para o coordenador?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Não</button>
                <a href="{{ route('aluno.enviar.documentos') }}" type="submit" class="btn btn-primary button-prevent-mult-submits">
                    <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                    Sim
                </a>
            </div>
        </div>
    </div>
</div>