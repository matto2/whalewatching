<?php

	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateUserTables extends Migration {

		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {

			// ********************************************************************************
			// Access Control Lists
			// --------------------------------------------------------------------------------

			Schema::create( 'acl_permission', function($table) {
				$table->increments( 'id' );
				$table->string( 'name', 255 );
				$table->string( 'identifier', 255 );
				$table->text( 'description' )->nullable();
				$table->timestamps();
			});

			Schema::create( 'acl_role', function($table) {
				$table->increments( 'id' );
				$table->string( 'name', 255 );
				$table->string( 'identifier', 255 );
				$table->text( 'description' )->nullable();
				$table->timestamps();
			});

			Schema::create( 'acl_role_permission', function($table) {
				$table->increments( 'id' );
				$table->integer( 'acl_role_id' )->unsigned();
				$table->integer( 'acl_permission_id' )->unsigned();
				$table->timestamps();
				$table->foreign( 'acl_role_id' )->references( 'id' )->on( 'acl_role' )->onDelete( 'cascade' );
				$table->foreign( 'acl_permission_id' )->references( 'id' )->on( 'acl_permission' )->onDelete( 'cascade' );
			});

			// ********************************************************************************
			// User Accounts
			// --------------------------------------------------------------------------------

			Schema::create( 'user', function($table) {
				$table->increments( 'id' );
				$table->boolean( 'administrator' )->default( false );
				$table->boolean( 'enabled' )->default( true );
				$table->boolean( 'hidden' )->default( false );
				$table->string( 'first_name', 255 );
				$table->string( 'last_name', 255 );
				$table->string( 'email', 255 );
				$table->string( 'password', 255 )->nullable();
				$table->boolean( 'password_never_expires' )->default( false );
				$table->timestamp( 'password_last_changed' )->nullable();
				$table->timestamp( 'password_expires' )->nullable();
				$table->timestamp( 'activated' )->nullable();
				$table->string( 'activation_code', 255 )->nullable();
				$table->string( 'reset_password_code', 255 )->nullable();
				$table->timestamp( 'reset_password_code_expires' )->nullable();
				$table->string( 'remember_token', 100 )->nullable();
				$table->timestamp( 'login_attempt_first' )->nullable();
				$table->timestamp( 'login_attempt_last' )->nullable();
				$table->integer( 'login_attempt_count' )->unsigned()->default( 0 );
				$table->timestamp( 'lockout_until' )->nullable();
				$table->timestamp( 'last_logon' )->nullable();
				$table->timestamp( 'last_active' )->nullable();
				$table->integer( 'created_by' )->unsigned()->default( 0 );
				$table->timestamps();
				$table->unique( 'email' );
			});

			Schema::create( 'user_address', function($table) {
				$table->increments( 'id' );
				$table->integer( 'user_id' )->unsigned();
				$table->string( 'name', 255 );
				$table->boolean( 'default_billing' )->default( false );
				$table->boolean( 'default_shipping' )->default( false );
				$table->string( 'first_name', 255 );
				$table->string( 'last_name', 255 );
				$table->string( 'company_name', 255 )->nullable();
				$table->string( 'street1', 255 );
				$table->string( 'street2', 255 )->nullable();
				$table->string( 'city', 255 );
				$table->integer( 'state' );
				$table->string( 'postal_code', 255 );
				$table->integer( 'country' );
				$table->string( 'phone', 255 );
				$table->timestamps();
				$table->foreign( 'user_id' )->references( 'id' )->on( 'user' )->onDelete( 'cascade' );
				$table->unique([ 'user_id', 'name' ]);
			});

			Schema::create( 'user_meta', function($table) {
				$table->increments( 'id' );
				$table->integer( 'user_id' )->unsigned();
				$table->string( 'key', 255 );
				$table->text( 'value' );
				$table->timestamps();
				$table->foreign( 'user_id' )->references( 'id' )->on( 'user' )->onDelete( 'cascade' );
			});

			Schema::create( 'user_permission', function($table) {
				$table->increments( 'id' );
				$table->integer( 'user_id' )->unsigned();
				$table->integer( 'acl_permission_id' )->unsigned();
				$table->timestamps();
				$table->foreign( 'user_id' )->references( 'id' )->on( 'user' )->onDelete( 'cascade' );
				$table->foreign( 'acl_permission_id' )->references( 'id' )->on( 'acl_permission' )->onDelete( 'cascade' );
				$table->unique([ 'user_id', 'acl_permission_id' ]);
			});

			Schema::create( 'user_role', function($table) {
				$table->increments( 'id' );
				$table->integer( 'user_id' )->unsigned();
				$table->integer( 'acl_role_id' )->unsigned();
				$table->timestamps();
				$table->foreign( 'user_id' )->references( 'id' )->on( 'user' )->onDelete( 'cascade' );
				$table->foreign( 'acl_role_id' )->references( 'id' )->on( 'acl_role' )->onDelete( 'cascade' );
				$table->unique([ 'user_id', 'acl_role_id' ]);
			});

			// ********************************************************************************
			// Accounts
			// --------------------------------------------------------------------------------

			Schema::create( 'account', function($table) {
				$table->increments( 'id' );
				$table->string( 'name', 255 );
				$table->timestamps();
				$table->unique( 'name' );
			});

			Schema::create( 'account_user', function($table) {
				$table->increments( 'id' );
				$table->integer( 'account_id' )->unsigned();
				$table->integer( 'user_id' )->unsigned();
				$table->boolean( 'administrator' )->default( false );
				$table->timestamps();
				$table->foreign( 'account_id' )->references( 'id' )->on( 'account' )->onDelete( 'cascade' );
				$table->foreign( 'user_id' )->references( 'id' )->on( 'user' )->onDelete( 'cascade' );
				$table->unique([ 'account_id', 'user_id' ]);
			});

		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists( 'account_user' );
			Schema::dropIfExists( 'account' );
			Schema::dropIfExists( 'user_role' );
			Schema::dropIfExists( 'user_permission' );
			Schema::dropIfExists( 'user_meta' );
			Schema::dropIfExists( 'user_address' );
			Schema::dropIfExists( 'user' );
			Schema::dropIfExists( 'acl_role_permission' );
			Schema::dropIfExists( 'acl_role' );
			Schema::dropIfExists( 'acl_permission' );

		}

	}

?>