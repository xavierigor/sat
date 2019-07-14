<div class="modal fade" id="cancelarOrientacao" tabindex="-1" role="dialog" aria-labelledby="cancelarOrientacaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelarOrientacaoLabel">Cancelar Orientação</h5>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <form method="POST" action="{{ route('aluno.tcc.cancelar-orientacao') }}">
                    @csrf
                    <input hidden value="" class="orientador_id" id="orientador_id" name="orientador_id">
                    <button type="submit" class="btn btn-primary">Sim</button>
                </form>
            </div>
        </div>
    </div>
</div>