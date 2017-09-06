(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space


$(document).ready(function(){
    $("#tab1").addEventListener("click", function(){
        $("#div1").load("../inc/test.php")
    })
})
