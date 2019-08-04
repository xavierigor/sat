<div class="modal fade" id="visualizarAluno" tabindex="-1" role="dialog" aria-labelledby="visualizarAlunoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="visualizarAlunoLabel">Aluno</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-5">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-xl-4 col-sm-12 col-md-12">
                            <div class="circle img-perfil">
                        ​       <img src="" data-url="{{ asset('storage/perfil/users') }}" class="image" alt="avatar">
                            </div>
                        </div>
                        <div class="col-xl-8 col-sm-12 col-md-12 text-md-left row">
                            <div class="col-md-7 col-sm-12 pt-4">
                                <h6>
                                    <i class="fas fa-user-circle fa-fw"></i>
                                    <span class="nome"></span>
                                </h6><br>
                                <h6>
                                    <i class="fas fa-at fa-fw"></i>
                                    <span class="email"></span>
                                </h6><br>
                                <h6>
                                    <i class="fas fa-phone fa-fw"></i>
                                    <span class="telefone"></span>
                                </h6>
                            </div>
                            <div class="col-md-5 col-sm-12 pt-4">
                                <h6 >
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                    <span class="data_nasc"></span>
                                </h6><br>
                                <h6>
                                    <i class="fas fa-id-badge fa-fw"></i>
                                    <span class="matricula"></span>
                                </h6><br>
                                <h6>
                                    <i class="fas fa-graduation-cap fa-fw"></i>
                                    <span class="disciplina"></span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div> -->
        </div>
    </div>
</div>