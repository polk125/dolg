document.addEventListener("DOMContentLoaded", function() {

 
 var hide = document.querySelector(".hide-sidebar");
 var main = document.querySelector(".wrapper");
 var sidebar = document.querySelector(".sidebar");
 hide.addEventListener("click", removeInput);
     

 function removeInput() {
    if($(".sidebar").css("width") == "250px"){
        main.style.marginLeft = "0px";
        sidebar.style.width = "0px";
    }else{
        main.style.marginLeft = "250px";
        sidebar.style.width = "250px";
    }
 }
});