function strtofloat( string ) {
	if ( isNaN( parseFloat( string ) ) ) return 0;
	return parseFloat( string );
}

// ********************************************************************************
// Format a number with commas.
// --------------------------------------------------------------------------------

function commaFormatted(amount) {
	var delimiter = ","; // replace comma if desired
	var a = amount.split('.',2)
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3) {
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
}

// ********************************************************************************
// Show a global alert (appears under the page title).
// --------------------------------------------------------------------------------
// This uses Foundation's callout component.
// --------------------------------------------------------------------------------
// Type should be none (default), primary, secondary, warning, alert, success.
// Dismissable determines if you can close the alert. default is false.
// --------------------------------------------------------------------------------

function showGlobalAlert( messageHeader, message, type, dismissable ) {

	// Set default values
	type = typeof type !== 'undefined' ? type : '';
	dismissable = typeof dismissable !== 'undefined' ? dismissable : false;

	// Show a dismissable alert
	if ( dismissable ) {
		$("#alerts").prepend( '<div class="formAlert ' + type + ' callout" data-closable>' + messageHeader + '</strong>' + message + '<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button></div>' );
	}

	// Show a non-dismissable alert
	else {
		$("#alerts").prepend( '<div class="formAlert ' + type + ' callout"></i><strong>' + message + '</strong>' + message + '</div>' );
	}

	$("html, body").animate({ scrollTop: 0 }, "slow");
	$('#alerts').foundation();

}

// ********************************************************************************
// ********************************************************************************

// !Modals

// ********************************************************************************
// ********************************************************************************

var modalTimeout = 0; // Used to display a delayed modal

function showModal( title, content, dismissable, delayed ) {

	dismissable = typeof dismissable !== 'undefined' ? dismissable : false;
	delayed = typeof delayed !== 'undefined' ? delayed : false;

	if ( dismissable ) {

		$("#globalDismissableModal > h2").html(title);
		$("#globalDismissableModal > span").html(content);

		if ( delayed ) {
			modalTimeout = setTimeout('$("#globalDismissableModal").foundation("open");', 750);
		}
		else {
			$("#globalDismissableModal").foundation("open");
		}
	}

	else {

		$("#globalModal > h2").html(title);
		$("#globalModal > span").html(content);

		if ( delayed ) {
			modalTimeout = setTimeout('$("#globalModal").foundation("open");', 750);
		}
		else {
			$("#globalModal").foundation("open");
		}
	}


}

function hideModal() {
	clearTimeout( modalTimeout );
	$("#globalModal").foundation("close");
	$("#globalDismissableModal").foundation("close");
}


// Set focus, as long as we are not on a touch device
function setFirstFocus() {
	if ( !('ontouchstart' in document.documentElement) ) {
		$(".first-focus").focus();
	}
}

