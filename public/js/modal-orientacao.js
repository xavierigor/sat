$('#cancelarOrientacao').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let nome = button.data('nome')
  
    let modal = $(this)
  
    modal.find('.modal-nome').text(nome)
  })