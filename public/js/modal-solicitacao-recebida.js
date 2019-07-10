$('#aceitarSolicitacao').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let id = button.data('id')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)
  modal.find('.aluno_id').val(id)
})

$('#recusarSolicitacao').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)
})