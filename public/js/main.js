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