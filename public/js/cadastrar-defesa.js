$(document).ready(function() {
    $('#orientador').selectpicker('val', '')
    $('#avaliador-2-list').selectpicker('val', '')
    $('#avaliador-3-list').selectpicker('val', '')
})


// Requisição ajax quando aluno é selecionado
const getSelected = () => {
    $('#aluno option').each(function() {
        if($(this).is(':selected')) {
            let selected = $(this)[0].value
            let token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url:'cadastrar/orientador',
                type:'POST',
                dataType:'JSON',
                data: {
                    'id': selected,
                    '_method': 'POST',
                    '_token': token,
                },
                success: function(data) {
                    // if($.isEmptyObject(data.error)) {
                    if(data.error !== null) {
                        $('#orientador').selectpicker('val', data.id)
                        $('#orientador-input').val(data.nome)
                    } else {
                        // console.log('error: ' + data.error)
                        $('#orientador').selectpicker('val', '')
                        $('#orientador-input').val('')
                    }
                },
                error: function(data) {
                    console.log('ERRO: '+data)
                }
            })
        }
    })
}


$('.toggleOrientador').click(function() {
    if($('.toggleOrientador.lista').hasClass('d-none') && !$('.toggleOrientador.teclado').hasClass('d-none')) {
        showOrientadorInput()
    } else {
        showOrientadorList()
    }
})

$('.toggleSegundoAvaliador').click(function() {
    if($('.toggleSegundoAvaliador.lista').hasClass('d-none') && !$('.toggleSegundoAvaliador.teclado').hasClass('d-none')) {
        showSegundoAvaliadorInput()
    } else {
        showSegundoAvaliadorList()
    }
})

$('.toggleTerceiroAvaliador').click(function() {
    if($('.toggleTerceiroAvaliador.lista').hasClass('d-none') && !$('.toggleTerceiroAvaliador.teclado').hasClass('d-none')) {
        showTerceiroAvaliadorInput()
    } else {
        showTerceiroAvaliadorList()
    }
})


// Funções
const showOrientadorInput = () => {
    $('#orientador-input').removeClass('d-none')
    $('.toggleOrientador.teclado').addClass('d-none')
    
    $('#orientador-input').prop('disabled', false);
    $('#orientador').prop('disabled', true);

    $('#orientador').selectpicker('hide')
    $('.toggleOrientador.lista').removeClass('d-none')
}

const showOrientadorList = () => {
    $('#orientador-input').addClass('d-none')
    $('.toggleOrientador.teclado').removeClass('d-none')

    $('#orientador-input').prop('disabled', true);
    $('#orientador').prop('disabled', false);

    $('#orientador').selectpicker('show')
    $('.toggleOrientador.lista').addClass('d-none')
}

const showSegundoAvaliadorInput = () => {
    $('#avaliador-2').removeClass('d-none')
    $('.toggleSegundoAvaliador.teclado').addClass('d-none')
    
    $('#avaliador-2').prop('disabled', false);
    $('#avaliador-2-list').prop('disabled', true);

    $('#avaliador-2-list').selectpicker('hide')
    $('.toggleSegundoAvaliador.lista').removeClass('d-none')
}

const showSegundoAvaliadorList = () => {
    $('#avaliador-2').addClass('d-none')
    $('.toggleSegundoAvaliador.teclado').removeClass('d-none')

    $('#avaliador-2').prop('disabled', true);
    $('#avaliador-2-list').prop('disabled', false);

    $('#avaliador-2-list').selectpicker('show')
    $('.toggleSegundoAvaliador.lista').addClass('d-none')
}

showTerceiroAvaliadorInput = () => {
    $('#avaliador-3').removeClass('d-none')
    $('.toggleTerceiroAvaliador.teclado').addClass('d-none')

    $('#avaliador-3').prop('disabled', false);
    $('#avaliador-3-list').prop('disabled', true);
    
    $('#avaliador-3-list').selectpicker('hide')
    $('.toggleTerceiroAvaliador.lista').removeClass('d-none')
}

showTerceiroAvaliadorList = () => {
    $('#avaliador-3').addClass('d-none')
    $('.toggleTerceiroAvaliador.teclado').removeClass('d-none')

    $('#avaliador-3').prop('disabled', true);
    $('#avaliador-3-list').prop('disabled', false);

    $('#avaliador-3-list').selectpicker('show')
    $('.toggleTerceiroAvaliador.lista').addClass('d-none')
}