$('#removerProfessor').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let id = button.data('id')

  let modal = $(this)

  modal.find('.modal-body').text('Você realmente deseja remover ' + nome + '?')
  modal.find('.id').val(id)
})

$('#removerAluno').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let id = button.data('id')

  let modal = $(this)

  modal.find('.modal-body').text('Você realmente deseja remover ' + nome + '?')
  modal.find('.id').val(id)
})