<?php

	// ********************************************************************************
	// Function: addGlobalFlashAlert()
	// --------------------------------------------------------------------------------
	// Add a global flash alert.
	// ********************************************************************************

	function addGlobalFlashAlert( $message, $type = '', $dismissable = false ) {

		// Retrieve the current alerts
		$alerts = Session::get( 'globalFlashAlerts' );
		if ( !is_array( $alerts ) ) $alerts = [];

		if ( is_array( $message ) ) {
			if ( array_key_exists( 'message', $message ) ) {
				$alerts[] = [
					'message'     => $message['message'],
					'type'        => array_key_exists( 'type', $message ) ? $message['type'] : '',
					'dismissable' => array_key_exists( 'dismissable', $message ) ? $message['dismissable'] : false,
				];
			}
		}

		else {
			$alerts[] = [
				'message'     => $message,
				'type'        => $type,
				'dismissable' => $dismissable,
			];
		}

		\Session::flash( 'globalFlashAlerts', $alerts );

	}

?>