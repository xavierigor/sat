$(document).ready(function() {
    
    // Execultar ao iniciar
    toglleIfScreen();
    
    // Execultar se tela redimensionar
    $(window).resize(function() {
        toglleIfScreen();
    });

})

function toglleIfScreen(){

    // if($(window).width() > 767 && !$('#mySidenav').hasClass('open')) {
    //     $('#mySidenav').addClass('open');
    //     toggleSidebar();
    // } else if ($(window).width() < 767 && $('#mySidenav').hasClass('open')) {
    //     $('#mySidenav').removeClass('open');
    //     toggleSidebar();
    // }

    if($(window).width() > 767 ){
        $('#mySidenav').addClass('closed');
        toggleSidebar();
    } else if ($(window).width() < 767){
        $('#mySidenav').removeClass('closed');
        toggleSidebar();
    }
}

function toggleSidebar() {
    if($("#mySidenav").hasClass('closed')) {
        document.getElementById("mySidenav").style.width = "250px";
        pushPageContent();
        $("#mySidenav").toggleClass('closed');
    } else {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        $("#mySidenav").toggleClass('closed');
    }
}

// Empurrar conteudo do main apenas se a tela for grande. Por questões de responsividade
function pushPageContent(){
    
    if($(window).width() > 767 ){
        document.getElementById("main").style.marginLeft = "250px";
    }else{
        document.getElementById("main").style.marginLeft = "0";
    }
}


// Escurecer conteudo da página, caso sidebar expandida em tela pequena
// function darkenPageContent(){
    
//     if($("#main").hasClass('overlaid')){
//         $('#main').removeClass('overlaid');
//     } else {
//         $('#main').addClass('overlaid');
//     }
// }