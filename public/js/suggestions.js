jQuery(document).ready(function($) {
	$('.add_sugestion').click(function(event) {
		//$('.add_sugestion_form').hide();
		//$('.spinner').addClass('is-active');
		$('.add_sugestion_form').hide().after('<span class="load-spinner"><img src="/wp-admin/images/loading.gif" /></span>');
		var data = {
			'action': 'add_suggestion_func',
			'whatever': ajax_object.we_value,      // We pass php values differently!
			'name': $('#input_name').val(),
			'lastname': $('#input_lastname').val(),
			'mail': $('#input_mail').val(),
			'suggestion': $('#text_suggestion').val(),
		};
		// We can also pass the url value separately from ajaxurl for front end AJAX implementations
		jQuery.post(ajax_object.ajax_url, data, function(response) {
			$('.add_sugestion_form').html('<h4>Gracias por su sugerencia</h4><a href="#">enviar otra</a>').show();
			$('.load-spinner').remove();
		});
	});


});