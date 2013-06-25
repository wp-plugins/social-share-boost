jQuery(document).ready( function($) {
	$('.nac-tab').click(function(event){
		event.preventDefault();
		$('.nav-tab-active').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');


		$('.wp-tab-panela').each(function(){

			$(this).hide();
		});

		$($(this).attr('href')).show();
	});
});
