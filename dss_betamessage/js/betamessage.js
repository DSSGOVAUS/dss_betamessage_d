jQuery(function($) {
	$(document).ready(function() {
		var wrapper_element = $('.betamessage').data('attach-to');

		$(wrapper_element).css('position', 'relative');
		$(wrapper_element).append('<a href="#" class="betamessage-tag betamessage-open" aria-label="Display beta message">Beta</a>');

		if((typeof(Storage)!=='undefined') && (localStorage.getItem('betamessage') != 'closed')) {
			// Show the message
			if($('body').hasClass('path-frontpage')) {
			  $('.betamessage').slideDown(500);
				$('body').addClass('is-beta-shown');
			}
			else {
				$('.betamessage').css('display','block');
				$('body').addClass('is-beta-shown');
			}
		}
		// Clicks the Beta link
		$('.betamessage-open').click(function(){
			localStorage.setItem('betamessage', '');
			$('.betamessage').slideDown(500);
			$('body').addClass('is-beta-shown');$('body').removeClass('is-beta-hidden');
		});
		// Clicks the Close
		$('.betamessage-close').click(function(){
			$('.betamessage').slideUp(500);
			localStorage.setItem('betamessage', 'closed');
			$('body').addClass('is-beta-hidden');$('body').removeClass('is-beta-shown');
		});
	});
});
