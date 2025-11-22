<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	class HomeController extends Controller {

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// 
		// ********************************************************************************

		public function getIndex( Request $request ) {
			return view( 'home' );
		}

		// ********************************************************************************
		// Function: getWildcard()
		// --------------------------------------------------------------------------------
		// Handle routes that do not exist.
		// ********************************************************************************

		public function getWildcard( Request $request, $path ) {

			// Check if a view exists for the current URL path
			if ( $request->path() == '/' && view()->exists( 'home' ) ) {
				return view( 'home' );
			}

			// If a view exists, show it.
			if ( view()->exists( $view = str_replace( '/', '.', $request->path() ) ) ) {
				return view( $view );
			}

			// Otherwise show a 404 error.
			abort( 404 );

		}

		public function getTest() {
			$user = \App\Models\User\User::find( 1 );
			$user->sendWelcomeMail();
		}

	}

?>