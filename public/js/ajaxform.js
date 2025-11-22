// ********************************************************************************
// AJAX Form Submission Functions
// --------------------------------------------------------------------------------
// To use:
//   Mark the FORM element with data-form-ajax.
//   Include a DIV element marked data-form-ajax-alerts for alert messages.
//   Mark the submit BUTTON or element with data-form-ajax-submit="form".
//     - Use a jQuery selector for "form" to target the FORM element.
// --------------------------------------------------------------------------------
// You can have a button submit an AJAX form by adding the following attributes:
//   data-form-ajax-button
//   action="url" - The URL to submit the form to.
//   data-form-ajax-data="" - Key=Value pairs, separated by an ampersand (&).
// --------------------------------------------------------------------------------
// Additional FORM element parameters that can be used:
//   data-form-ajax-clear - Clear all fields after form submission success.
//   data-form-ajax-reload - Reload the page after form submission success.
// --------------------------------------------------------------------------------
// For automatic CSRF functionality, add the following line to <head>:
//   <meta name="csrf-token" content="{{ csrf_token() }}">
// ********************************************************************************

// ********************************************************************************
// Function: ajaxFormClearInputs()
// --------------------------------------------------------------------------------
// Clear the form.
// --------------------------------------------------------------------------------

function ajaxFormClearInputs( form ) {

	$( form ).find( "*[name]" ).each( function( index ) {
		ajaxFormSetElementValue( this, $( this ).is( "[data-form-default]" ) ? $( this ).attr( "data-form-default" ) : "" );
	});

	// Call the form get data function named with <form ID>GetData, if it exists
	var functionName = $( form ).attr( "id" ) + "ClearInputs";
	if ( typeof functionName !== 'undefined' && $.isFunction( window[functionName] ) ) {
		formData = window[functionName]( form );
	}

	$( form ).trigger( "ajaxFormClearInputs" );

}

// ********************************************************************************
// Function: ajaxFormGetData()
// --------------------------------------------------------------------------------
// Retrieve all form data.
// --------------------------------------------------------------------------------

function ajaxFormGetData( form ) {

	// Initialize the form data object
	var formData = new FormData();

	// Gather data specified in the data-form-ajax-data attribute
	if ( $( form ).is( "[data-form-ajax-data]" ) ) {

		var data = $( form ).attr( "data-form-ajax-data" ).split( "&" );

		data.forEach( function( attribute ) {
			var attributeArray = attribute.toString().split( "=" );
			formData.append( attributeArray[0], attributeArray[1] );
		});

	}

	// Add all form elements to the data object
	$( form ).find( "*[name]" ).each( function( index ) {

		var objValue = ajaxFormGetElementValue( $( this ) );

		if ( objValue !== null ) {
			formData.append( $( this ).attr( "name" ), objValue );
		}

	});

	// Call the form get data function named with <form ID>GetData, if it exists
	var functionName = $( form ).attr( "id" ) + "GetData";
	if ( typeof functionName !== 'undefined' && $.isFunction( window[functionName] ) ) {
		formData = window[functionName]( form, formData );
	}

	// Return the form data
	return( formData );

}

// ********************************************************************************
// Function: ajaxFormGetElementValue()
// --------------------------------------------------------------------------------
// Get the value of a form element.
// --------------------------------------------------------------------------------

function ajaxFormGetElementValue( element ) {

	if ( $.inArray( $(element).prop( "nodeName" ), [ "INPUT", "SELECT", "TEXTAREA" ] ) !== -1 ) {

		// Checkboxes and radio buttons
		if ( $(element).attr( "type" ) == 'checkbox' || $(element).attr( "type" ) == 'radio' ) {
			if ( typeof $(element).attr( "value" ) !== typeof undefined && $(element).attr( "value" ) !== false ) {
				if ( $(element).prop( "checked" ) ) {
					return $(element).attr( "value" );
				}
				return null;
			}
			return $(element).prop( "checked" ) ? 1 : 0;
		}

		if ( $(element).attr( "type" ) == "file" ) {
			return $(element)[0].files[0];
		}

		return $(element).val();

	}

	if ( typeof $(element).attr( "value" ) !== typeof undefined && $(element).attr( "value" ) !== false ) {
		return $(element).attr( "value" );
	}

	return $( this ).val();

}

// ********************************************************************************
// Set the value of a form element.
// --------------------------------------------------------------------------------

