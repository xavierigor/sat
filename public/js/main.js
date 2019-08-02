// Margin top do conteudo da página de acordo com tamanho da nav
// para nav fixa não ficar sobre o conteudo
// $(document).ready(function () {
//     $("#main").animate({marginTop: $('#nav').height()}, 500)
// });

$('.navbar-collapse').on('shown.bs.collapse', function(){
    $('.navbar-toggler i').removeClass("fa-angle-down").addClass("fa-angle-up");
}).on('hidden.bs.collapse', function(){
    $('.navbar-toggler i').removeClass("fa-angle-up").addClass("fa-angle-down");
});

// Previnir mutiplos requesições, ex: duplo click em solicitação = duas solicitações enviadas
(function(){
    $('.form-prevent-mult-submits').on('submit', function(){
        $('.button-prevent-mult-submits').attr('disabled', 'true');
        $('.spinner-submit').show();
    })
})();

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   

    // Toolbar tcc
    $(".tcc-toolbar-todos").on("click", function(){
        $('.filtrotcc').attr('value', 'todos');
    });
    $(".tcc-toolbar-tcc1").on("click", function(){
        $('.filtrotcc').attr('value', 'tcc 1');
    });
    $(".tcc-toolbar-tcc2").on("click", function(){
        $('.filtrotcc').attr('value', 'tcc 2');
    });
    
    // Toolbar ordem
    $(".ordenar-toolbar-asc").on("click", function(){
        $('.filtroordenar').attr('value', 'asc');
    });
    $(".ordenar-toolbar-desc").on("click", function(){
        $('.filtroordenar').attr('value', 'desc');
    });
    
    // Toolbar ordenar por
    $(".ordenarpor-toolbar-nome").on("click", function(){
        $('.filtroordenarpor').attr('value', 'name');
    });
    $(".ordenarpor-toolbar-cadastro").on("click", function(){
        $('.filtroordenarpor').attr('value', 'cadastro');
    });
});

function mostrarSenha() {
    if ($('.input-senha').attr('type') === "password") {
        $('.input-senha').prop('type', "text");
    } else {
        $('.input-senha').prop('type', "password");
    }
};

$('.button-senha').click(function(){
    if($('.button-senha i').hasClass("fa-eye-slash")){
        $('.button-senha i').removeClass("fa-eye-slash").addClass("fa-eye");
    } else{
        $('.button-senha i').removeClass("fa-eye").addClass("fa-eye-slash");
    }
});