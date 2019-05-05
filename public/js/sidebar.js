$(document).ready(function() {
    if($(window).width() > 767 && !$('#mySidenav').hasClass('open')) {
        $('#mySidenav').addClass('open');
    } else {
        $('#mySidenav').removeClass('open');
    }
})

function toggleSidebar() {
    if($("#mySidenav").hasClass('open')) {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        $("#mySidenav").toggleClass('open');
    } else {
        document.getElementById("mySidenav").style.width = "220px";
        document.getElementById("main").style.marginLeft = "220px";
        $("#mySidenav").toggleClass('open');
    }
}