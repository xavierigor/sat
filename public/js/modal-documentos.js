$('#mostrarDocumentos').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let ra = button.data('ra')
    let tc = button.data('tc')
    let nome = button.data('nome')
    let id = button.data('id')
    let tcc = button.data('tcc')

    let modal = $(this)

    
    let tc_url = modal.find('.tc').attr('href')

    if(tcc == 'tcc 2') {
        $('.ra-show').removeClass('d-none')

        let ra_url = modal.find('.ra').attr('href')
    
        if(!ra) {
            modal.find('.not-found-ra').removeClass('d-none')
            modal.find('.ra').addClass('d-none')
        }
    
        modal.find('.ra').attr('href', ra_url + '/' + ra)
    } else {
        $('.ra-show').addClass('d-none')
    }

    if(!tc) {
        modal.find('.not-found-tc').removeClass('d-none')
        modal.find('.tc').addClass('d-none')
    }

    modal.find('.id').val(id)
    modal.find('.nome').text(nome)
    
    
    modal.find('.tc').attr('href', tc_url + '/' + tc)
})