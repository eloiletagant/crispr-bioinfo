(function($){
  $(function(){

      //initialize js components
    $('.button-collapse').sideNav();
    $('select').material_select();
    $('header').data('size','big');
    /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('particles-js', 'js/particlesjs-config.json', function() {
      console.log('callback - particles.js config loaded');
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
