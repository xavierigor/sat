$('#cancelarOrientacao').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let nome = button.data('nome')
    let id = button.data('id')

    let modal = $(this)

    modal.find('.modal-nome').text(nome)
    modal.find('.orientador_id').val(id)
})

$('#cancelarCoorientacao').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let nome = button.data('nome')
    let id = button.data('id')

    let modal = $(this)

    modal.find('.modal-nome').text(nome)
    modal.find('.prof_solicitado').val(id)
    
})
