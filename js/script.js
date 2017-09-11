(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space


$(document).ready(function(){
    $('select').material_select();
    $("#tab1").click(function(){
        $("#div1").load("inc/test1.php")
    });
    $("#tab2").click(function(){
        $("#div2").load("inc/test2.php")
    });
    $("#tab3").click(function(){
        $("#div3").load("inc/test3.php")
    });
    $("#tab4").click(function(){
        $("#div4").load("inc/test4.php")
    });
});

$('#submit_seq').click(function() {

    var seq = $('#seq').val()
    $.ajax({
        type: "POST",
        url: "some.php",
        data:{
            seq: seq
        }
    });
})