function ajaxFormSetElementValue( element, value ) {

	if ( $(element).attr( "type" ) == 'checkbox' || $(element).attr( "type" ) == 'radio' ) {
		$(element).prop( "checked", value > 0 ? true : false );
	}

	else if ( $(element).prop( "nodeName" ) == 'OPTION' ) {
		$(element).prop( "selected", value > 0 ? true : false );
	}

	else {
		$(element).val( value );
	}

}

// ********************************************************************************
// Function: ajaxFormShowAlertMessage()
// --------------------------------------------------------------------------------
// Show a global alert (appears under the page title).
// --------------------------------------------------------------------------------
// This uses Foundation's callout component.
// --------------------------------------------------------------------------------
// Type should be none (default), primary, secondary, warning, alert, success.
// Dismissable determines if you can close the alert. default is false.
// --------------------------------------------------------------------------------

function ajaxFormShowAlertMessage( form, message, dismissable ) {

	// Set default values
	dismissable = typeof dismissable !== 'undefined' ? dismissable : false;

	// Show a dismissable alert
	if ( dismissable ) {
		$( "*[data-form-ajax-alerts]" ).append( '<div class="ajax-alert alert callout" data-closable><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ' + message + '<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>' );
	}

	// Show a non-dismissable alert
	else {
		$( "*[data-form-ajax-alerts]" ).append( '<div class="ajax-alert alert callout"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ' + message + '</div>' );
	}

	$( "html, body" ).animate({ scrollTop: 0 }, "slow" );
	$( '#alerts' ).foundation();

}

// ********************************************************************************
// Function: ajaxFormShowSuccessMessage()
// --------------------------------------------------------------------------------
// Show a global alert (appears under the page title).
// --------------------------------------------------------------------------------
// This uses Foundation's callout component.
// --------------------------------------------------------------------------------
// Type should be none (default), primary, secondary, warning, alert, success.
// Dismissable determines if you can close the alert. default is false.
// --------------------------------------------------------------------------------

function ajaxFormShowSuccessMessage( form, message, dismissable ) {

	// Set default values
	dismissable = typeof dismissable !== 'undefined' ? dismissable : false;

	// Show a dismissable alert
	if ( dismissable ) {
		$( "*[data-form-ajax-alerts]" ).append( '<div class="ajax-alert success callout" data-closable><i class="fa fa-check" aria-hidden="true"></i> ' + message + '<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>' );
	}

	// Show a non-dismissable alert
	else {
		$( "*[data-form-ajax-alerts]" ).append( '<div class="ajax-alert success callout"><i class="fa fa-check" aria-hidden="true"></i> ' + message + '</div>' );
	}

	$( "html, body" ).animate({ scrollTop: 0 }, "slow" );
	$( '#alerts' ).foundation();

}

// ********************************************************************************
// Function: ajaxFormShowModal()
// --------------------------------------------------------------------------------
// Show the form's "please wait" modal.
// --------------------------------------------------------------------------------

function ajaxFormShowModal( form ) {

	if ( $( form ).is( "data-form-modal" ) ) {

		var modalTitle = $( form ).is( "[data-form-modal-title]" ) ? $( form ).attr( "data-form-modal-title" ) : "Please Wait...";
		var modalContent = $( form ).is( "[data-form-modal-text]" ) ? $( form ).attr( "data-form-modal-text" ) : "";

		if ( typeof showModal !== 'undefined' && $.isFunction( showModal ) ) {
			showModal( modalTitle, modalContent, false, false );
		}

	}

}

// ********************************************************************************
// Function: ajaxFormSubmit()
// --------------------------------------------------------------------------------
// Submit the specified form via AJAX.
// --------------------------------------------------------------------------------

