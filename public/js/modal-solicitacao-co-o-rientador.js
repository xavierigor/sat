$('#enviarSolicitacao').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let nome = button.data('nome')
    let id = button.data('id')
    let tipo_solicitacao = button.data('tiposolicitacao')

    let modal = $(this)

    modal.find('.modal-nome').text(nome)
    modal.find('.prof_solicitado').val(id)
    
    if(tipo_solicitacao == "orientacao"){
      modal.find('.modal-tipo-solicitacao').text("Orientação")
    } else if (tipo_solicitacao == "coorientacao"){
      modal.find('.modal-tipo-solicitacao').text('Coorientação')
    }

    modal.find('.tipo_solicitacao').val(tipo_solicitacao) 
})

$('#cancelarSolicitacao').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let nome = button.data('nome')
    let id = button.data('id')
    let tipo_solicitacao = button.data('tiposolicitacao')

    let modal = $(this)

    modal.find('.modal-nome').text(nome)
    modal.find('.prof_solicitado').val(id)

    if(tipo_solicitacao == "orientacao"){
      modal.find('.modal-tipo-solicitacao').text("Orientação")
    } else if (tipo_solicitacao == "coorientacao"){
      modal.find('.modal-tipo-solicitacao').text('Coorientação')
    }
    
    modal.find('.tipo_solicitacao').val(tipo_solicitacao) 
})