$(document).ready( function() {

	$(document).foundation();

	setFirstFocus();

	$('.message .close').on('click', function() {
		$(this).closest('.message').transition('fade');
	});

	// ********************************************************************************
	// Tables with clickable rows
	// --------------------------------------------------------------------------------

	$("table tbody tr[data-click], table tbody td[data-click]").mouseover( function(e) {
		$(this).addClass( 'hover' );
		$(this).css( "cursor", "pointer" );
	});

	$("table tbody tr[data-click], table tbody td[data-click]").mouseout( function(e) {
		$(this).removeClass( 'hover' );
	});

	$("table tbody tr[data-click], table tbody td[data-click]").click( function(e) {
		e.preventDefault();
		e.stopPropagation();
		window.location = $(this).attr( 'data-click' );
	});

	// ********************************************************************************
	// Searchable tables
	// --------------------------------------------------------------------------------

	$(document).on( 'keyup', 'input[type=text][data-search]', function(e) {

		var table = $( $(this).attr( 'data-search' ) );

		if ( this.value.length ) {

			var reg = new RegExp(this.value, 'i'); // case-insesitive

			$(table).find('*[data-search-element]').each(function() {

				var $me = $(this);

				if (!$me.children('*[data-search-content]').text().match(reg)) {
					$me.addClass( "hide" );
				}

				else {
					$me.removeClass( "hide" );
				}

			});

		}

		else {

			$(table).find('*[data-search-element]').each( function() {
				$(this).removeClass( "hide" );
			});

		}

	});

	// ********************************************************************************
	// Set initial form input values
	// --------------------------------------------------------------------------------

	$("*[data-form-initial-value]").each( function( index ) {
		if ( $(this).attr( 'data-form-initial-value' ).length ) {
			ajaxFormSetElementValue( $(this), $(this).attr( 'data-form-initial-value' ) );
		}
	});

	// ********************************************************************************
	// Disable elements if data-form-disable=1
	// --------------------------------------------------------------------------------

	$("*[data-form-disable=1]").each( function( index ) {
		$(this).prop( "disabled", true );
	});

	// ********************************************************************************
	// Checkbox groups with select all capability
	// --------------------------------------------------------------------------------
	// Mark the "select all" checkbox with data-form-select-all-toggle="group".
	// Mark the member checkboxes with data-form-select-all="group".
	// "group" should be a name that is specific to each group.
	// --------------------------------------------------------------------------------

	// Update the "select all" checkbox for the specified group
	function updateSelectAll( groupName ) {

		var toggleElementSelector = "input[type=checkbox][data-select-all-toggle=" + groupName + "]";
		var elementSelector = "input[type=checkbox][data-select-all=" + groupName + "]";
		var checkedElementSelector = "input[type=checkbox][data-select-all=" + groupName + "]:checked";

		if ( $(checkedElementSelector).length == $(elementSelector).length ) {
			$(toggleElementSelector).prop( "checked", true );
		}

		else {
			$(toggleElementSelector).prop( "checked", false );
		}

	}

	// Toggle all group members when the "select all" checkbox is changed
	$(document).on( "change", "input[type=checkbox][data-select-all-toggle]", function(e) {

		var elementSelector = "input[type=checkbox][data-select-all=" + $(this).attr("data-select-all-toggle") + "]";

		if ( $(this).prop("checked") ) {
			$(elementSelector).prop( "checked", true );
		}

		else {
			$(elementSelector).prop( "checked", false );
		}

	});

	// Update the "select all" checkbox when one group member is changed
	$(document).on( "change", "input[type=checkbox][data-select-all]", function(e) {
		updateSelectAll( $(this).attr( "data-select-all" ) );
	});

	// Update the "select all" checkboxes
	$("input[type=checkbox][data-select-all-toggle]").each( function( index ) {
		updateSelectAll( $(this).attr( "data-select-all-toggle" ) );
	});

	// ********************************************************************************
	// Single selection checkboxes
	// --------------------------------------------------------------------------------
	// Add data-form-single-selection="{name}" to each checkbox. Set {name} to a value
	// that is unique to each group of independant checkboxes. Note that {name} does
	// not correspond to the input's NAME property, or any other property.
	// --------------------------------------------------------------------------------

	// Uncheck all other checkboxes when one is checked
	$("body").on( "change", "input[type=checkbox][data-form-single-selection]", function(e) {
		e.preventDefault();
		if ( $(this).prop("checked") ) {
			$(this).closest("form").find("*[data-form-single-selection='" + $(this).attr("data-form-single-selection") + "']").not(this).prop( "checked", false );
		}
	});

	// ********************************************************************************
	// Inputs that toggle a checkbox
	// --------------------------------------------------------------------------------

	$("body").on( "keyup", ".inputCheckbox input[type=text]", function(e) {
		e.preventDefault();
		$(this).parent().find( "input[type=checkbox]" ).prop( "checked", $(this).val().length ? true : false );
	});

	// ********************************************************************************
	// Country SELECT inputs that change State SELECT inputs
	// --------------------------------------------------------------------------------
	// Give the Country SELECT input the attribute data-state-select="selector", where
	// "selector" is a jQuery selector that points to the State SELECT input.
	// --------------------------------------------------------------------------------

	// Enable appropriate state/province options when country is changed
	$("select[data-state-select]").on( "change", function(e) {

		var selectedCountry = $(this).find("option:selected").val();
		var stateSelectObj = $(this).attr( "data-state-select" );

 		$(stateSelectObj + " option:not([value=''])").hide();
		if ( selectedCountry ) {
			$(stateSelectObj + " option[data-country-id=" + selectedCountry + "]").show();
		}

		if ( $(stateSelectObj).val() ) {
			if ( $(stateSelectObj).find( "[value=" + $(stateSelectObj).val() + "]" ).prop( "hidden" ) ) {
				$(stateSelectObj).val( "" );
			}
		}

	});

	// Trigger initial change event for country selections when page loads
	$("select[data-state-select]").trigger( "change" );

	// ********************************************************************************
	// 
	// --------------------------------------------------------------------------------

	$("*[data-url-slug]").on( "keyup", function(e) {
		var slug = $(this).val();
		slug = slug.toLowerCase();
		slug = slug.replace(/\s+/g, '_')           // Replace spaces with underscores
		slug = slug.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
		slug = slug.replace(/\-\-+/g, '-')         // Replace multiple - with single -
		slug = slug.replace(/^-+/, '')             // Trim - from start of text
		slug = slug.replace(/-+$/, '');            // Trim - from end of text
		$( $(this).attr("data-url-slug") ).val( slug );
	});

	// ********************************************************************************
	// Logout Link
	// --------------------------------------------------------------------------------

	$(".userLogoutLink").on( "click", function(e) {

		e.preventDefault();

		$.ajax({

			url: "/user/logout",
			type: "POST",
			dataType: "json",

			data: {
				_token: $('meta[name="csrf-token"]').attr('content')
			},

			success: function (response) {

				// The request was successful
				if ( response.success == true ) {
					window.location = response.redirect;
				}

				// The request was not successful
				else {
					$("#global_modal .message").html( "<strong>An Error Occurred:</strong> " + response.message );
					$("#global_modal").modal( "show" );
				}

			},

			error: function (xhr, ajaxOptions, thrownError) {
				$("#global_modal .message").html( thrownError );
				$("#global_modal").foundation( "close" );
			},

			statusCode: {
				404: function() {
					$("#global_modal .message").html( "<strong>The logoff page could not be found.</strong>" );
					$("#global_modal").foundation( "close" );
				}
			}

		});

	});

	// ********************************************************************************
	// Duplicated form elements with a toggle checkbox
	// --------------------------------------------------------------------------------
	// Give the checkbox the attribute data-form-duplicate-toggle.
	// --------------------------------------------------------------------------------
	// Give source inputs the attribute data-form-duplicate-target="selector", where
	// "Selector" is a jQuery selector that describes the duplicate input.
	// --------------------------------------------------------------------------------
	// Give duplicate inputs the attribute data-form-duplicate-target-source="selector"
	// where "selector" is a jQuery selector that points to the toggle checkbox.
	// --------------------------------------------------------------------------------

	// Respond to duplicate form toggle checkbox change events
	$("*[data-form-duplicate-toggle]").on( "change", function(e) {

		e.preventDefault();

		var inputSelector = "*[data-form-duplicate-toggle-source='input[name=" + $(this).attr( "name" ) + "]']";

		// Disable inputs if the checkbox is checked
		$(inputSelector).prop( "disabled", $(this).prop( "checked" ) );

		// If unchecked, clear all values
		if ( !$(this).prop( "checked" ) ) {
			setElementValue( inputSelector, "" );
		}

		$("*[data-form-duplicate-target]").trigger( "change" );

	});

	// Trigger initial change event for toggle checkboxes when page loads
	$("*[data-form-duplicate-toggle]").trigger( "change" );

	$("body").on( "change", "*[data-duplicate-toggle]", function(e) {
		console.log("made it");
	});

	$("body").on( "change", "*[data-duplicate-on]", function(e) {
		var target = $(this).attr( "data-duplicate-target" );
		if ( $( $(this).attr( "data-duplicate-on") ).length ) {
			$(target).val( $(this).val() );
			if ( $(this).is( "[data-duplicate-target-disable]" ) ) $(target).prop( "disabled", true );
		}
	});




	$( document ).on( "change", "*[data-toggle-show]", function( e ) {

		var selector = $( this ).attr( 'data-toggle-show' );

		if ( selector.includes( "," ) ) {

			var values = selector.split( "," );

			if ( $( this ).is( values[0] ) ) {
				$( values[1] ).removeClass( "hide" );
			}

			else {
				$( values[1] ).addClass( "hide" );
			}

		}

		else {
			
			if ( $( this ).prop( "checked" ) ) {
				$( selector ).removeClass( "hide" );
			}

			else {
				$( selector ).addClass( "hide" );
			}

		}

		if ( e.hasOwnProperty( 'originalEvent' ) ) {
			$( "input[name=" + $( this ).attr( "name" ) + "]" ).not( this ).trigger( "change" );
		}

	});

	$( "*[data-toggle-show]" ).trigger( "change" );

	$( document ).on( "change", "*[data-toggle-hide]", function( e ) {

		var element = this;
		var selector = $( this ).attr( 'data-toggle-hide' );

		if ( selector.includes( "," ) ) {

			var values = selector.split( "," );

			if ( $( this ).is( values[0] ) ) {
				$( values[1] ).addClass( "hide" );
			}

			else {
				$( values[1] ).removeClass( "hide" );
			}

		}

		else {
			
			if ( $( this ).prop( "checked" ) ) {
				$( selector ).addClass( "hide" );
			}

			else {
				$( selector ).removeClass( "hide" );
			}

		}

		if ( e.hasOwnProperty( 'originalEvent' ) ) {
			$( "input[name=" + $( this ).attr( "name" ) + "]" ).not( this ).trigger( "change" );
		}

	});

	$( "*[data-toggle-hide]" ).trigger( "change" );




			// Set address fields on save address selection change
			$( document ).on( "change", "select[data-address-group]", function(e) {

				if ( $( this ).find( "option:selected" ).is( "[data-address]" ) ) {
					var address = JSON.parse( $( this ).find( "option:selected" ).attr( "data-address" ) );
					for ( var item in address ) {
						$( "*[data-address-field='" + $(this ).attr( "data-address-group" ) + "." + item + "']" ).val( address[item] );
					}
				}

				else {
					$( "*[data-address-field ^= '" + $(this ).attr( "data-address-group" ) + ".']").each( function() {
						$( this ).val( "" );
					});
				}

			});







});

