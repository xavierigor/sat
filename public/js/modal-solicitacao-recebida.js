$('#aceitarSolicitacao').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let aluno_id = button.data('alunoid')
  let tipo_solicitacao = button.data('tiposolic')
  let solicitacao_id = button.data('idsolic')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)

  if(tipo_solicitacao == "orientacao"){
    modal.find('.model-tipo-solicitacao').text("Orientação")
  } else if(tipo_solicitacao == "coorientacao"){
    modal.find('.model-tipo-solicitacao').text("Coorientação")
  }

  modal.find('.aluno_id').val(aluno_id)
  modal.find('.tipo_solicitacao').val(tipo_solicitacao)
  modal.find('.solicitacao_id').val(solicitacao_id)
})


$('#recusarSolicitacao').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let aluno_id = button.data('alunoid')
  let tipo_solicitacao = button.data('tiposolic')
  let solicitacao_id = button.data('idsolic')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)

  if(tipo_solicitacao == "orientacao"){
    modal.find('.model-tipo-solicitacao').text("Orientação")
  } else if(tipo_solicitacao == "coorientacao"){
    modal.find('.model-tipo-solicitacao').text("Coorientação")
  }

  modal.find('.aluno_id').val(aluno_id)
  modal.find('.tipo_solicitacao').val(tipo_solicitacao)
  modal.find('.solicitacao_id').val(solicitacao_id)
})