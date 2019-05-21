$('#visualizarProfessor').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let matricula = button.data('matricula')
  let telefone = button.data('telefone')
  let email = button.data('email')
  let data_nasc = button.data('data_nasc')
  let area_de_interesse = button.data('area_de_interesse')
  let image = button.data('data_image')

  let modal = $(this)

  modal.find('.modal-title').text(nome)
  modal.find('.nome').text(nome)
  modal.find('.matricula').text(matricula)
  modal.find('.telefone').text(telefone)
  modal.find('.email').text(email)
  modal.find('.data_nasc').text(data_nasc)
  modal.find('.area_de_interesse').text(area_de_interesse)
})

$('#visualizarAluno').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let matricula = button.data('matricula')
  let telefone = button.data('telefone')
  let email = button.data('email')
  let data_nasc = button.data('data_nasc')
  let image = button.data('data_image')

  let modal = $(this)

  modal.find('.modal-title').text(nome)
  modal.find('.nome').text(nome)
  modal.find('.matricula').text(matricula)
  modal.find('.telefone').text(telefone)
  modal.find('.email').text(email)
  modal.find('.data_nasc').text(data_nasc)
  
})