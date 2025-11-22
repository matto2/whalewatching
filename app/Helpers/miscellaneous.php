<?php

	// ********************************************************************************
	// Function: jsonResponse()
	// --------------------------------------------------------------------------------
	// Return a JSON response, along with the current CSRF token.
	// ********************************************************************************

	function jsonResponse( $return ) {

		// Make sure the return value is an array
		if ( !is_array( $return ) ) $return = [ $return ];

		// Add the CSRF and Braintree tokens
		$return['csrf_token'] = csrf_token();
//		$return['braintree_token'] = \Braintree_ClientToken::generate();

		// Return the JSON response
		return response()->json( $return );

	}

	// ********************************************************************************
	// Function: referer()
	// --------------------------------------------------------------------------------
	// Get the URL of the referring page, if that page is from this site.
	// ********************************************************************************

	function referer() {

		if ( substr( request()->server( 'HTTP_REFERER' ), 0, strlen( config( 'app.url' ) ) ) == config( 'app.url' ) ) {
			return substr( request()->server( 'HTTP_REFERER' ), strlen( config( 'app.url' ) ) );
		}

		return false;

	}

?>
