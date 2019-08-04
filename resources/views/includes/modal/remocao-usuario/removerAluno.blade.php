<div class="modal fade" id="removerAluno" tabindex="-1" role="dialog" aria-labelledby="removerAlunoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="removerAlunoLabel">Remover Aluno</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja remover
                <span class="modal-nome text-primary font-weight-bold"></span>
                ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Não</button>
                <form class="form-prevent-mult-submits" method="POST" action="{{ route('coordenador.remover.aluno') }}">
                    @csrf
                    @method('DELETE')
                    <input hidden value="" class="id" id="id" name="id">
                    
                    <button type="submit" class="btn btn-primary button-prevent-mult-submits">
                        <i style="display: none;" class="spinner-submit fa fa-spinner fa-spin"></i>
                        Sim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>