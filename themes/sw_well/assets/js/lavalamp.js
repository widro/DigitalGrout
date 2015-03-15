$(function () {
	
	$('.lavalamp').each( function(){
		var $this=$(this), left0 = $this.offset().left, dleft0 = $('>ul>li.active', this).offset().left - left0, dwidth0 = $('>ul>li.active', this).width();
		var $lava = $('.floatr', $this), move = function(l, w){
			$lava.stop().animate({
				left: l,
				width: w
			}, {
				duration: 400,
				easing: 'linear'
			});
		};
		var $li = $('>ul>li', this);
		//console.log( $li );
		// 1st time
		
		move(dleft0, dwidth0);
		$lava.show();
		
		$li.hover(function(e){
			//e.preventDefault();
			//e.stopPropagation();
			//console.log('enter ', this);
			var dleft = $(this).offset().left - left0;
			var dwidth = $(this).width();
			move(dleft, dwidth);
		}, function(e){
			//e.preventDefault();
			//e.stopPropagation();
			//console.log('out ', this);
			move(dleft0, dwidth0);
		});
	
	} );


});