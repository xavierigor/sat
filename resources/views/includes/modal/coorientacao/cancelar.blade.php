<div class="modal fade" id="cancelarCoorientacao" tabindex="-1" role="dialog" aria-labelledby="cancelarCoorientacaoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelarCoorientacaoLabel">Cancelar Orientação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja cancelar a Coorientação de Tcc de
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <!-- <a href="{{ route('aluno.tcc.cancelar-orientacao') }}" type="submit" class="btn btn-primary">
                    Sim
                </a> -->
                <form method="POST" action="{{ route('aluno.tcc.cancelar-coorientacao') }}">
                    @csrf
                    <input hidden value="" class="prof_solicitado" id="prof_solicitado" name="prof_solicitado">
                    <button type="submit" class="btn btn-primary">Sim</button>
                </form>
            </div>
        </div>
    </div>
</div>