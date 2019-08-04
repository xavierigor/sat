$('#mostrarDocumentos').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget)
    let documentos = button.data('documentos')
    let tc_updated_at = button.data('tc_updated_at')
    let ra_updated_at = button.data('ra_updated_at')
    let nome = button.data('nome')
    let id = button.data('id')
    let tcc = button.data('tcc')
    let status = button.data('tc_status')

    let modal = $(this)

    // let tc_url = modal.find('.tc').attr('href')
    // let ra_url = modal.find('.ra').attr('href')

    if(!documentos.termo_de_compromisso) {
        modal.find('.tc').addClass('d-none')
        modal.find('.not-found-tc').removeClass('d-none')
        // modal.find('.tc_updated_at').addClass('d-none')
    } else {
        modal.find('.tc').removeClass('d-none')
        // modal.find('.tc_updated_at').removeClass('d-none')

        modal.find('.tc_updated_at').text('Atualizado em: '+tc_updated_at)
        modal.find('.tc').attr('href', '/storage/documentos/tcc/' + documentos.termo_de_compromisso)
        // modal.find('.tc').attr('href', tc_url + '/' + documentos.termo_de_compromisso)
    }

    
    if(!documentos.rel_acompanhamento) {
        modal.find('.ra').addClass('d-none')
        modal.find('.not-found-ra').removeClass('d-none')
        // modal.find('.ra_updated_at').addClass('d-none');
    } else {
        modal.find('.ra').removeClass('d-none')
        // modal.find('ra_updated_at').removeClass('d-none')

        modal.find('.ra_updated_at').text('Atualizado em: '+ra_updated_at)
        modal.find('.ra').attr('href', '/storage/documentos/tcc/' + documentos.rel_acompanhamento)
        // modal.find('.ra').attr('href', ra_url + '/' + documentos.rel_acompanhamento)
    }

    if(tcc == 'tcc 2') {
        modal.find('.ra-show').removeClass('d-none')
    } else {
        if(!modal.find('.ra-show').hasClass('d-none')) {
            modal.find('.ra-show').addClass('d-none')
        }
    }

    modal.find('.id').val(id)
    modal.find('.nome').text(nome)
})