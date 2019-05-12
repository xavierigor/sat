$(document).ready(function() {
    if($(window).width() > 767 && !$('#mySidenav').hasClass('open')) {
        $('#mySidenav').addClass('open');
    } else if ($(window).width() <= 767 && $('#mySidenav').hasClass('open')) {
        $('#mySidenav').removeClass('open');
    }
})

function toggleSidebar() {
    if($("#mySidenav").hasClass('open')) {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        $("#mySidenav").toggleClass('open');
    } else {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        $("#mySidenav").toggleClass('open');
    }
}