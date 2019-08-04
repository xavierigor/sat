<div class="modal fade" id="cancelarOrientacao" tabindex="-1" role="dialog" aria-labelledby="cancelarOrientacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="cancelarOrientacaoLabel">Cancelar Orientação</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja cancelar a Orientação de Tcc de
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Não</button>
                <form class="form-prevent-mult-submits" method="POST" action="{{ route('aluno.cancelar-orientacao.tcc') }}">
                    @csrf
                    <input hidden value="" class="orientador_id" id="orientador_id" name="orientador_id">
                    
                    <button type="submit" class="btn btn-primary button-prevent-mult-submits">
                        <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                        Sim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>