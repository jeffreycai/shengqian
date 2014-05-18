$(function($){
  
  // -- Sidemenu actions
  $('.sidemenu-switch').on('click', function(){
    var sidemenu = $('.sidemenu');
    if (sidemenu.hasClass('collapse')) {
      toggleSideMenu(1);
    } else {
      toggleSideMenu(0);
    }
  });
  $('.overlay').click(function(){
    toggleSideMenu(0);
  });
  
  function toggleSideMenu(flag) {
    var sidemenu = $('.sidemenu');
    var overlay = $('.overlay');
    if (flag) {
      sidemenu.removeClass('collapse').animate({
        left: '0px'
      });
      overlay.css('z-index', 5).animate({
        opacity: 0.7
      });
    } else {
      sidemenu.addClass('collapse').animate({
        left: '-300px'
      });
      overlay.animate({
        opacity: 0
      }, function(){
        overlay.css('z-index', -1);
      });
    }
  }
});