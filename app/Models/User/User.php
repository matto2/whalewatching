<?php

	namespace App\Models\User;

	use Illuminate\Notifications\Notifiable;
	use Illuminate\Foundation\Auth\User as Authenticatable;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Mail;
	use Illuminate\Support\Facades\Route;

	use App\Mail\User\Admin\UserActivateAdminMail;
	use App\Mail\User\Admin\UserActivatedAdminMail;
	use App\Mail\User\Admin\UserPasswordChangedAdminMail;
	use App\Mail\User\Admin\UserResetAdminMail;
	use App\Mail\User\Admin\UserWelcomeAdminMail;
	use App\Mail\User\UserActivateMail;
	use App\Mail\User\UserActivatedMail;
	use App\Mail\User\UserEmailChangedMail;
	use App\Mail\User\UserPasswordChangedMail;
	use App\Mail\User\UserResetMail;
	use App\Mail\User\UserWelcomeMail;
	use App\Models\ACL\Permission;
	use App\Models\ACL\Role;

	use Carbon\Carbon;
	use Hash;

	class User extends Authenticatable {

	    use Notifiable;

		protected $table = 'user';

		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'name', 'email', 'password',
		];

		/**
		 * The attributes that should be hidden for arrays.
		 *
		 * @var array
		 */
		protected $hidden = [
			'password', 'remember_token',
		];

		public function displayName() {
			return "{$this->first_name} {$this->last_name}";
		}

		// !Boot

		// ********************************************************************************
		// Function: boot()
		// --------------------------------------------------------------------------------
		// Set up bindings for when users are created/modified/deleted.
		// ********************************************************************************

		public static function boot() {

			parent::boot();

			// Create payment account token when a user is created
/*
			User::created( function( $user ) {
				$user->braintree_id = Braintree_ClientToken::generate();
				$user->save();
				return( true );
			});
*/

		}

		// ********************************************************************************
		// Function: __get()
		// --------------------------------------------------------------------------------
		// Magic get method for returning cart totals.
		// ********************************************************************************

		public function __get( $attribute ) {

			if ( $attribute === 'billingAddress' ) {
				return $this->billingAddress();
			}

			if ( $attribute === 'shippingAddress' ) {
				return $this->shippingAddress();
			}

			return parent::__get( $attribute );

		}

		// !Access Control Lists

		// ********************************************************************************
		// Function: removeRolePermissions()
		// --------------------------------------------------------------------------------
		// Removes permissions that are included in role memberships.
		// ********************************************************************************

		public function removeRolePermissions() {
			foreach ( $this->roles as $role ) {
				foreach ( $role->role->permissions as $permission ) {
					$this->permissions()->where( 'acl_permission_id', $permission->id )->delete();
				}
			}
		}

		// ********************************************************************************
		// Function: hasPermission()
		// --------------------------------------------------------------------------------
		// Determines if the user has the specified permission.
		// ********************************************************************************

		public function hasPermission( $identifiers ) {

			// If the user is an administrator, always return true
			if ( $this->administrator ) return true;

			// Replace * with % (the SQL wildcard character)
			$identifiers = str_replace( '*', '%', $identifiers );

			// Loop through all comma-separated permission identifiers
			foreach ( explode( ',', $identifiers ) as $identifier ) {

				// Return true if the user has the specified permission
				if ( $permissions = Permission::where( 'id', $identifier )->orWhere( 'identifier', 'like', $identifier )->get() ) {

					foreach ( $permissions as $permission ) {

						if ( $permission->users->where( 'user_id', $this->id )->count() ) {
							return true;
						}

						// Return true if the user has a role with the specified permission
						foreach ( $this->roles as $role ) {
							if ( $role->role->hasPermission( $permission->identifier ) ) return true;
						}

					}

				}

			}

			return false;

		}

		// ********************************************************************************
		// Function: hasRole()
		// --------------------------------------------------------------------------------
		// Determines if the user has the specified role.
		// ********************************************************************************

		public function hasRole( $identifiers ) {

			// If the user is an administrator, always return true
			if ( $this->administrator ) return true;

			// Replace * with % (the SQL wildcard character)
			$identifiers = str_replace( '*', '%', $identifiers );

			// Loop through all comma-separated role identifiers
			foreach ( explode( ',', $identifiers ) as $identifier ) {

				// Return true if the user has the specified role
				if ( $role = Role::where( 'identifier', $identifier )->first() ) {
					if ( $role->users->where( 'user_id', $this->id )->count() ) {
						return true;
					}
				}

			}

			return false;

		}

		// ********************************************************************************
		// Function: hasRolePermission()
		// --------------------------------------------------------------------------------
		// Determines if the user has the specified permission via a role.
		// ********************************************************************************

		public function hasRolePermission( $identifiers ) {

			// If the user is an administrator, always return true
			if ( $this->administrator ) return true;

			// Replace * with % (the SQL wildcard character)
			$identifiers = str_replace( '*', '%', $identifiers );

			// Loop through all comma-separated role identifiers
			foreach ( explode( ',', $identifiers ) as $identifier ) {

				foreach ( $this->roles as $role ) {
					if ( $role->role->hasPermission( $identifier ) ) return true;
				}

			}

			return false;

		}

		// ********************************************************************************
		// Function: permissions()
		// --------------------------------------------------------------------------------
		// Returns the user's ACL permission records.
		// ********************************************************************************

		public function permissions() {
			return $this->hasMany( \App\Models\User\UserPermission::class );
		}

		// ********************************************************************************
		// Function: roles()
		// --------------------------------------------------------------------------------
		// Returns the user's ACL role records.
		// ********************************************************************************

		public function roles() {
			return $this->hasMany( \App\Models\User\UserRole::class );
		}

		// !Activation

		// ********************************************************************************
		// Function: activate()
		// --------------------------------------------------------------------------------
		// Activate the user's account.
		// ********************************************************************************

		public function activate( $notify = true ) {

			if ( !$this->isActivated() ) {

				$this->activated = Carbon::now();
				$this->activation_code = null;
				$this->save();

				$data = array( 'user' => $this->toArray() );

				// Send a account activated welcome message to the user
				if ( $notify ) {

					if ( auth()->check() && auth()->user()->administrator ) {
						Mail::to( $this->email )->queue( new UserActivatedAdminMail( $this ) );
					}

					else {
						Mail::to( $this->email )->queue( new UserActivatedMail( $this ) );
					}

				}

			}

		}

		// ********************************************************************************
		// Function: getActivationCode()
		// --------------------------------------------------------------------------------
		// Generates and returns an activation code.
		// ********************************************************************************

		public function getActivationCode() {

			if ( !$this->isActivated() ) {

				$this->activated = false;
				$this->activation_code = str_random( 40 );
				$this->save();
				return( $this->activation_code );

			}

			return( false );

		}

		// ********************************************************************************
		// Function: isActivated()
		// --------------------------------------------------------------------------------
		// Checks if the user's account has been activated.
		// ********************************************************************************

		public function isActivated() {
			if ( !$this->activated || $this->activated == '0000-00-00 00:00:00' ) return( false );
			return( true );
		}

		// ********************************************************************************
		// Function: sendAdminNewUserMail()
		// --------------------------------------------------------------------------------
		// Sends the new user admin notification mail.
		// ********************************************************************************

		public function sendAdminNewUserMail() {
//			if ( config( 'userEmailAdminNotifyEnable' ) {
//				Mail::to( $this->email )->queue( new UserWelcomeAdminMail( $this ) );
//			}
		}

		// ********************************************************************************
		// Function: sendActivationMail()
		// --------------------------------------------------------------------------------
		// Sends the user's activation email message, if they are not yet activated.
		// ********************************************************************************

		public function sendActivationMail() {
			if ( !$this->isActivated() ) {
				if ( auth()->check() && auth()->user()->administrator ) {
					Mail::to( $this->email )->queue( new UserActivateAdminMail( $this ) );
				}
				else {
					Mail::to( $this->email )->queue( new UserActivateMail( $this ) );
				}
			}
		}

		// ********************************************************************************
		// Function: sendWelcomeMail()
		// --------------------------------------------------------------------------------
		// Sends the user's welcome message.
		// ********************************************************************************

		public function sendWelcomeMail() {
			if ( $this->isActivated() ) {
				if ( auth()->check() && auth()->user()->administrator ) {
					Mail::to( $this->email )->queue( new UserWelcomeAdminMail( $this ) );
				}
				else {
					Mail::to( $this->email )->queue( new UserWelcomeMail( $this ) );
				}
			}
			else {
				$this->sendActivationMail();
			}
		}

		// !Addresses

		// ********************************************************************************
		// Function: addresses()
		// --------------------------------------------------------------------------------
		// Retrieve all of the user's addresses.
		// ********************************************************************************

		public function addresses() {
			return $this->hasMany( 'App\Models\User\UserAddress', 'user_id', 'id' );
		}

		// ********************************************************************************
		// Function: billingAddress()
		// --------------------------------------------------------------------------------
		// Retrieve the user's default billing address.
		// ********************************************************************************

		public function billingAddress() {
			return $this->addresses->where( 'default_billing', true )->first();
		}

		// ********************************************************************************
		// Function: billingAddress()
		// --------------------------------------------------------------------------------
		// Retrieve the user's default billing address.
		// ********************************************************************************

		public function shippingAddress() {
			return $this->addresses->where( 'default_shipping', true )->first();
		}

		// !E-mail Address

		// ********************************************************************************
		// Function: setEmailAttribute()
		// --------------------------------------------------------------------------------
		// Send an email to the user when their e-mail address is changed.
		// ********************************************************************************

		public function setEmailAttribute( $value ) {

			if ( array_key_exists( 'email', $this->attributes ) && $this->email != $value ) {

				// An administrator has changed this user's password
				if ( auth()->check() && auth()->user()->administrator && auth()->user()->id != $this->id && setting( 'userEmailChangedEmailAdminEnable' ) ) {

					// Send an e-mail changed message to the old e-mail address
					Mail::to( $this->email )->queue( new UserAdminEmailChangedMail( $this, $value ) );

					// Send an e-mail changed message to the new e-mail address
					Mail::to( $value )->queue( new UserAdminEmailChangedMail( $this, $value ) );

				}

				// The user has changed their own password
				elseif ( setting( 'userEmailChangedEmailEnable' ) ) {

					// Send an e-mail changed message to the old e-mail address
					Mail::to( $this->email )->queue( new UserEmailChangedMail( $this, $value ) );

					// Send an e-mail changed message to the new e-mail address
					Mail::to( $value )->queue( new UserEmailChangedMail( $this, $value ) );

				}

			}

			// Store the new e-mail address
			$this->attributes['email'] = $value;

		}

		// !Passwords

		// ********************************************************************************
		// Function: canChangePassword()
		// --------------------------------------------------------------------------------
		// Checks if the user can change their password.
		// ********************************************************************************

		public function canChangePassword() {
			if ( setting( 'userPasswordAgeMin' ) == 0 ) return true;
			if ( $this->password_last_changed == null ) return true;
			if ( Carbon::now() >= Carbon::parse($this->password_last_changed)->addDays( setting( 'userPasswordAgeMin' ) ) ) return true;
			return false;
		}

		// ********************************************************************************
		// Function: expirePassword()
		// --------------------------------------------------------------------------------
		// Set the user's password as expired.
		// ********************************************************************************

		public function expirePassword() {
			$this->password_expires = Carbon::now();
			$this->save();
		}

		// ********************************************************************************
		// Function: matchesPreviousPassword()
		// --------------------------------------------------------------------------------
		// Checks if the given password matches the user's current or previous passwords.
		// ********************************************************************************

		public function matchesPreviousPassword( $password ) {

			// Check if the specified passwords matches the user's current password
			if ( Hash::check( $password, $this->password ) ) return true;

			// Check if the specified passwords matches one of the user's previous passwords
			if ( setting( 'userPasswordRemember' ) > 0 ) {

				// Retrieve the user's previous passwords
				if ( $meta = $this->meta()->where( 'key', 'userPasswordRemember' )->first() ) {

					if ( is_array( $previousPasswords = unserialize( $meta->value ) ) ) {
						foreach ( $previousPasswords as $previousPassword ) {
							if ( Hash::check( $password, $previousPassword ) ) return true;
						}
					}

				}

			}

			// No match, so return false
			return false;

		}

		// ********************************************************************************
		// Function: sendPasswordResetMail()
		// --------------------------------------------------------------------------------
		// Send the user a password reset e-mail message.
		// ********************************************************************************

		public function sendPasswordResetMail() {

			// Generate a password reset code
			$this->reset_password_code = str_random( 40 );
			$this->reset_password_code_expires = Carbon::now()->addDays( 1 );
			$this->save();

			// Send a password reset message to the user
			if ( auth()->check() && auth()->user()->administrator ) {
				Mail::to( $this->email )->queue( new UserResetAdminMail( $this ) );
			}

			else {
				Mail::to( $this->email )->queue( new UserResetMail( $this ) );
			}

		}

		// ********************************************************************************
		// Function: setPasswordAttribute()
		// --------------------------------------------------------------------------------
		// Send an email to the user when their password is changed.
		// ********************************************************************************

		public function setPasswordAttribute( $value ) {

			if ( array_key_exists( 'password', $this->attributes ) ) {

				// Send a password changed email to the user only if they have never changed their password before
				if ( $this->attributes['password_last_changed'] != null ) {

					$data = array( 'user' => $this->toArray() );

					// An administrator has changed this user's password
					if ( auth()->check() && auth()->user()->administrator && auth()->user()->id != $this->id && setting( 'userPasswordChangedEmailAdminEnable' ) ) {
						Mail::to( $this->email )->queue( new UserPasswordChangedAdminMail( $this ) );
					}

					// The user has changed their own password
					elseif ( setting( 'userPasswordChangedEmailEnable' ) ) {
						Mail::to( $this->email )->queue( new UserPasswordChangedMail( $this ) );
					}

				}

			}

			// Encrypt and store the password
			$this->attributes['password'] = $value;

			// Update the password expiration
			$this->attributes['password_expires'] = null;
			if ( array_key_exists( 'password_never_expires', $this->attributes ) && !$this->attributes['password_never_expires'] && setting( 'userPasswordAgeMax' ) > 0 ) {
				$this->attributes['password_expires'] = Carbon::now()->addDays( setting( 'userPasswordAgeMax' ) );
			}

			// Set the password last changed date to now
			$this->attributes['password_last_changed'] = Carbon::now();

			if ( setting( 'userPasswordRemember' ) > 0 ) {

				// Retrieve the user's previous passwords
				if ( $meta = $this->meta()->where( 'key', 'userPasswordRemember' )->first() ) {

					if ( is_array( $previousPasswords = unserialize( $meta->value ) ) ) {

						$previousPasswords[] = $this->password;

						if ( count( $previousPasswords ) > setting( 'userPasswordRemember' ) ) {
							array_shift( $previousPasswords );
						}

						// Save the previous passwords
						$this->meta()->where( 'key', 'userPasswordRemember' )->update([ 'value' => serialize( $previousPasswords ) ]);

					}

				}

				else {
					$meta = new UserMeta();
					$meta->key = 'userPasswordRemember';
					$meta->value = serialize([ $this->password ]);
					$this->meta()->save( $meta );
				}

			}

		}

        // !Routes

		// ********************************************************************************
		// Function: routes()
		// --------------------------------------------------------------------------------
		// Create all user frontend and backend routes.
		// ********************************************************************************

        public static function routes() {
            
            // --------------------------------------------------------------------------------
            // User administration routes

            Route::group( [ 'prefix' => 'admin/user' ], function( $router ) {

                Route::post( 'activate/{id}', [ 'as' => 'admin.user.activate', 'uses' => 'Admin\UserController@postActivate'] );

                // Add a new user account
                Route::get( 'add', [ 'as' => 'admin.user.add', 'uses' => 'Admin\UserController@getAdd'] );
                Route::post( 'add', [ 'as' => 'admin.user.add', 'uses' => 'Admin\UserController@postAdd'] );

                // User authentication settings
                Route::get( 'settings', [ 'as' => 'admin.user.settings', 'uses' => 'Admin\UserController@getSettings'] );
                Route::post( 'settings', [ 'as' => 'admin.user.settings', 'uses' => 'Admin\UserController@postSettings'] );

                // Modify user routes
                Route::group( [ 'prefix' => '{id}' ], function( $router ) {

                    // Delete user account
                    Route::post( 'delete', [ 'as' => 'admin.user.delete', 'uses' => 'Admin\UserController@postDelete'] );

                    // Disable & Enable user account
                    Route::post( 'disable', [ 'as' => 'admin.user.disable', 'uses' => 'Admin\UserController@postDisable'] );
                    Route::post( 'enable', [ 'as' => 'admin.user.enable', 'uses' => 'Admin\UserController@postEnable'] );

                    // User orders
                    Route::get( 'orders', [ 'as' => 'admin.user.orders', 'uses' => 'Admin\UserController@getUserOrders'] );

                    // User access rights
                    Route::get( 'roles', [ 'as' => 'admin.user.roles', 'uses' => 'Admin\UserController@getUserRoles'] );
                    Route::get( 'permissions', [ 'as' => 'admin.user.permissions', 'uses' => 'Admin\UserController@getUserPermissions'] );

                    // Set user password
                    Route::post( 'password', [ 'as' => 'admin.user.password', 'uses' => 'Admin\UserController@postPassword'] );

                    // View an existing user
                    Route::get( '/', [ 'as' => 'admin.user.view', 'uses' => 'Admin\UserController@getView'] );
                    Route::post( '/', [ 'as' => 'admin.user.view', 'uses' => 'Admin\UserController@postView'] );

                    // User address routes
                    Route::group( [ 'prefix' => 'address' ], function( $router ) {

                        // Add a new address
                        Route::get( 'add', [ 'as' => 'admin.user.address.add', 'uses' => 'Admin\User\AddressController@getAdd'] );
                        Route::post( 'add', [ 'as' => 'admin.user.address.add', 'uses' => 'Admin\User\AddressController@postAdd'] );

                        Route::group( [ 'prefix' => '{address}' ], function( $router ) {

                            // Delete an address
                            Route::post( 'delete', [ 'as' => 'admin.user.address.delete', 'uses' => 'Admin\User\AddressController@postDelete'] );

                            // View/edit an address
                            Route::get( '/', [ 'as' => 'admin.user.address.view', 'uses' => 'Admin\User\AddressController@getView'] );
                            Route::post( '/', [ 'as' => 'admin.user.address.view', 'uses' => 'Admin\User\AddressController@postView'] );

                        });

                    });

                });

                Route::get( '/', [ 'as' => 'admin.user', 'uses' => 'Admin\UserController@getIndex'] );

            });

            // --------------------------------------------------------------------------------
            // User front-end routes

            Route::group( [ 'prefix' => 'user' ], function( $router ) {

                // User is disabled
                Route::get( 'disabled', [ 'as' => 'user.disabled', 'uses' => 'UserController@getDisabled' ] );

                // Log off
                Route::get( 'logout', [ 'as' => 'user.logout', 'uses' => 'UserController@getLogout' ] );
                Route::post( 'logout', [ 'as' => 'user.logout', 'uses' => 'UserController@postLogout' ] );

                // Routes valid only when the user is not logged on
                Route::group( [ 'middleware' => '\App\Http\Middleware\RedirectIfAuthenticated' ], function( $router ) {

                    // Activate account
                    Route::get( 'activate/{code?}', [ 'as' => 'user.activate', 'uses' => 'UserController@getActivate' ] );
                    Route::post( 'activate/{code?}', [ 'as' => 'user.activate', 'uses' => 'UserController@postActivate' ] );

                    // Log on to an existing account
                    Route::get( 'login', [ 'as' => 'user.login', 'uses' => 'UserController@getLogin' ] );
                    Route::post( 'login', [ 'as' => 'user.login', 'uses' => 'UserController@postLogin' ] );

                    // Reset password
                    Route::get( 'reset/{code?}', [ 'as' => 'user.reset', 'uses' => 'UserController@getReset' ] );
                    Route::post( 'reset/{code?}', [ 'as' => 'user.reset', 'uses' => 'UserController@postReset' ] );

                    // Sign up for a new account
                    Route::get( 'signup', [ 'as' => 'user.signup', 'uses' => 'UserController@getSignup' ] );
                    Route::post( 'signup', [ 'as' => 'user.signup', 'uses' => 'UserController@postSignup' ] );

                });

                // Routes that require authentication
                Route::group( [ 'middleware' => '\App\Http\Middleware\Authenticate' ], function( $router ) {

                    // User address routes
                    Route::group( [ 'prefix' => 'address' ], function( $router ) {

                        // Add an address page
                        Route::get( 'add', [ 'as' => 'user.address.add', 'uses' => 'User\AddressController@getAdd'] );
                        Route::post( 'add', [ 'as' => 'user.address.add', 'uses' => 'User\AddressController@postAdd'] );

                        // Set defaults
                        Route::post( 'defaultBilling/{id?}', [ 'as' => 'user.address.defaultBilling', 'uses' => 'User\AddressController@postDefaultBilling'] );
                        Route::post( 'defaultShipping/{id?}', [ 'as' => 'user.address.defaultShipping', 'uses' => 'User\AddressController@postDefaultShipping'] );

                        // Delete an address
                        Route::post( 'delete/{id?}', [ 'as' => 'user.address.delete', 'uses' => 'User\AddressController@postDelete'] );

                        // Edit an address page
                        Route::get( '{id}/edit', [ 'as' => 'user.address.edit', 'uses' => 'User\AddressController@getEdit'] );
                        Route::post( '{id}/edit', [ 'as' => 'user.address.edit', 'uses' => 'User\AddressController@postEdit'] );

                        // View an address page
                        Route::get( '{id}', [ 'as' => 'user.address.view', 'uses' => 'User\AddressController@getView'] );
                        Route::post( '{id}', [ 'as' => 'user.address.view', 'uses' => 'User\AddressController@postView'] );

                        // Main user address page
                        Route::get( '/', [ 'as' => 'user.address', 'uses' => 'User\AddressController@getIndex'] );
                        Route::post( '/', [ 'as' => 'user.address', 'uses' => 'User\AddressController@postIndex'] );

                    });

                    // Sales routes
                    Route::group( [ 'prefix' => 'sales' ], function( $router ) {

                        Route::group( [ 'prefix' => 'order' ], function( $router ) {

                            // View user order page
                            Route::get( '{id}', [ 'as' => 'user.sales.order.view', 'uses' => 'User\Sales\OrderController@getView'] );

                            // Main user order page
                            Route::get( '/', [ 'as' => 'user.sales.order', 'uses' => 'User\Sales\OrderController@getIndex'] );

                        });

                    });

                    // Change e-mail address
                    Route::get( 'email', [ 'as' => 'user.email', 'uses' => 'UserController@getEmail' ] );
                    Route::post( 'email', [ 'as' => 'user.email', 'uses' => 'UserController@postEmail' ] );

                    // Password expired
                    Route::get( 'expired', [ 'as' => 'user.expired', 'uses' => 'UserController@getExpired' ] );
                    Route::post( 'expired', [ 'as' => 'user.expired', 'uses' => 'UserController@postExpired' ] );

                    // Change password
                    Route::get( 'password', [ 'as' => 'user.password', 'uses' => 'UserController@getPassword' ] );
                    Route::post( 'password', [ 'as' => 'user.password', 'uses' => 'UserController@postPassword' ] );

                    // Main user profile page
                    Route::get( '/', [ 'as' => 'user', 'uses' => 'UserController@getIndex' ] );

                });

            });

        }

        // !Sales

		// ********************************************************************************
		// Function: orders()
		// --------------------------------------------------------------------------------
		// Returns all of the user's orders.
		// ********************************************************************************

		public function orders() {
			return $this->hasMany( \App\Models\Sales\Order\Order::class );
		}

		// ********************************************************************************
		// Function: quotes()
		// --------------------------------------------------------------------------------
		// Returns all of the user's quotes.
		// ********************************************************************************

		public function quotes() {
			return $this->hasMany( \App\Models\Sales\Quote\Quote::class );
		}

		// !Meta

		// ********************************************************************************
		// Function: meta()
		// --------------------------------------------------------------------------------
		// Retrieve all of the user's meta data.
		// ********************************************************************************

		public function meta( $key = null, $value = null ) {

			if ( is_null( $key ) ) {
				return $this->hasMany( \App\Models\User\UserMeta::class );
			}

			if ( is_null( $value ) ) {
				return $this->meta()->where( 'key', $key )->first();
			}

		}

	}

?>