function ajaxFormSubmit( form ) {

	// Retrieve the form data
	formData = ajaxFormGetData( form );

	// Prepare the form for submission
	$( form ).find( ".button" ).addClass( "disabled" );                            // Disable buttons
	$( "*[data-form-ajax-alerts] .ajax-alert" ).remove();                          // Remove form errors
	$( form ).find( ".form-error" ).remove();                                      // Remove field errors
	$( form ).find( ".is-invalid-input" ).removeClass( "is-invalid-input" );       // Clear required input errors

	// Display a please wait modal
	ajaxFormShowModal( form );

	$.ajax({

		url: $( form ).attr( "action" ),
		type: "POST",
		async: true,
		data: formData,
		dataType: "json",
		headers: { 'X-CSRF-Token': $( 'meta[name="csrf-token"]' ).attr( 'content' ) },
		processData: false,
		contentType: false,

		success: function (response) {

			console.log(response);
			// Store the new CSRF token
			$( 'meta[name="csrf-token"]' ).attr( 'content', response.csrf_token );

			// Update the cart link, if necessary
			if ( response.cartCount == 0 ) {
				$( ".cartLink" ).html( "Cart" );
			}

			else if ( response.cartCount > 0 ) {
				$( ".cartLink" ).html( "Cart (" + response.cartCount + ")" );
			}

			// Successful response
			if ( response.success == true ) {

				$( form ).trigger( "ajaxFormSuccess" );

				// Reload the page, if necessary
				if ( response.reload || $( form ).is( "[data-form-ajax-reload]" ) ) {
					location.reload();
				}

				// Reload the page, if necessary
				else if ( $( form ).is( "[data-form-ajax-redirect]" ) ) {
					window.location = $( form ).attr( "data-form-ajax-redirect" );
				}

				// Redirect, if specified
				else if ( "redirect" in response ) {
					window.location = response.redirect;
				}

				// Display a success message, if there is one
				else if ( response.message ) {
					ajaxFormShowSuccessMessage( form, response.message, true );
					$( "html, body" ).animate({ scrollTop: 0 }, "slow" );
				}

				// Clear all form fields
				if ( response.clear || $( form ).is( "[data-form-ajax-clear]" ) ) {
					ajaxFormClearInputs( form );
				}

				// Call the success function named with <form ID>Success, if it exists
				var functionName = $( form ).attr( "id" ) + "Success";
				if ( typeof functionName !== 'undefined' && $.isFunction( window[functionName] ) ) {
					formData = window[functionName]( form, formData, response );
				}

			}

			// Error response
			else {

				$( form ).trigger( "ajaxFormFailure" );

				// Display errors for each input field
				if ( $.isPlainObject( response.errors ) ) {

					var errors = [];
					var errorList = "<ul>";

					$.each( response.errors, function( key, value ) {
						$( form ).find( "*[name='" + key + "']" ).addClass( "is-invalid-input" );
						$( form ).find( "*[name='" + key + "']" ).after( '<span class="form-error is-visible"><i class="fa fa-arrow-up" aria-hidden="true"></i> ' + value + '</span>' );
						$( form ).find( "*[name='" + key + "']" ).parents( ".field" ).first().addClass( "error" );
						errors.push( value );
						errorList = errorList + '<li>' + value + '</li>';
					});

					errorList = errorList + "</ul>";

					if ( errors.length == 1 ) {
						ajaxFormShowAlertMessage( form, "<strong>" + errors[0] + "</stong>", true );
					}

					else {
						ajaxFormShowAlertMessage( form, '<strong>Please correct the following errors:</strong>' + errorList, true );
					}

				}

				// Display a success message, if there is one
				else if ( response.message ) {
					ajaxFormShowAlertMessage( form, response.message, true );
					$( "html, body" ).animate({ scrollTop: 0 }, "slow" );
				}

				hideModal();
				$( form ).find( ".button" ).removeClass( "disabled" );
				$( form ).find( "button[type=submit]" ).removeClass( "loading" );

				// Scroll to the top of the page
				$( "html, body" ).animate({ scrollTop: 0 }, "fast" );

			}

		},

		error: function (xhr, ajaxOptions, thrownError) {
			ajaxFormShowAlertMessage( form, '<strong>An error occurred: ' + thrownError + '</strong>', true );
			hideModal();
		},

		statusCode: {
			404: function() {
				ajaxFormShowAlertMessage( form, '<strong>An error occurred: 404 Page Not Found</strong>', true );
				hideModal();
			}
		},

		complete: function() {

			$( form ).find( ".button" ).removeClass( "disabled" );
			$( form ).trigger( "ajaxFormComplete" );

			// Close the global modal
			$( "#globalModal" ).foundation( 'close' );
			$( "#globalDismissableModal" ).foundation( 'close' );

			setFirstFocus();

		}

	});

}

$(document).ready( function() {

	// ********************************************************************************
	// Elements that submit an AJAX form
	// --------------------------------------------------------------------------------

	$( "body" ).on( "click", "*[data-form-ajax-submit]", function(e) {
		e.preventDefault();
		$( $( this ).attr( "data-form-ajax-submit" ) ).submit();
	});

	// ********************************************************************************
	// AJAX Form Submission
	// --------------------------------------------------------------------------------

	// Buttons that submit AJAX forms
	$( "body" ).on( "click", "*[data-form-ajax-button]", function(e) {
		e.preventDefault();
		ajaxFormSubmit( this );
	});

	// Forms that submit via AJAX
	$( "body" ).on( "submit", "*[data-form-ajax]", function(e) {
		e.preventDefault();
		ajaxFormSubmit( this );
	});

});
