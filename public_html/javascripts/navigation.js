$(document).ready(function(){
  $('a[href^="#"]').on('click',function (e) {
      e.preventDefault();

      var target = this.hash;
      var $target = $(target);

      $('html, body').stop().animate({
          'scrollTop': $target.offset().top
      }, 500, 'swing', function () {
          window.location.hash = target;
      });
  });
});

var amountScrolled = 300;

$(window).scroll(function() {
  if ($(window).scrollTop() > amountScrolled) {
    $('a.btt').fadeIn('slow');
  } else {
    $('a.btt').fadeOut('slow');
  }
});

$('a.btt').click(function() {
  $('html, body').animate({
    scrollTop: 0
  }, 500);
  return false;
});