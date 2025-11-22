<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Mail;

	use App\Http\Requests\User\UserActivateRequest;
	use App\Http\Requests\User\UserEmailRequest;
	use App\Http\Requests\User\UserExpiredRequest;
	use App\Http\Requests\User\UserLoginRequest;
	use App\Http\Requests\User\UserPasswordRequest;
	use App\Http\Requests\User\UserResetRequest;
	use App\Http\Requests\User\UserSignupRequest;
	use App\Jobs\User\Admin\NewUserNotifyJob;
	use App\Jobs\User\NewUserAccountJob;
	use App\Models\User\User;

	use Carbon\Carbon;
	use Hash;

	class UserController extends Controller {

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// Main user profile page.
		// ********************************************************************************

		public function getIndex( Request $request ) {
			return view( 'user', [ 'user' => auth()->user() ] );
		}

		// !Activate

		// ********************************************************************************
		// Function: getActivate()
		// --------------------------------------------------------------------------------
		// Activate your account page.
		// ********************************************************************************

		public function getActivate( Request $request, $code = null ) {

			// Redirect to the home page if the user is already logged on
			if ( auth()->check() ) return redirect()->route('home' );

			if ( is_null( $code ) ) {

				// Redirect to the home page if the user is already activated
				if ( auth()->user()->activated != 0 ) {
					return redirect()->route('home' );
				}

				return view( 'user.activate' );

			}

			elseif ( $code == 'complete' ) {

				$request->session()->keep( 'user_activation_complete' );

				if ( $request->session()->has( 'user_activation_complete' ) ) {
					return view( 'user.activate.complete' );
				}

				else {
					return redirect()->route('home' );
				}

			}

			else {

				// Attempt to activate the user
				if ( $user = User::where( 'activation_code', $code )->first() ) {

					// Log out the current user
					auth()->logout();

					// If the user does not have a password, show the set password page
					if ( !$user->password ) {
						return view( 'user.activate.password' );
					}

					// Activate the user's account
					$user->activate();

					// Redirect the user to the home page
					$request->session()->flash( 'user_activation_complete', true );
					return redirect()->route('user.activate', [ 'complete' ] );

				}

				// Activation code is invalid
				else {
					return view( 'user.activate.invalid' );
				}

			}

		}

		// ********************************************************************************
		// Function: postActivate()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to activate the user's account.
		// ********************************************************************************

		public function postActivate( UserActivateRequest $request ) {

			// Attempt to activate the user and set their password
			if ( $request->segment(3) && $user = User::where( 'activation_code', $request->segment(3) )->first() ) {

				// Update the user's account
				$user->password = Hash::make( $request->input( 'password' ) );
				$user->activate();
				$user->save();

				// Log the user on
				auth()->login( $user );

				// Set a global success alert
				addGlobalFlashAlert( '<strong>Thank you for verifying your account!</strong> You are now logged on.', 'success', true );

				// Redirect the user to the home page
				return jsonResponse([ 'success' => true, 'redirect' => '/' ]);

			}

			// Activation code is invalid
			else {

				// Attempt to retrieve the user with the specified email address
				if ( $user = User::where( 'email', $request->input( 'email' ) )->first() ) {

					if ( $user->isActivated() ) {
						return jsonResponse([ 'success' => false, 'message' => '<strong>There was no account found with that e-mail address that has not been activated.</strong>' ]);
					}

					// Resend the user's activation message
					$user->sendWelcomeMail();

					return jsonResponse([ 'success' => true, 'message' => '<strong>We have resent your activation message.</strong> Please check your inbox for further instructions.' ]);

				}

				return jsonResponse([ 'success' => false, 'message' => '<strong>There was no account found with that e-mail address that has not been activated.</strong>' ]);

			}

		}

		// !Change E-Mail Address

		// ********************************************************************************
		// Function: getEmail()
		// --------------------------------------------------------------------------------
		// Change your e-mail address page.
		// ********************************************************************************

		public function getEmail( Request $request ) {
			return view( 'user.email' );
		}

		// ********************************************************************************
		// Function: postEmail()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to change the user's e-mail address.
		// ********************************************************************************

		public function postEmail( UserEmailRequest $request ) {

			if ( auth()->validate([ 'email' => auth()->user()->email, 'password' => $request->input( 'password' ) ]) ) {
				
				// Set the e-mail address
				auth()->user()->email = $request->input( 'email' );
				auth()->user()->save();

				// Set a global success alert
				addGlobalFlashAlert( "<strong>Your e-mail address was successfully changed to '" . auth()->user()->email . "'.</strong>", 'success', true );

				// Return a success response
				return jsonResponse([ 'success' => true ]);

			}

			// Return a success response
			return jsonResponse([ 'success' => false, 'message' => '<strong>The password you entered does not match the password on your account.</strong>' ]);

		}

		// !Disabled Account

		// ********************************************************************************
		// Function: getDisabled()
		// --------------------------------------------------------------------------------
		// Account is disabled page.
		// ********************************************************************************

		public function getDisabled( Request $request ) {
			return view( 'user.disabled' );
		}

		// !Expired Password

		// ********************************************************************************
		// Function: getExpired()
		// --------------------------------------------------------------------------------
		// Password is expired page.
		// ********************************************************************************

		public function getExpired( Request $request ) {
			return view( 'user.expired' );
		}

		// ********************************************************************************
		// Function: postExpired()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to change the user's expired password.
		// ********************************************************************************

		public function postExpired( UserExpiredRequest $request ) {

			// Make sure the new password doesn't match a previous password
			if ( auth()->user()->matchesPreviousPassword( $request->input( 'password' ) ) ) {
				if ( ($passwords = setting( 'userPasswordRemember' )) > 0 ) {
					return jsonResponse([ 'success' => false, 'message' => "<strong>You can not use one of your previous {$passwords} passwords.</strong>" ]);
				}
				return jsonResponse([ 'success' => false, 'message' => '<strong>Your new password must be different that your current password.</strong>' ]);
			}

			// Set the password
			auth()->user()->password = Hash::make( $request->input( 'password' ) );
			auth()->user()->save();

			// Set a global success alert
			addGlobalFlashAlert( '<strong>Your password was successfully changed.</strong>', 'success', true );

			// Return a success response
			return jsonResponse([ 'success' => true, 'redirect' => '/' ]);

		}

		// !Log Out

		// ********************************************************************************
		// Function: getLogout()
		// --------------------------------------------------------------------------------
		// Log off of your account page.
		// ********************************************************************************

		public function getLogout( Request $request ) {

			// If the user is not logged in, redirect to the home page
			if ( auth()->guest() ) {
				return redirect()->route( 'home' );
			}

			// Save redirection URL
			if ( referer() ) session()->flash( 'userLoginReferer', referer() );

			// Show the logout page
			return view( 'user.logout' );

		}

		// ********************************************************************************
		// Function: postLogout()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to log a user off.
		// ********************************************************************************

		public function postLogout() {

			// Log the user out
			auth()->logout();
			addGlobalFlashAlert( '<strong>You have been logged out of your account.</strong>', 'success', true );

			$redirect = route( 'home' );

			return jsonResponse([ 'success' => true, 'redirect' => $redirect ]);

		}

		// !Log In

		// ********************************************************************************
		// Function: getLogon()
		// --------------------------------------------------------------------------------
		// Log in to your account page.
		// ********************************************************************************

		public function getLogin() {

			// Store the referring page, if necessary
			if ( referer() ) session()->flash( 'userLoginReferer', referer() );

			// Retain the intended URL, if necessary
			session()->keep( 'userLoginRedirect' );

			// Store the intended URL, if necessary
			if ( session()->has( 'url.intended' ) ) {
				session()->flash( 'userLoginRedirect', session()->get( 'url.intended' ) );
				session()->forget( 'url.intended' );
			}

			// Display the log in page
			return view( 'user.login' );

		}

		// ********************************************************************************
		// Function: postLogin()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to log a user on.
		// ********************************************************************************

		public function postLogin( UserLoginRequest $request ) {

			// Retrieve the user's account
			$user = User::where( 'email', $request->input( 'email' ) )->first();

			// Check if the user is locked out
			if ( setting( 'userLockoutEnable' ) && !is_null( $user->lockout_until ) && ($time = Carbon::parse( $user->lockout_until ) ) ) {
				if ( Carbon::now() <= $time ) {
					return jsonResponse([ 'success' => false, 'message' => "<strong>Your account has been locked out due to too many unsuccessful login attempts.</strong><br>Your account will unlock at {$time->toDayDateTimeString()}." ]);
				}
			}

			// Reset the lockout time
			$user->lockout_until = null;

			// Attempt to log the user on
			if ( !auth()->attempt( ['email' => $request->input( 'email' ), 'password' => $request->input( 'password' )], false ) ) {

				if ( setting( 'userLockoutEnable' ) ) {

					// Record the first and last login attempt times
					if ( is_null( $user->login_attempt_first ) ) $user->login_attempt_first = Carbon::now()->toDateTimeString();
					$user->login_attempt_last = Carbon::now()->toDateTimeString();
	
					// Reset the login attempt window, if we have passed it
					if ( Carbon::parse( $user->login_attempt_first )->diffInMinutes( Carbon::parse( $user->login_attempt_last ) ) > setting( 'userLockoutWindow' ) ) {
						$user->login_attempt_first = $user->login_attempt_last = Carbon::now()->toDateTimeString();
					}
	
					$user->login_attempt_count++;
	
					if ( $user->login_attempt_count >= setting( 'userLockoutAttempts' ) && Carbon::parse( $user->login_attempt_first )->diffInMinutes( Carbon::parse( $user->login_attempt_last ) ) <= setting( 'userLockoutWindow' ) ) {
						$time = $user->lockout_until = Carbon::now()->addMinutes( setting( 'userLockoutDuration' ) );
						$user->save();
						return jsonResponse([ 'success' => false, 'message' => "<strong>Your account has been locked out due to too many unsuccessful login attempts.</strong><br>Your account will unlock at {$time->toDayDateTimeString()}." ]);
					}

				}

				// Save any changes to the user's account
				$user->save();

				return jsonResponse([ 'success' => false, 'message' => '<strong>The email address and password combination you entered was not recognized.</strong> <a href="' . route( 'user.reset' ) . '" title="Reset your password">Did you forget your password?</a>' ]);

			}

			// Clear user lockout fields
			$user->login_attempt_first = null;
			$user->login_attempt_last = null;
			$user->login_attempt_count = 0;
			$user->save();

			// If single login is enabled, delete all other sessions
			if ( setting( 'userSingleLogin' ) ) {
				DB::select( 'delete from session where id != ?', [ session()->getId() ] );
			}

			// Add a history entry
			//auth()->user()->addHistoryEntry( 'Successful logon' );

			// Check if the user's account is active
			if ( !auth()->user()->enabled ) {
				auth()->logout();
				return jsonResponse([ 'success' => false, 'message' => '<strong>Sorry, your account has been disabled.</strong>' ]);
			}

			// Update the user's last logon time
			auth()->user()->last_logon = Carbon::now();
			auth()->user()->save();

			// Retrieve and clear the redirection URL
			$redirect = $request->session()->get( 'url.intended', url( '/' ) );
			$request->session()->forget( 'url.intended' );

			// If the HTTP referer is a page on this site, use that for redirect
			if ( session()->has( 'userLoginReferer' ) ) {
				$redirect = session()->get( 'userLoginReferer' );
			}

			// If there is an intended URL, use that for redirect
			if ( session()->has( 'userLoginRedirect' ) ) {
				$redirect = session()->get( 'userLoginRedirect' );
			}

			// Add a global flash alert
			addGlobalFlashAlert( '<strong>You have been logged in to your account.</strong>', 'success', true );

			return jsonResponse([ 'success' => true, 'redirect' => $redirect ]);

		}

		// !Change Password

		// ********************************************************************************
		// Function: getPassword()
		// --------------------------------------------------------------------------------
		// Change your password page.
		// ********************************************************************************

		public function getPassword( Request $request ) {
			return view( 'user.password' );
		}

		// ********************************************************************************
		// Function: postPassword()
		// --------------------------------------------------------------------------------
		// Process and AJAX request to change the user's password.
		// ********************************************************************************

		public function postPassword( UserPasswordRequest $request ) {

			// Make sure the user is permitted to change their password
			if ( !auth()->user()->canChangePassword() ) {
				return jsonResponse([ 'success' => false, 'message' => 'You can only change your password once every ' . setting( 'userPasswordAgeMin' ) . ' days.' ]);
			}

			if ( auth()->validate([ 'email' => auth()->user()->email, 'password' => $request->input( 'password' ) ]) ) {
				
				// Make sure the password doesn't match a previous password
				if ( auth()->user()->matchesPreviousPassword( $request->input( 'newPassword' ) ) ) {
					return jsonResponse([ 'success' => false, 'message' => '<strong>You cannot re-use one of your previous passwords.<strong>' ]);
				}

				// Set the password
				auth()->user()->password = Hash::make( $request->input( 'newPassword' ) );
				auth()->user()->save();

				// Return a success response
				return jsonResponse([ 'success' => true, 'message' => '<strong>Your password was successfully changed.</strong>' ]);

			}

			// Return a success response
			return jsonResponse([ 'success' => false, 'message' => '<strong>The old password you entered does not match the password on your account.<strong>' ]);

		}

		// !Reset Password

		// ********************************************************************************
		// Function: getReset()
		// --------------------------------------------------------------------------------
		// Reset your password page.
		// ********************************************************************************

		public function getReset( $code = null ) {

			if ( !is_null( $code ) ) {

				// Retrieve the details of the logged-on user
				if ( $user = User::where( 'reset_password_code', $code )->first() ) {

					if ( $user->reset_password_code_expires >= Carbon::now() ) {
						return view( 'user.reset.complete' );
					}

					// The code has expired, so clear it
					$user->reset_password_code = null;
					$user->reset_password_code_expires = null;
					$user->save();

					return view( 'user.reset.invalid' );

				}

				// The code is invalid or expired
				else{
					return view( 'user.reset.invalid' );
				}

			}

			else {
				return view( 'user.reset' );
			}

		}

		// ********************************************************************************
		// Function: postReset()
		// --------------------------------------------------------------------------------
		// Process an AJAX reset password request.
		// ********************************************************************************

		public function postReset( UserResetRequest $request, $code = null ) {

			if ( !is_null( $code ) ) {

				// Retrieve the details of the logged-on user
				if ( $user = User::where( 'email', $request->input( 'email' ) )->where( 'reset_password_code', $code )->first() ) {

					// Make sure the password doesn't match a previous password
					if ( $user->matchesPreviousPassword( $request->input( 'password' ) ) ) {
						return jsonResponse([ 'success' => false, 'message' => '<strong>You cannot re-use one of your previous passwords.<strong>' ]);
					}

					try {
						
						// Save the user's new password
						$user->password = Hash::make( $request->input( 'password' ) );
//						$user->password_last_changed = Carbon::now();
//						$user->password_expires = Carbon::now()->addDays( Config::get( 'auth.password.expire' ) );
						$user->reset_password_code = null;
						$user->save();
	
						// Log the user on
						auth()->loginUsingId( $user->id );
	
						addGlobalFlashAlert( '<strong>Your password was successfully changed. You are now logged on.</strong>', 'success', true );
	
						// Send a success response
						return jsonResponse([ 'success' => true, 'redirect' => '/' ]);

					}
					
					catch ( Exception $e ) {
						Log::error( 'Error while setting user password after reset: ' . $e->getMessage() );
						return jsonResponse([ 'success' => false, 'message' => '<strong>There was an error resetting your password.</strong>' ]);
					}

				}

				return jsonResponse([ 'success' => false, 'message' => '<strong>The supplied password reset token does not match your email address.</strong>' ]);

			}

			else {

				// Retrieve the details of the logged-on user
				if ( $user = User::where( 'email', $request->input( 'email' ) )->first() ) {

					// Send the user a password reset mail message
					$user->sendPasswordResetMail();

					// Send a success response
					return jsonResponse([ 'success' => true, 'message' => '<strong>Please check your email for instructions on completing your password reset.</strong>' ]);

				}

				return jsonResponse([ 'success' => false, 'message' => '<strong>There is no account registered with that email address.</strong>' ]);

			}

		}

		// !Sign Up

		// ********************************************************************************
		// Function: getSignup()
		// --------------------------------------------------------------------------------
		// Sign up for a new account page.
		// ********************************************************************************

		public function getSignup() {
			error_reporting(E_ALL);
			return view( 'user.signup' );
		}

		// ********************************************************************************
		// Function: postSignup()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to create a new user account.
		// ********************************************************************************

		public function postSignup( UserSignupRequest $request ) {

			// Check if the user's account already exists
			if ( $user = User::where( 'email', $request->input( 'email' ) )->first() ) {

				// If the account is already activated, then the user is attempting to sign up an existing account.
				if ( $user->isActivated() ) {
					return jsonResponse([ 'success' => false, 'message' => "<strong>Sorry, We already have an account registered with the e-mail address of '{$request->input( 'email' )}'.</strong><br />If this is your account, you can <a href='" . route('user.logon' ) . "'>log on</a>, or <a href='" . route('user.reset' ) . "'>reset your password</a>." ]);
				}

				// Resend the activation e-mail
				dispatch( new NewUserAccountJob( $user ) );
				dispatch( new NewUserNotifyJob( $user ) );

				return jsonResponse([ 'success' => true, 'message' => '<strong>Your account has not yet been activated, so we are resending your activation information.</strong> Please refer to your inbox for further instructions.' ]);

			}

			// Activation is required
			if ( setting( 'userActivateEnable' ) ) {

				try {

					// Create the user's account
					$user = new User;
					$user->email = $request->input( 'email' );
					$user->first_name = $request->input( 'firstName' );
					$user->last_name = $request->input( 'lastName' );
					$user->password_expires = Carbon::now();
					$user->activation_code = str_random( 40 );
					$user->save();
	
					// Send a welcome message to the user
					dispatch( new NewUserAccountJob( $user ) );
					dispatch( new NewUserNotifyJob( $user ) );
	
					// Return successfully
					return jsonResponse([ 'success' => true, 'message' => '<strong>Your account was successfully created!</strong> Please refer to the email message we have just sent you with information on activating your account.' ]);

				}

				catch ( Exception $e ) {
					Log::error( 'Error while creating user account: ' . $e->getMessage() );
					return jsonResponse([ 'success' => false, 'message' => '<strong>There was an error creating your account.</strong>' ]);
				}

			}

			// Activation is NOT required
			else {

				try {

					// Make sure a password was included
					if ( !$request->input( 'password' ) ) {
						return jsonResponse([ 'success' => false, 'message' => '<strong>Please correct the errors below.</strong>', 'errors' => [ 'password' => [ 'A password is required' ] ] ]);
					}
	
					// Create the user's account
					$user = new User;
					$user->email = $request->input( 'email' );
					$user->first_name = $request->input( 'firstName' );
					$user->last_name = $request->input( 'lastName' );
					$user->activated = Carbon::now();
					$user->password = Hash::make( $request->input( 'password' ) );
// 					$user->password_expires = 0;
// 					if ( setting( 'userPasswordAgeMax' ) > 0 ) $user->password_expires = Carbon::now()->addDays( setting( 'userPasswordAgeMax' ) );
					$user->save();
	
					// Send a welcome message to the user
					dispatch( new NewUserAccountJob( $user ) );
					dispatch( new NewUserNotifyJob( $user ) );
	
					// Log the user on
					auth()->login( $user );
	
					// Set a global success alert
					addGlobalFlashAlert( '<strong>Thank you for signing up for an account!</strong> You are now logged on.', 'success', true );
	
					// Return successfully
					return jsonResponse([ 'success' => true, 'redirect' => route('home' ) ]);

				}

				catch ( Exception $e ) {
					Log::error( 'Error while creating user account: ' . $e->getMessage() );
					return jsonResponse([ 'success' => false, 'message' => '<strong>There was an error creating your account.</strong>' ]);
				}

			}

		}

	}

?>