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
  
  // -- card click
  $('.card h4 a').click(function(event){
    event.stopPropagation();
    return true;
  });
  $('.card').click(function(event){
    window.location.href = $('h4 a', this).attr('href');
  });
  
  // -- spam tokens
  if ($('#spam_tokens').length) {
    // disable submit button
    var form = $('#spam_tokens').parents('form').first();
    $('input[type=submit]', form).prop('disabled', true);
    $.get('/spam/validate', function(data){
      $('#spam_tokens').attr('value', data.spam_val).attr('name', data.spam_key);
    var form = $('#spam_tokens').parents('form').first();
    $('input[type=submit]', form).prop('disabled', false);
    }, "json");
  }
  
  // scroll to on homepage
  $('body.home .jumbotron .btn').click(function(event){
    event.preventDefault();
    $('html, body').animate({
        scrollTop: $(".body").offset().top - 30
    }, 500);
  });
  $('body.home h3 span a').click(function(event){
    event.preventDefault();
    var id = $(this).attr('data-goto');
    $('html, body').animate({
        scrollTop: $("#"+id).offset().top - 65
    }, 500);
  });
});