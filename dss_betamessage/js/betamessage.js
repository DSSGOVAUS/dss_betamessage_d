jQuery(function($) {
	$(document).ready(function() {
		const wrapper_element = $('.betamessage').data('attach-to');
		const behaviour = drupalSettings.dss_betamessage.behaviour;
		const tag = drupalSettings.dss_betamessage.tag;
		$(wrapper_element).css('position', 'relative');
		$(wrapper_element).append('<a href="#betamessage" class="betamessage-tag betamessage-open betamessage-'+tag+'" aria-label="Display '+tag+' message">'+tag+'</a>');

		if((typeof(Storage)!=='undefined') && ((localStorage.getItem('betamessage') != 'closed') || (sessionStorage.getItem('betamessage') != 'closed'))) {
			// Show the message
			$('.betamessage').css('display','block');
			$('body').addClass('is-beta-shown');
		}
		// Clicks the Close
		$('.betamessage-close').click(function(){
			$('.betamessage').slideUp(500);
			if (behaviour == 'local') {
				localStorage.setItem('betamessage', 'closed');
			}
			else {
				sessionStorage.setItem('betamessage', 'closed');
			}
			$('body').addClass('is-beta-hidden');$('body').removeClass('is-beta-shown');
		});
	});
});
