<?php

	namespace App\Http\Controllers\User\Sales;

	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;

	class OrderController extends Controller {

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// Main user order page.
		// ********************************************************************************

		public function getIndex( Request $request ) {
			return view( 'user.sales.order', [ 'orders' => auth()->user()->orders ] );
		}

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// View user order page.
		// ********************************************************************************

		public function getView( Request $request, $id ) {
			return view( 'user.sales.order.view', [ 'order' => auth()->user()->orders()->where( 'id', $id )->first() ] );
		}

	}

?>