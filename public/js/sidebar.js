// function openNav() {
//     document.getElementById("mySidenav").style.width = "250px";
//     document.getElementById("main").style.marginLeft = "250px";
//     document.getElementById("nav").style.marginLeft = "250px";
// }
  
// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0";
//     document.getElementById("main").style.marginLeft = "0";
//     document.getElementById("nav").style.marginLeft = "0";
// }

function toggleSidebar() {
    if($("#mySidenav").hasClass('open')) {

        document.getElementById("mySidenav").style.width = "0";
        // document.getElementById("main").style.marginLeft = "auto";
        // document.getElementById("main").style.marginRight = "auto";
        // document.getElementById("nav").style.marginLeft = "0";
        $("#mySidenav").toggleClass('open');
    } else {
        document.getElementById("mySidenav").style.width = "200px";
        // document.getElementById("main").style.marginLeft = "200px";
        // document.getElementById("nav").style.marginLeft = "200px";
        $("#mySidenav").toggleClass('open');
    }
}

$(document).ready(function() {
    if($('#mySidenav').hasClass('open')) {
        // console.log('open')
        document.getElementById("mySidenav").style.width = "200px";
    }
})