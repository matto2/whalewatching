<?php

	namespace App\Http\Controllers\User;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\User\UserAddressAddRequest;
	use App\Http\Requests\User\UserAddressEditRequest;
	use App\Models\System\State;
	use App\Models\User\UserAddress;
	use Auth;
	use Exception;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\Request;
	use Session;
	use URL;

	class AddressController extends Controller {

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// Main user profile page.
		// ********************************************************************************

		public function getIndex( Request $request ) {
			return view( 'user.address', [ 'addresses' => Auth::user()->addresses()->get() ] );
		}

		// !Add

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// Main user profile page.
		// ********************************************************************************

		public function getAdd( Request $request ) {
			return view( 'user.address.add', [ 'states' => State::orderBy( 'name', 'asc' )->get() ] );
		}

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// Main user profile page.
		// ********************************************************************************

		public function postAdd( UserAddressAddRequest $request ) {

			try {

				// Create a new address entry
				$address = new UserAddress([
					'name'             => $request->input( 'addressName' ),
					'default_billing'  => $request->input( 'addressDefaultBilling', 0 ) == 1 ? true : false,
					'default_shipping' => $request->input( 'addressDefaultShipping', 0 ) == 1 ? true : false,
					'first_name'       => $request->input( 'addressFirstName' ),
					'last_name'        => $request->input( 'addressLastName' ),
					'company_name'     => $request->input( 'addressCompanyName' ),
					'street1'          => $request->input( 'addressStreet1' ),
					'street2'          => $request->input( 'addressStreet2' ),
					'city'             => $request->input( 'addressCity' ),
					'state'            => $request->input( 'addressState' ),
					'postal_code'      => $request->input( 'addressPostalCode' ),
					'country'          => $request->input( 'addressCountry' ),
					'phone'            => phonenumber( $request->input( 'addressPhone' ) ),
				]);

				// Add the address to the user's account
				Auth::user()->addresses()->save( $address );

				// Clear the previous default billing address, if necessary
				if ( $request->input( 'addressDefaultBilling', 0 ) == 1 ) {
					Auth::user()->addresses()->where( 'id', '!=', $address->id )->update([ 'default_billing' => 0 ]);
				}

				// Clear the previous default shipping address, if necessary
				if ( $request->input( 'addressDefaultShipping', 0 ) == 1 ) {
					Auth::user()->addresses()->where( 'id', '!=', $address->id )->update([ 'default_shipping' => 0 ]);
				}

				// Save the user's account
				Auth::user()->save();

				// Set a global success alert message
				addGlobalFlashAlert( "The address '{$address->name}' was successfully added.", 'success', true );

				// Return a success response
				return jsonResponse([ 'success' => true, 'redirect' => route('user.address' ) ]);

			}

			catch ( Exception $e ) {
				return jsonResponse([ 'success' => false, 'message' => 'Unable to save the new address: ' . $e->getMessage() ]);
			}

		}

		// !Defaults

		// ********************************************************************************
		// Function: postDefaultBilling()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to set an address as the default billing address.
		// ********************************************************************************

		public function postDefaultBilling( Request $request, $id ) {

			// Make sure the address is valid
			if ( $address = Auth::user()->addresses()->find( $id ) ) {

				try {

					// Clear the existing default
					Auth::user()->addresses()->where( 'id', '!=', $id )->update([ 'default_billing' => 0 ]);

					// Set the address as the default
					$address->default_billing = $address->default_billing ? false : true;
					$address->save();

				}

				catch ( Exception $e ) {
					Session::forget( 'globalSuccessAlert' );
					return jsonResponse([ 'success' => false, 'message' => "An error was encountered while trying to set the address '{$address->name}' as your default billing address." ]);
				}

				// Set a global success alert
//				if ( $address->default_billing ) addGlobalFlashAlert( "The address '{$address->name}' was successfully set as the default billing address.", 'success', true );
//				if ( !$address->default_billing ) addGlobalFlashAlert( "The address '{$address->name}' was successfully unset as the default billing address.", 'success', true );

				// Return successfully
				return jsonResponse([ 'success' => true ]);

			}

			return jsonResponse([ 'success' => false, 'message' => 'The address you are trying to set as the default billing address could not be found.' ]);

		}

		// ********************************************************************************
		// Function: postDefaultBilling()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to set an address as the default billing address.
		// ********************************************************************************

		public function postDefaultShipping( Request $request, $id ) {

			// Make sure the address is valid
			if ( $address = Auth::user()->addresses()->find( $id ) ) {

				try {

					// Clear the existing default
					Auth::user()->addresses()->where( 'id', '!=', $id )->update([ 'default_shipping' => 0 ]);

					// Set the address as the default
					$address->default_shipping = $address->default_shipping ? false : true;
					$address->save();

				}

				catch ( Exception $e ) {
					Session::forget( 'globalSuccessAlert' );
					return jsonResponse([ 'success' => false, 'message' => "An error was encountered while trying to set the address '{$address->name}' as your default shipping address." ]);
				}

				// Set a global success alert
//				if ( $address->default_shipping ) addGlobalFlashAlert( "The address '{$address->name}' was successfully set as the default shipping address.", 'success', true );
//				if ( !$address->default_shipping ) addGlobalFlashAlert( "The address '{$address->name}' was successfully unset as the default shipping address.", 'success', true );

				// Return successfully
				return jsonResponse([ 'success' => true ]);

			}

			return jsonResponse([ 'success' => false, 'message' => 'The address you are trying to set as the default shipping address could not be found.' ]);

		}

		// !Delete

		// ********************************************************************************
		// Function: postDelete()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to delete an address.
		// ********************************************************************************

		public function postDelete( Request $request, $id ) {

			// Make sure the address is valid
			if ( $address = Auth::user()->addresses->find( $id ) ) {

				try {

					$globalAlert = "The address '{$address->name}' was successfully deleted.";

					// Delete the address
					$address->delete();

				}

				catch ( Exception $e ) {
					Session::forget( 'globalSuccessAlert' );
					return jsonResponse([ 'success' => false, 'message' => "An error was encountered while trying to delete the address '{$address->name}'." ]);
				}

				// Set a global success alert
				addGlobalFlashAlert( $globalAlert, 'success', true );

				// Return successfully
				return jsonResponse([ 'success' => true, 'redirect' => route('user.address' ) ]);

			}

			return jsonResponse([ 'success' => false, 'message' => 'The address you are trying to delete could not be found.' ]);

		}

		// !Edit

		// ********************************************************************************
		// Function: getEdit()
		// --------------------------------------------------------------------------------
		// Edit an address page.
		// ********************************************************************************

		public function getEdit( Request $request, $id ) {
			return view( 'user.address.edit', [ 'address' => Auth::user()->addresses->find( $id ), 'states' => State::orderBy( 'name', 'asc' )->get() ] );
		}

		// ********************************************************************************
		// Function: postEdit()
		// --------------------------------------------------------------------------------
		// Process and AJAX request to edit an address.
		// ********************************************************************************

		public function postEdit( UserAddressEditRequest $request, $id ) {

			if ( $address = Auth::user()->addresses()->find( $id ) ) {

				try {
	
					// Update the address
					$address->update([
						'name'             => $request->input( 'addressName' ),
						'default_billing'  => $request->input( 'addressDefaultBilling', 0 ) == 1 ? true : false,
						'default_shipping' => $request->input( 'addressDefaultShipping', 0 ) == 1 ? true : false,
						'first_name'       => $request->input( 'addressFirstName' ),
						'last_name'        => $request->input( 'addressLastName' ),
						'company_name'     => $request->input( 'addressCompanyName' ),
						'street1'          => $request->input( 'addressStreet1' ),
						'street2'          => $request->input( 'addressStreet2' ),
						'street3'          => $request->input( 'addressStreet3' ),
						'city'             => $request->input( 'addressCity' ),
						'state'            => $request->input( 'addressState' ),
						'postal_code'      => $request->input( 'addressPostalCode' ),
						'country'          => $request->input( 'addressCountry' ),
						'phone'            => phonenumber( $request->input( 'addressPhone' ) ),
					]);
	
					// Clear the previous default billing address, if necessary
					if ( $request->input( 'addressDefaultBilling', 0 ) == 1 ) {
						Auth::user()->addresses()->where( 'id', '!=', $address->id )->update([ 'default_billing' => 0 ]);
					}
	
					// Clear the previous default shipping address, if necessary
					if ( $request->input( 'addressDefaultShipping', 0 ) == 1 ) {
						Auth::user()->addresses()->where( 'id', '!=', $address->id )->update([ 'default_shipping' => 0 ]);
					}
	
					// Return a success response
					return jsonResponse([ 'success' => true, 'message' => 'Your changes were successfully saved.' ]);
	
				}
	
				catch ( Exception $e ) {
					return jsonResponse([ 'success' => false, 'message' => 'Unable to save your changes to this address' ]);
				}

			}

			// The specified address was not found
			return jsonResponse([ 'success' => false, 'message' => 'The address you are trying to edit could not be found.' ]);

		}

		// !View

		// ********************************************************************************
		// Function: getView()
		// --------------------------------------------------------------------------------
		// View an address page.
		// ********************************************************************************

		public function getView( Request $request, $id ) {
			return view( 'user.address.view', [ 'address' => Auth::user()->addresses->find( $id ) ] );
		}

		// ********************************************************************************
		// Function: postView()
		// --------------------------------------------------------------------------------
		// Process and AJAX request to update an address.
		// ********************************************************************************

		public function postView( Request $request, $id ) {
		}

	}

?>