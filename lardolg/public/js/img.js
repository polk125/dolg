 
$(function(){
    $('.minimized').click(function(event) {
      var i_path = $(this).attr('src');
      $('body').append('<div id="overlay"></div><div class="outside-img"><div id="magnify"><img src="'+i_path+'"><div id="close-popup"><i></i></div></div>');
      $('body').css({overflow:"hidden"});
      
      $('#overlay, #magnify').fadeIn('fast');
    });
    
    $('body').on('click', '#close-popup, #overlay,.outside-img', function(event) {
      event.preventDefault();
      $('body').css({overflow:"auto"});
      $('#overlay, #magnify').fadeOut('fast', function() {
        $('#close-popup, #magnify, #overlay,.outside-img').remove();
      });
    });
  });