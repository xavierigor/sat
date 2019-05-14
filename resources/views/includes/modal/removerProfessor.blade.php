<div class="modal fade" id="removerProfessor" tabindex="-1" role="dialog" aria-labelledby="removerProfessorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removerProfessorLabel">Remover Professor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você realmente deseja remover esta pessoa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                <form method="POST" action="{{ route('coordenador.remover.professor') }}">
                    @csrf
                    @method('DELETE')
                    <input hidden value="" class="id" id="id" name="id">
                    <button type="submit" class="btn btn-primary">Sim</button>
                </form>
            </div>
        </div>
    </div>
</div>