jQuery(function($) {
	$('.wpa-playground-request-type').on('change', function() {
		var value = $(this).val();
		var wrapper = $('.request-body-wrapper');

		if ( value === 'POST' ) {
			wrapper.show();
		} else {
			wrapper.hide();
		}
	});

	$('#submit').on('click', function() {
		var method = $('.wpa-playground-request-type').val();

		wp.apiRequest( {
			url: wpApiSettings.root.replace(/\/$/, '') + $('.wpa-playground-endpoint-path').val(),
			method: method,
			data: method === 'POST' ? JSON.parse($('.wpa-playground-request-body').val()) : undefined,
		} ).done( function( response ) {
			if ( typeof response === 'object' ) {
				response = JSON.stringify(response, undefined, 4);
			}

			$('#response').html(response);
		} );
	});
});