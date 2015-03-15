
$(function() {
	 $('.require input#name').focus( function() {
		$('div#star1').addClass('selected');
	});
	$('.require input#email').focus( function() {
			$('div#star2').addClass('selected');
	});
	$('.require textarea#message').focus( function() {
			$('div#star3').addClass('selected');
	});

	$('.require input,.require textarea').blur( function() {
		$('.require input,.require textarea').each( function(){
			$('div').removeClass('selected');
		});
	}); 
try {
	$('#hgallery').photobox('a',{ time:0 });
    // using a callback and a fancier selector
    $('#hgallery').photobox(('li > a.family',{ time:0 }), callback);
    function callback(){
       console.log('image has been loaded');
    }
}
catch(e){
	
}
	var carouselOptions = {
        auto: false,
        circular: true,
        autoWidth: true,
        responsive: true,
		scroll: 4,
        visible: 4,
        speed: 2000,
        pause: true,
        btnPrev: function() {
          return $('#prev_slider');
        },
        btnNext: function() {
          return $('#next_slider');
        },
		beforeStart: function(a) { 
		}
      };

      $('div.slideshow').jCarouselLite(carouselOptions);
	  $(document).ready(function() {
			$('div.slideshow').css('height','auto');
	   });
	   $(document).on('click.twice', '.open [data-toggle="dropdown"]', function(e){
		  var $this = $(this), href = $this.attr('href');
		  e.preventDefault();
		  window.location.href = href;
		  return false;
	 });	
});

	
	
	
	
	