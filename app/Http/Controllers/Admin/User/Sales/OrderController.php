<?php

	namespace App\Http\Controllers\Admin\User\Sales;

	use App\Http\Controllers\Controller;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\Request;

	class OrderController extends Controller {

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// Main user order page.
		// ********************************************************************************

		public function getIndex( Request $request, $id ) {
			return view( 'admin.user.sales.order', [ 'orders' => auth()->user()->orders ] );
		}

		// ********************************************************************************
		// Function: postAdd()
		// --------------------------------------------------------------------------------
		// Main user profile page.
		// ********************************************************************************

		public function postAdd( UserAdminAddressAddRequest $request, $id ) {

			// Make sure the specified user is valid
			if ( $user = User::find( $id ) ) {

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
						'street3'          => $request->input( 'addressStreet3' ),
						'city'             => $request->input( 'addressCity' ),
						'state'            => $request->input( 'addressState' ),
						'postal_code'      => $request->input( 'addressPostalCode' ),
						'country'          => $request->input( 'addressCountry' ),
						'phone'            => phonenumber( $request->input( 'addressPhone' ) ),
					]);
	
					// Add the address to the user's account
					$user->addresses()->save( $address );
	
					// Clear the previous default billing address, if necessary
					if ( $request->input( 'addressDefaultBilling', 0 ) == 1 ) {
						$user->addresses()->where( 'id', '!=', $address->id )->update([ 'default_billing' => 0 ]);
					}
	
					// Clear the previous default shipping address, if necessary
					if ( $request->input( 'addressDefaultShipping', 0 ) == 1 ) {
						$user->addresses()->where( 'id', '!=', $address->id )->update([ 'default_shipping' => 0 ]);
					}
	
					// Save the user's account
					$user->save();
	
					// Set a global success alert message
					addGlobalFlashAlert( "<strong>The address '{$address->name}' was successfully added.</strong>", 'success', true );
	
					// Return a success response
					return jsonResponse([ 'success' => true, 'redirect' => route('admin.user.view', $id ) ]);
	
				}
	
				catch ( Exception $e ) {
					return jsonResponse([ 'success' => false, 'message' => '<strong>Unable to save the new address.</strong>' ]);
				}

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The user account you specified could not be found.</strong>' ]);

		}

		// !Defaults

		// ********************************************************************************
		// Function: postDefaultBilling()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to set an address as the default billing address.
		// ********************************************************************************

		public function postDefaultBilling( Request $request, $id, $address ) {

			// Make sure the specified user is valid
			if ( $user = User::find( $id ) ) {

				// Make sure the address is valid
				if ( $address = $user->addresses()->find( $id ) ) {
	
					try {
	
						// Clear the existing default
						$user->addresses()->where( 'id', '!=', $id )->update([ 'default_billing' => 0 ]);
	
						// Set the address as the default
						$address->default_billing = $address->default_billing ? false : true;
						$address->save();
		
					}
	
					catch ( Exception $e ) {
						return jsonResponse([ 'success' => false, 'message' => "<strong>An error was encountered while trying to set the address '{$address->name}' as the default billing address.</strong>" ]);
					}
	
					// Set a global success alert
					if ( $address->default_billing ) addGlobalFlashAlert( "<strong>The address '{$address->name}' was successfully set as the default billing address.</strong>", 'success', true );
					if ( !$address->default_billing ) addGlobalFlashAlert( "<strong>The address '{$address->name}' was successfully unset as the default billing address.</strong>", 'success', true );

					// Return successfully
					return jsonResponse([ 'success' => true ]);

				}
	
				return jsonResponse([ 'success' => false, 'message' => '<strong>The address you are trying to set as the default billing address could not be found.</strong>' ]);

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The user account you specified could not be found.</strong>' ]);

		}

		// ********************************************************************************
		// Function: postDefaultBilling()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to set an address as the default billing address.
		// ********************************************************************************

		public function postDefaultShipping( Request $request, $id, $address ) {

			// Make sure the specified user is valid
			if ( $user = User::find( $id ) ) {

				// Make sure the address is valid
				if ( $address = $user->addresses()->find( $id ) ) {
	
					try {
	
						// Clear the existing default
						$user->addresses()->where( 'id', '!=', $id )->update([ 'default_shipping' => 0 ]);
	
						// Set the address as the default
						$address->default_shipping = $address->default_shipping ? false : true;
						$address->save();
		
					}
	
					catch ( Exception $e ) {
						return jsonResponse([ 'success' => false, 'message' => "<strong>An error was encountered while trying to set the address '{$address->name}' as the default shipping address.</strong>" ]);
					}
	
					// Set a global success alert
					if ( $address->default_shipping ) addGlobalFlashAlert( "<strong>The address '{$address->name}' was successfully set as the default shipping address.</strong>", 'success', true );
					if ( !$address->default_shipping ) addGlobalFlashAlert( "<strong>The address '{$address->name}' was successfully unset as the default shipping address.</strong>", 'success', true );

					// Return successfully
					return jsonResponse([ 'success' => true ]);

				}
	
				return jsonResponse([ 'success' => false, 'message' => '<strong>The address you are trying to set as the default shipping address could not be found.</strong>' ]);

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The user account you specified could not be found.</strong>' ]);

		}

		// !Delete

		// ********************************************************************************
		// Function: postDelete()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to delete an address.
		// ********************************************************************************

		public function postDelete( Request $request, $id, $address ) {

			// Make sure the specified user is valid
			if ( $user = User::find( $id ) ) {
	
				// Make sure the address is valid
				if ( $address = $user->addresses->find( $address ) ) {
	
					try {
	
						// Delete the address
						$globalAlert = "<strong>The address '{$address->name}' was successfully deleted.</strong>";
						$address->delete();
	
					}
	
					catch ( Exception $e ) {
						return jsonResponse([ 'success' => false, 'message' => "<strong>An error was encountered while trying to delete the address '{$address->name}'.</strong>" ]);
					}
	
					// Set a global success alert
					addGlobalFlashAlert( $globalAlert, 'success', true );

					// Return successfully
					return jsonResponse([ 'success' => true, 'redirect' => route('admin.user.view', $id ) ]);

				}
	
				return jsonResponse([ 'success' => false, 'message' => '<strong>The address you are trying to delete could not be found.</strong>' ]);

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The user account you specified could not be found.</strong>' ]);

		}

		// !View

		// ********************************************************************************
		// Function: getView()
		// --------------------------------------------------------------------------------
		// View/Edit an address page.
		// ********************************************************************************

		public function getView( Request $request, $id, $address ) {

			$data = [
				'user'    => User::find( $id ),
				'address' => User::find( $id )->addresses()->find( $address ),
				'states'  => State::orderBy( 'name', 'asc' )->get(),
			];

			return view( 'admin.user.address.view', $data );
			return view( 'admin.user.address.view', [ 'address' => User::find( $id )->addresses()->find( $address ), 'states' => State::orderBy( 'name', 'asc' )->get() ] );

		}

		// ********************************************************************************
		// Function: postView()
		// --------------------------------------------------------------------------------
		// Process and AJAX request to edit an address.
		// ********************************************************************************

		public function postView( UserAdminAddressEditRequest $request, $id, $address ) {

			if ( $user = User::find( $id ) ) {

				if ( $address = $user->addresses()->find( $id ) ) {
	
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
							$user->addresses()->where( 'id', '!=', $address->id )->update([ 'default_billing' => 0 ]);
						}
		
						// Clear the previous default shipping address, if necessary
						if ( $request->input( 'addressDefaultShipping', 0 ) == 1 ) {
							$user->addresses()->where( 'id', '!=', $address->id )->update([ 'default_shipping' => 0 ]);
						}
		
						// Return a success response
						return jsonResponse([ 'success' => true, 'message' => '<strong>Your changes were successfully saved.</strong>' ]);
		
					}
		
					catch ( Exception $e ) {
						return jsonResponse([ 'success' => false, 'message' => '<strong>Unable to save your changes to this address</strong>' ]);
					}
	
				}
	
				// The specified address was not found
				return jsonResponse([ 'success' => false, 'message' => '<strong>The address you are trying to edit could not be found.</strong>' ]);
			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The user account you specified could not be found.</strong>' ]);

		}

	}

?>