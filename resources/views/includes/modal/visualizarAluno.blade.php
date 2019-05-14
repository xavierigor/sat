<div class="modal fade" id="visualizarAluno" tabindex="-1" role="dialog" aria-labelledby="visualizarAlunoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visualizarAlunoLabel">Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-3">
                    <div class="col-md-4">
                        <div>
                            <p class="font-weight-bold m-0">Nome:</p>
                            <p class="nome"></p>
                        </div>
                        <div>
                            <p class="font-weight-bold m-0">Matrícula:</p>
                            <p class="matricula"></p>
                        </div>
                        <div>
                            <p class="font-weight-bold m-0">Data de Nascimento:</p>
                            <p class="data_nasc"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <p class="font-weight-bold m-0">Email:</p>
                            <p class="email"></p>
                        </div>
                        <div>
                            <p class="font-weight-bold m-0">Telefone:</p>
                            <p class="telefone"></p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('images/user.png') }}" alt="profile-picture" class="img-fluid" style="max-height:180px">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>