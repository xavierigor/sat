$('#removerProfessor').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let id = button.data('id')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)
  modal.find('.id').val(id)
})

$('#removerAluno').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let id = button.data('id')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)
  modal.find('.id').val(id)
})

$('#removerDocumento').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let documento = button.data('documento')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)
  modal.find('.documento').val(documento)
})

$('#removerDocumentoModelo').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let id = button.data('id')

  let modal = $(this)

  modal.find('.modal-nome').text(nome)
  modal.find('.id').val(id)
})

$('#removerNoticia').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let id = button.data('id')

  let modal = $(this)

  modal.find('#id').val(id)
})

$('#removerDefesa').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let id = button.data('id')

  let modal = $(this)

  modal.find('#id').val(id)
})