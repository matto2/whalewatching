<?php

	namespace App\Http\Controllers\Admin;

	use Illuminate\Http\Request;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\User\UserAdminActivateRequest;
	use App\Http\Requests\Admin\User\UserAdminAddRequest;
	use App\Http\Requests\Admin\User\UserAdminEditRequest;
	use App\Http\Requests\Admin\User\UserAdminPasswordRequest;
	use App\Http\Requests\Admin\User\UserAdminSettingsRequest;
	use App\Models\ACL\Permission;
	use App\Models\ACL\Role;
	use App\Models\User\User;
	use App\Models\User\UserPermission;
	use App\Models\User\UserRole;
	use App\Models\User\UserMeta;

	use Carbon\Carbon;
	use Hash;

	class UserController extends Controller {

		// ********************************************************************************
		// Function: __construct()
		// --------------------------------------------------------------------------------
		// Class constructor
		// ********************************************************************************

		public function __construct() {

			// Set route middleware
			$this->middleware( 'HasPermission:admin.user.%' );
			$this->middleware( 'HasPermission:admin.user.add' )->only([ 'getAdd', 'postAdd' ]);

		}

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// Main user administration page.
		// ********************************************************************************

		public function getIndex() {

			// Retrieve all users if the online user is a super admin (ID #1)
			if ( auth()->user()->id == 1 ) {
				$users = User::all();
			}

			// Otherwise don't retrieve hidden users, expect for the online user's current account
			else {
				$users = User::where( 'hidden', 0 )->orWhere( 'id', auth()->user()->id )->get();
			}

			return view( 'admin.user', [ 'users' => $users ] );

		}

		// !Activate User

		// ********************************************************************************
		// Function: postActivate()
		// --------------------------------------------------------------------------------
		// Process an AJAX activate user request.
		// ********************************************************************************

		public function postActivate( UserAdminActivateRequest $request, $id ) {

			// Retrieve the user
			if ( $user = User::find( $id ) ) {

				switch ( $request->input( 'action' ) ) {

					// --------------------------------------------------------------------------------
					// Activate the user's account

					case 'activate':

						// Activate the user
						$user->activate( false );

						// Set a global alert
						addGlobalFlashAlert( "<strong>The user's account has been activated.</strong>", 'success', true );

						// Return a success response
						return jsonResponse([ 'success' => true, 'reload' => true ]);

					// --------------------------------------------------------------------------------
					// Deactivate the user's account

					case 'deactivate':

						// Set a global alert
						addGlobalFlashAlert( "<strong>The user's account has been deactivated.</strong>", 'success', true );

						// Return a success response
						return jsonResponse([ 'success' => true, 'reload' => true ]);

					// --------------------------------------------------------------------------------
					// Resend the activation e-mail message

					case 'resend':

						// Resend the welcome message
						$user->sendWelcomeMail();

						// Set a global alert
						addGlobalFlashAlert( "<strong>The user's activation message has been resent.</strong>", 'success', true );

						// Return a success response
						return jsonResponse([ 'success' => true, 'reload' => true ]);

					// --------------------------------------------------------------------------------
					// An invalid action was specified

					default:
						return jsonResponse([ 'success' => false, 'message' => '<strong>The specified password action is invalid.</strong>' ]);

				}

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The specified user could not be found.</strong>' ]);

		}

		// ********************************************************************************
		// Function: postActivate()
		// --------------------------------------------------------------------------------
		// Process an AJAX activate user request.
		// ********************************************************************************

		public function postActivateEmail( $id ) {

			if ( $user = User::find( $id ) ) {

				// Create a job to register the user
//				Queue::push( 'App\Controllers\User\Admin\QueueController@sendWelcomeEmail', array(
//					'user_id' => $id,
//				));

				$user->sendWelcomeMail();
				return( Response::json( array( 'success' => true ) ) );

			}

			return( Response::json( array( 'success' => false, 'message' => 'Unable to activate the user.' ) ) );

		}

		// !Add User

		// ********************************************************************************
		// Function: getAdd()
		// --------------------------------------------------------------------------------
		// Display the add user page.
		// ********************************************************************************

		public function getAdd() {
			return view( 'admin.user.add' );
		}

		// ********************************************************************************
		// Function: postAdd()
		// --------------------------------------------------------------------------------
		// Process an AJAX add user request.
		// ********************************************************************************

		public function postAdd( UserAdminAddRequest $request ) {

			try {

				// Create the new user
				$user = new User;
				$user->first_name = $request->input( 'firstName' );
				$user->last_name = $request->input( 'lastName' );
				$user->email = $request->input( 'email' );
				$user->created_by = auth()->user()->id;
	
				// Set the user's password
				if ( $request->input( 'password' ) ) {
					$user->password = Hash::make( $request->input( 'password' ) );
					$user->password_last_changed = Carbon::now();
				}
	
				// Set the user as administrator, if necessary
				if ( $request->input( 'isAdministrator' ) ) $user->administrator = true;
	
				// Set the user account as hidden, if neccessary and performed by the super admin user (ID #1)
				if ( $request->input( 'hidden' ) && auth()->user()->id == 1 ) $user->hidden = true;
	
				// Set an activation code if activation necessary
				if ( $request->input( 'verifyUser' ) ) {
					$user->activation_code = str_random( 40 );
				}
	
				// Activate the user if activation is not necessary
				else {
					$user->activated = Carbon::now();
				}
	
				// Set the password never expires flag
				$user->password_never_expires = false;
				if ( $request->input( 'passwordNeverExpires' ) == 1 ) $user->password_never_expires = true;
	
				// Set the password expiration
				$user->password_expires = null;
				if ( setting( 'userPasswordAgeMax' ) > 0 ) $user->password_expires = Carbon::now()->addDays( setting( 'userPasswordAgeMax' ) );
				if ( $request->input( 'changePassword' ) ) $user->password_expires = Carbon::now();
	
				// Save the user's account
				$user->save();
	
				// Save permission records
				if ( is_array( $request->input( 'permissions' ) ) && count( $request->input( 'permissions' ) ) ) {
					$permissions = [];
					foreach( $request->input( 'permissions' ) as $permission ) {
						$permissions[] = new UserPermission([ 'acl_permission_id' => intval( $permission ) ]);
					}
					$user->permissions()->saveMany( $permissions );
				}
	
				// Save role records
				if ( is_array( $request->input( 'roles' ) ) && count( $request->input( 'roles' ) ) ) {
					$roles = [];
					foreach( $request->input( 'roles' ) as $role ) {
						$roles[] = new UserRole([ 'acl_role_id' => intval( $role ) ]);
					}
					$user->roles()->saveMany( $roles );
				}
	
				// Send the user a welcome message
				if ( $request->input( 'sendWelcome' ) ) $user->sendWelcomeMail();
	
				return jsonResponse([ 'success' => true, 'message' => "<strong>The user '{$user->first_name} {$user->last_name}' was successfully added.</strong> <a href='" . route('admin.user.view', $user->id) . "' title='View user'>View user?</a>" ]);

			}

			catch ( Exception $e ) {
				return jsonResponse([ 'success' => false, 'message' => "<strong>As error occurred: {$e->getMessage()}</strong>" ]);
			}

		}

		// !Delete User

		// ********************************************************************************
		// Function: postUsersDelete()
		// --------------------------------------------------------------------------------
		// Process an AJAX delete user request.
		// ********************************************************************************

		public function postDelete( Request $request, $id ) {

			// Retrieve the user
			if ( $user = User::find( $id ) ) {

				// Set a global success alert
				addGlobalFlashAlert( "<strong>The user '{$user->email}' was successfully deleted.</strong>", 'success', true );

				// Delete the user
				$user->delete();

				// Return a success response
				return jsonResponse([ 'success' => true, 'redirect' => route('admin.user' ) ]);

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The specified user could not be found.</strong>' ]);

		}

		// !Enable & Disable

		// ********************************************************************************
		// Function: postDisable()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to disable the specified user.
		// ********************************************************************************

		public function postDisable( Request $request, $id ) {

			// Retrieve the user
			if ( $user = User::find( $id ) ) {

				// Set a global success alert
				addGlobalFlashAlert( "<strong>The user '{$user->email}' was successfully disabled.</strong>", 'success', true );

				// Disable the user
				$user->enabled = false;
				$user->save();

				// Return a success response
				return jsonResponse([ 'success' => true ]);

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The specified user could not be found.</strong>' ]);

		}

		// ********************************************************************************
		// Function: postEnable()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to enable the specified user.
		// ********************************************************************************

		public function postEnable( Request $request, $id ) {

			// Retrieve the user
			if ( $user = User::find( $id ) ) {

				// Set a global success alert
				addGlobalFlashAlert( "<strong>The user '{$user->email}' was successfully enabled.</strong>", 'success', true );

				// Enable the user
				$user->enabled = true;
				$user->save();

				// Return a success response
				return jsonResponse([ 'success' => true ]);

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The specified user could not be found.</strong>' ]);

		}

		// !Passwords

		// ********************************************************************************
		// Function: postPassword()
		// --------------------------------------------------------------------------------
		// Process an AJAX password request.
		// ********************************************************************************

		public function postPassword( UserAdminPasswordRequest $request, $id = null ) {

			// Retrieve the user
			if ( $user = User::find( $id ) ) {

				switch ( $request->input( 'action' ) ) {

					// --------------------------------------------------------------------------------
					// Expire the user's password

					case 'expire':

						// Set the user's password as expired
						$user->password_expires = date( 'Y-m-d H:i:s' );
						$user->save();

						// Set a global success alert
						addGlobalFlashAlert( "<strong>The user's password has been set as expired.</strong>", 'success', true );

						// Return a success response
						return jsonResponse([ 'success' => true ]);

					// --------------------------------------------------------------------------------
					// Clear the user's password history

					case 'history.clear':

						// Delete the user's password history
						$user->meta()->where( 'key', 'userPasswordRemember' )->delete();

						// Return a success response
						return jsonResponse([ 'success' => true, 'message' => "<strong>The user's password history has been successfully cleared." ]);

					// --------------------------------------------------------------------------------
					// Reset the user's password

					case 'reset':

						// Start the password reset process
						$user->sendPasswordResetMail( true );

						// Set a global success alert
						addGlobalFlashAlert( "<strong>The user has been sent an e-mail message with a password reset link.</strong>", 'success', true );

						// Return a success response
						return jsonResponse([ 'success' => true ]);

					// --------------------------------------------------------------------------------
					// Set the user's password

					case 'set':

						// Set the user's password
						$user->password = \Hash::make( $request->input( 'password' ) );
						$user->password_last_changed = \Carbon\Carbon::now();
						$user->password_expires = \Carbon\Carbon::now()->addMonths( 6 );
						$user->reset_password_code = null;
						$user->save();

						// Expire the password if the user must change it on next log on
						if ( $request->input( 'change_password' ) == 1 ) $user->expirePassword();

						// Set a global success alert
						addGlobalFlashAlert( "<strong>The user's password has been changed.</strong>", 'success', true );

						// Return a success response
						return jsonResponse([ 'success' => true ]);

					// --------------------------------------------------------------------------------
					// An invalid action was specified

					default:
						return jsonResponse([ 'success' => false, 'message' => '<strong>The specified password action is invalid.</strong>' ]);

				}

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The specified user could not be found.</strong>' ]);

		}

		// !Settings

		// ********************************************************************************
		// Function: getSettings()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getSettings( Request $request ) {
			return view( 'admin.user.settings' );
		}

		// ********************************************************************************
		// Function: postUsersSettings()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postSettings( UserAdminSettingsRequest $request ) {

			// Save all settings
			setting([
				'userEmailSenderName'                   => $request->input( 'userEmailSenderName', null ),
				'userEmailSenderAddress'                => $request->input( 'userEmailSenderAddress', null ),
				'userEmailAdminSenderName'              => $request->input( 'userEmailAdminSenderName', null ),
				'userEmailAdminSenderAddress'           => $request->input( 'userEmailAdminSenderAddress', null ),

				'userSignupEnable'                      => $request->input( 'userSignupEnable', 0 ),
				'userEmailWelcomeEnable'                => $request->input( 'userEmailWelcomeEnable', 0 ),
				'userEmailWelcomeSubject'               => $request->input( 'userEmailWelcomeSubject', null ),
				'userEmailWelcomeAdminEnable'           => $request->input( 'userEmailWelcomeAdminEnable', 0 ),
				'userEmailWelcomeAdminSubject'          => $request->input( 'userEmailWelcomeAdminSubject', null ),
				'userEmailAdminNotifyEnable'            => $request->input( 'userEmailAdminNotifyEnable', 0 ),
				'userEmailAdminNotifyInterval'          => $request->input( 'userEmailAdminNotifyInterval', 'daily' ),
				'userEmailAdminNotifyRecipient'         => $request->input( 'userEmailAdminNotifyRecipient', null ),
				'userEmailAdminNotifyRecipientCC'       => $request->input( 'userEmailAdminNotifyRecipientCC', null ),
				'userEmailAdminNotifyRecipientBCC'      => $request->input( 'userEmailAdminNotifyRecipientBCC', null ),
				'userEmailAdminNotifySubject'           => $request->input( 'userEmailAdminNotifySubject', null ),

				'userActivateEnable'                    => $request->input( 'userActivateEnable', 0 ),
				'userActivateEmailSubject'              => $request->input( 'userActivateEmailSubject', 0 ),
				'userActivateEmailAdminSubject'         => $request->input( 'userActivateEmailAdminSubject', 0 ),
				'userActivateEmailCompleteSubject'      => $request->input( 'userActivateEmailCompleteSubject', 0 ),

				'userLockoutEnable'                     => $request->input( 'userLockoutEnable', 0 ),
				'userLockoutAttempts'                   => $request->input( 'userLockoutAttempts', 0 ),
				'userLockoutWindow'                     => $request->input( 'userLockoutWindow', 0 ),
				'userLockoutDuration'                   => $request->input( 'userLockoutDuration', 0 ),

				'userSingleLogin'                       => $request->input( 'userSingleLogin', 0 ),

				'userPasswordNoExpireEnable'            => $request->input( 'userPasswordNoExpireEnable', 0 ),
				'userPasswordLengthMin'                 => $request->input( 'userPasswordLengthMin', null ),
				'userPasswordLengthMax'                 => $request->input( 'userPasswordLengthMax', null ),
				'userPasswordAgeMin'                    => $request->input( 'userPasswordAgeMin', 8 ),
				'userPasswordAgeMax'                    => $request->input( 'userPasswordAgeMax', 255 ),
				'userPasswordRemember'                  => $request->input( 'userPasswordRemember', 0 ),
				'userPasswordChangedEmailEnable'        => $request->input( 'userPasswordChangedEmailEnable', 0 ),
				'userPasswordChangedEmailSubject'       => $request->input( 'userPasswordChangedEmailSubject', null ),
				'userPasswordChangedEmailAdminEnable'   => $request->input( 'userPasswordChangedEmailAdminEnable', 0 ),
				'userPasswordChangedEmailAdminSubject'  => $request->input( 'userPasswordChangedEmailAdminSubject', null ),

				'userPasswordResetEmailSubject'         => $request->input( 'userPasswordResetEmailSubject', null ),
				'userPasswordResetEmailAdminSubject'    => $request->input( 'userPasswordResetEmailAdminSubject', null ),

				'userEmailChangedEmailEnable'           => $request->input( 'userEmailChangedEmailEnable', 0 ),
				'userEmailChangedEmailSubject'          => $request->input( 'userEmailChangedEmailSubject', null ),
				'userEmailChangedEmailAdminEnable'      => $request->input( 'userEmailChangedEmailAdminEnable', 0 ),
				'userEmailChangedEmailAdminSubject'     => $request->input( 'userEmailChangedEmailAdminSubject', null ),
			]);

			return jsonResponse([ 'success' => true, 'message' => '<strong>Your changes were successfully saved.</strong>' ]);

			// If password remembering is set to zero, clear all user password histories
			if ( $request->input( 'userPasswordRemember', 0 ) == 0 ) {
				UserMeta::where( 'key', 'userPasswordRemember' )->delete();
			}

			return jsonResponse([ 'success' => true, 'message' => '<strong>Your changes were successfully saved.</strong>' ]);

		}

		// !View User

		// ********************************************************************************
		// Function: getView()
		// --------------------------------------------------------------------------------
		// View a user.
		// ********************************************************************************

		public function getView( $id ) {

			// Retrieve the selected user if the online user is a super admin (ID #1), or if it's the user's own account
			if ( auth()->user()->id == 1 || $id == auth()->user()->id ) {
				$user = User::find( $id );
			}

			// Otherwise only retrieve an account that is not hidden
			else {
				$user = User::where( 'id', $id )->where( 'hidden', 0 )->first();
			}

			if ( auth()->user()->hasPermission( 'admin.user.edit' ) ) {

				$data = [
					'user'        => $user,
					'permissions' => Permission::orderBy( 'name', 'asc' )->get(),
					'roles'       => Role::orderBy( 'name', 'asc' )->get(),
				];

				return view( 'admin.user.edit', $data );

			}

			return view( 'admin.user.view', [ 'user' => $user ] );

		}

		// ********************************************************************************
		// Function: postView()
		// --------------------------------------------------------------------------------
		// Process an AJAX edit user request.
		// ********************************************************************************

		public function postView( UserAdminEditRequest $request, $id ) {

			// Search for the user
			if ( $user = User::find( $id ) ) {

				try {

					$user->first_name = $request->input( 'firstName' );
					$user->last_name = $request->input( 'lastName' );

					if ( $request->input( 'email' ) ) {
						$user->email = $request->input( 'email' );
					}

					// Set the password never expires flag
					$user->password_never_expires = false;
					if ( $request->input( 'neverExpire' ) ) $user->password_never_expires = true;

					// Set the site administrator flag
					$user->administrator = false;
					if ( $request->input( 'isAdministrator' ) ) $user->administrator = true;

					// Set the user account as hidden, if neccessary and performed by the super admin user (ID #1)
					$user->hidden = false;
					if ( $request->input( 'hidden' ) && auth()->user()->id == 1 ) $user->hidden = true;

					$user->save();

					// Delete role and permission records so they can be re-added
					$user->roles()->delete();
					$user->permissions()->delete();

					// Save role records
					if ( is_array( $request->input( 'roles' ) ) && count( $request->input( 'roles' ) ) ) {
						$roles = collect([]);
						foreach( $request->input( 'roles' ) as $role ) {
							$roles[] = new UserRole([ 'acl_role_id' => intval( $role ) ]);
						}
						if ( count( $roles ) ) $user->roles()->saveMany( $roles );
					}

					// Save permission records
					if ( is_array( $request->input( 'permissions' ) ) && count( $request->input( 'permissions' ) ) ) {
						$permissions = collect([]);
						foreach( $request->input( 'permissions' ) as $permission ) {
							if ( !$user->hasRolePermission( $permission ) ) {
								$permissions[] = new UserPermission([ 'acl_permission_id' => intval( $permission ) ]);
							}
						}
						if ( count( $permissions ) ) $user->permissions()->saveMany( $permissions );
					}

					addGlobalFlashAlert( '<strong>Your changes were successfully saved.</strong>', 'success', true );
					return jsonResponse([ 'success' => true, 'reload' => true ]);

				}

				catch ( Exception $e ) {
					return jsonResponse([ 'success' => false, 'message' => "<strong>As error occurred: {$e->getMessage()}</strong>" ]);
				}

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The specified user could not be found.</strong>' ]);

		}

	}

?>
