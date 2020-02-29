/* global ajaxurl, futurioNUX */
( function( wp, $ ) {
	'use strict';

	if ( ! wp ) {
		return;
	}

	$( function() {
		// Dismiss notice
		$( document ).on( 'click', '.sf-notice-nux .notice-dismiss', function() {
			
			$.ajax({
				type:     'POST',
				url:      ajaxurl,
				data:     { nonce: businessconsultantfinderNUX.nonce, action: 'business_consultant_finder_dismiss_notice' },
				dataType: 'json'
			});
		});
		
		
	});
  
  
})( window.wp, jQuery );