$('#visualizarProfessor').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let matricula = button.data('matricula')
  let telefone = button.data('telefone')
  let email = button.data('email')
  let data_nasc = button.data('data_nasc')
  let area_de_interesse = button.data('area_de_interesse')
  let image = button.data('image')

  let modal = $(this)
  
  modal.find('.modal-title').text(nome)
  modal.find('.nome').text(nome)
  modal.find('.matricula').text(matricula)
  
  if(telefone != ''){
    modal.find('.telefone').text(telefone)
  } else {
    modal.find('.telefone').text("Não especificado")
  }

  modal.find('.email').text(email)
  modal.find('.data_nasc').text(data_nasc)

  if(area_de_interesse != ''){
    modal.find('.area_de_interesse').text(area_de_interesse)
  } else {
    modal.find('.area_de_interesse').text("Não definido")
  } 


  let img_url = modal.find('.image').data('url')

  if(image != ''){
    modal.find('.image').attr('src', img_url + '/' + image)
  }else {
    modal.find('.image').attr('src', img_url + '/../../../images/user.png')
    // modal.find('.image').attr('src', "http://localhost/sat/public/images/user.png" )
  }

})

$('#visualizarAluno').on('show.bs.modal', function (event) {
  let button = $(event.relatedTarget)
  let nome = button.data('nome')
  let matricula = button.data('matricula')
  let telefone = button.data('telefone')
  let email = button.data('email')
  let data_nasc = button.data('data_nasc')
  let disciplina = button.data('disciplina')
  let image = button.data('image')

  let modal = $(this)
  modal.find('.modal-title').text(nome)
  modal.find('.nome').text(nome)
  modal.find('.matricula').text(matricula)
  
  if(telefone != ''){
    modal.find('.telefone').text(telefone)
  } else {
    modal.find('.telefone').text("Não especificado")
  }  
  
  modal.find('.email').text(email)
  modal.find('.data_nasc').text(data_nasc)
  modal.find('.disciplina').text(disciplina)

  let img_url = modal.find('.image').data('url')

  if(image != ''){
    modal.find('.image').attr('src', img_url + '/' + image)
    console.log(img_url)
  }else {
    modal.find('.image').attr('src', img_url + '/../../../images/user.png')
  }

})