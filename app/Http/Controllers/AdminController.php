<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	class AdminController extends Controller {

		// ********************************************************************************
		// Function: __construct()
		// --------------------------------------------------------------------------------
		// Class constructor
		// ********************************************************************************

		public function __construct() {

			// Set route middleware
			$this->middleware( 'HasPermission:admin.%' );

		}

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// 
		// ********************************************************************************

		public function getIndex( Request $request ) {
			return view( 'admin' );
		}

	}

?>