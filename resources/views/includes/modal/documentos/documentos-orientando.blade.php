<div class="modal fade" id="mostrarDocumentos" tabindex="-1" role="dialog" aria-labelledby="mostrarDocumentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="mostrarDocumentosLabel">
                    Documentos de 
                    <span class="nome text-primary font-weight-bold"></span>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body documentos">
                <div class="my-2">
                    <div>
                        <small class="text-uppercase text-muted mr-1">Arquivo atual</small>
                        <br>
                        
                        <p class="mr-2 font-weight-bold d-inline-block my-0">
                            Termo de Compromisso:
                        </p>

                        <div class="d-inline-block">
                            <a title="Ver Documento" href="{{ asset('storage/documentos/tcc') }}" target="_blank" class="tc mx-1 text-decoration-none text-secondary">
                                <i class="fas fa-eye fa-fw"></i>
                                Ver
                            </a>
                            <a title="Baixar Documento" href="{{ asset('storage/documentos/tcc') }}" download class="tc text-decoration-none text-secondary">
                                <i class="fas fa-file-download fa-fw"></i>
                                Baixar
                            </a>
                        </div>
                        
                        <p class="not-found-tc d-none text-secondary text-sm mt-2">
                            Nenhum arquivo carregado.
                        </p>

                        <div class="d-block">
                            <small class="tc tc_updated_at"></small>
                        </div>
    
                        <div class="mt-4">
                            <small class="text-uppercase text-muted mr-1">Carregar novo arquivo</small>
                            <br>

                            <form action="{{ route('professor.upload.tc.orientando') }}" method="POST" enctype="multipart/form-data" id="upload_tc">
                                @csrf
                                <input type="file" name="tc" id="tc">
                                <input type="text" name="id" class="id" hidden>
                                <a href="#" title="Upload" class="text-decoration-none text-secondary float-right" 
                                onClick="document.getElementById('upload_tc').submit();">
                                    <i class="fas fa-file-upload fa-fw"></i>
                                    Carregar
                                </a>
                            </form>
                        </div>
                    </div>

                    
                    <div class="ra-show d-none">
                        <hr>
                        <small class="text-uppercase text-muted mr-1">Arquivo atual</small>
                        <br>

                        <p class="mr-2 font-weight-bold d-inline-block my-0">
                            Relatório de Acompanhamento:
                        </p>

                        <div class="d-inline-block">
                            <a title="Ver Documento" href="{{ asset('storage/documentos/tcc') }}" target="_blank" class="ra mx-1 text-decoration-none text-secondary">
                                <i class="fas fa-eye fa-fw"></i>
                                Ver
                            </a>
                            <a title="Baixar Documento" href="{{ asset('storage/documentos/tcc') }}" download class="ra text-secondary">
                                <i class="fas fa-file-download fa-fw"></i>
                                Baixar
                            </a>
                        </div>

                        <p class="not-found-ra d-none text-secondary text-sm mt-2">
                            Nenhum arquivo carregado.
                        </p>

                        <div class="d-block">
                            <small class="ra ra_updated_at"></small>
                        </div>

                        <div class="mt-4">
                            <small class="text-uppercase text-muted mr-1">Carregar novo arquivo</small>
                            <br>

                            <form action="{{ route('professor.upload.ra.orientando') }}" method="POST" enctype="multipart/form-data" id="upload_ra">
                                @csrf
                                <input type="file" name="ra" id="ra">
                                <input type="text" name="id" class="id" hidden>
                                <a href="#" title="Upload" class="text-decoration-none text-secondary float-right" 
                                onClick="document.getElementById('upload_ra').submit();">
                                    <i class="fas fa-file-upload fa-fw"></i>
                                    Carregar
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>