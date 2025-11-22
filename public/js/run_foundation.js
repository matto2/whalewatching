$(document).foundation();

$(document).ready( function() {
	
	// ********************************************************************************
	// Submit buttons that are outside of their respective FORM elements
	// --------------------------------------------------------------------------------

	$("button[data-form-submit]").on( "click", function(e) {
		e.preventDefault();
		$("form#" + $(this).attr( 'data-form-submit' )).submit();
	});

	// ********************************************************************************
	// AJAX Form Submission
	// --------------------------------------------------------------------------------

	$("form[data-form-url]").on( "submit", function(e) {
		e.preventDefault();
		$(this).attr( "action", $(this).attr( "data-form-url" ) );
		submitForm( $(this) );
	});

});

function showGlobalSuccessAlert( message ) {
	$("#globalAlerts").append( '<div class="success callout">' + message + '<a href="#" class="close">&times;</a></div>' );
// 	$(document).foundation('alert', 'reflow');
}

function showGlobalErrorAlert( message ) {
	$("#globalAlerts").append( '<div class="alert callout">' + message + '<a href="#" class="close">&times;</a></div>' );
// 	$(document).foundation('alert', 'reflow');
}

function getElementValue( element ) {

	if ( $.inArray( $(element).prop("nodeName"), [ "INPUT", "SELECT", "TEXTAREA" ] ) !== -1 ) {

		// Checkboxes
		if ( $(element).attr("type") == 'checkbox' ) {
			if ( typeof $(element).attr("value") !== typeof undefined && $(element).attr("value") !== false ) {
				return $(element).attr("value");
			}
			return $(element).prop("checked") ? 1 : 0;
		}

		return $(element).val();

	}

	if ( typeof $(element).attr("value") !== typeof undefined && $(element).attr("value") !== false ) {
		return $(element).attr("value");
	}

	return $(this).val();

}

function getFormData( form ) {

	// Initialize the form data object
	var data = {};

	// Add all form elements to the data object
	$(form).find("*[name]").each( function( index ) {

		// Handle arrays
		if ( $(this).attr( 'name' ).substr( $(this).attr( 'name' ).length - 2 ) == '[]' ) {
			if ( Array.isArray( data[$(this).attr( 'name' ).substr( 0, $(this).attr( 'name' ).length - 2 )] ) ) {
				data[$(this).attr( 'name' ).substr( 0, $(this).attr( 'name' ).length - 2 )].push( getElementValue($(this)) );
			}
			else {
				data[$(this).attr( 'name' ).substr( 0, $(this).attr( 'name' ).length - 2 )]= [ getElementValue($(this)) ];
			}
		}

		// Handle non-arrays
		else {
			data[$(this).attr( 'name' )] = getElementValue($(this));
		}

	});

	return( data );

}

function submitForm( form ) {

	// Run the submitting function, if it exists
	var submittingFunctionName = $(form).attr("id") + "Submitting";
	if ( typeof submittingFunctionName !== 'undefined' && $.isFunction( window[submittingFunctionName] ) ) {
		if ( !window[submittingFunctionName]( form ) ) {
			console.log("Aborting from submitting function");
			return;
		}
	}

	var formData = getFormData( form );

	// Run the get data function, if it exists
	var getDataFunctionName = $(form).attr("id") + "GetData";
	if ( typeof getDataFunctionName !== 'undefined' && $.isFunction( window[getDataFunctionName] ) ) {
		formData = window[getDataFunctionName](form);
	}

	// Add the CSRF token to the form data
	formData["_token"] = $('meta[name="csrf-token"]').attr('content');

	console.debug(formData);

	// Remove errors
	$(form).find(".error-alert").addClass( "hide" );
	$(form).find(".error-alert").html( "RESET" );
	$(form).find(".success-alert").addClass( "hide" );
	$(form).find("label, *[name]").removeClass( "error" );
	$(form).find("small.error").remove();
	$("#globalAlerts .ajax-alert-box").remove();
	
	// Display a please wait modal
	$("#globalModal h2").html( "Please wait..." );
	if ( $(form).attr( "data-form-wait-title" ) ) $("#globalModal h2").html( $(form).attr( "data-form-wait-title" ) );
	if ( $(form).attr( "data-form-wait-text" ) ) $("#globalModal span").html( $(form).attr( "data-form-wait-text" ) );
// 	$("#globalModal").foundation( "reveal", "open" );

	$.ajax({

		url: form.attr( "action" ),
		type: "POST",
		async: true,
		dataType: "json",
		data: formData,

		success: function (response) {

			console.debug( response );

			if ( response.success == true ) {

				// Run the success function, if it exists
				var successFunctionName = $(form).attr("id") + "Success";
				if ( typeof successFunctionName !== 'undefined' && $.isFunction( window[successFunctionName] ) ) {
					window[successFunctionName]( form, formData, response );
				}

				// Clear all fields
				if ( response.success && $(form).is( "[data-form-clear-fields]" ) ) {
					$(form).find("*[name]").each( function( index ) {
						if ( $(this).attr( "data-form-default" ) ) $(this).val( $(this).attr( "data-form-default" ) )
						else $(this).val( "" );
					});
				}

				// Reload the page, if necessary
				if ( $(form).is( "[data-form-reload-page]" ) ) {
					location.reload();
				}

				// Redirect, if specified
				if ( response.success && "redirect" in response ) {
					window.location = response.redirect;
				}

				if ( response.message ) {
					showGlobalSuccessAlert( response.message );
				}

			}

			else {

				// Run the error function, if it exists
				var errorFunctionName = $(form).attr("id") + "Error";
				if ( typeof errorFunctionName !== 'undefined' && $.isFunction( window[errorFunctionName] ) ) {
					window[errorFunctionName]( form, formData, response );
				}

				// Display errors for each input field
				if ( $.isPlainObject( response.errors ) ) {
					$.each( response.errors, function( key, value ) {
						$(form).find( "*[name='" + key + "']" ).addClass( "error" );
						$(form).find( "*[name='" + key + "']" ).parents( "label" ).first().addClass( "error" );
						$(form).find( "*[name='" + key + "']" ).parents( "label" ).first().after( '<small class="error">' + value + '</small>' );
					});
				}

				// Display the main error alert
				showGlobalErrorAlert( response.message );

			}

		},

		error: function (xhr, ajaxOptions, thrownError) {
			showGlobalErrorAlert( '<strong>An error occurred: ' + thrownError + '</strong>' );
		},

		statusCode: {
			404: function() {
				showGlobalErrorAlert( '<strong>An error occurred: 404 Page Not Found</strong>' );
			}
		},

		complete: function() {

			// Run the completion function, if it exists
			var completeFunctionName = $(form).attr("id") + "Complete";
			if ( typeof completeFunctionName !== 'undefined' && $.isFunction( window[completeFunctionName] ) ) {
				window[completeFunctionName]( form, formData, response );
			}

// 			$("#globalModal").foundation( "reveal", "close" );
			$("html, body").animate({ scrollTop: 0 }, "fast");
			$(form).find("*[name]").first().focus()

		}

	});

}