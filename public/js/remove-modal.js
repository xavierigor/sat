$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var pessoa = button.data('pessoa') // Extract info from data-* attributes
    var nome = button.data('nome') // Extract info from data-* attributes
    var id = button.data('id') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Remover ' + pessoa)
    modal.find('.modal-body').text('Você realmente deseja remover ' + nome + '?')
    modal.find('.id').val(id)

    var action = "#{{route('coordenador.remover." + pessoa + "')}}"
    modal.find('.modal-footer form').attr('action', action)
  })