(function($){
  $(function(){

      //initialize js components
    $('.button-collapse').sideNav();
    $('select').material_select();
    $('header').data('size','big');

    //manage loading of tabs
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

  }); // end of document ready
})(jQuery); // end of jQuery name space


//manage scroll header response
$(window).scroll(function(){
    if ($(document).scrollTop() > 0) {
        if ($('header').data('size') == 'big') {
            $('header').data('size','small');
            $('header').stop().addClass('body-is-scrolled')
        }
    } else {
        if($('header').data('size') == 'small') {
            $('header').data('size','big');
            $('header').stop().removeClass('body-is-scrolled')
            //$('header').css('padding-top', 0)
        }
    }
});
