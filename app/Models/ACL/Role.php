<?php

	namespace App\Models\ACL;

	use App\Models\ACL\Permission;
	use Illuminate\Database\Eloquent\Model;

	class Role extends Model {

	    protected $table = 'acl_role';

	    protected $fillable = [ 'name', 'identifier', 'description' ];

		// ********************************************************************************
		// Function: hasPermission()
		// --------------------------------------------------------------------------------
		// Determines if this role has the specified permission.
		// ********************************************************************************

		public function hasPermission( $identifiers ) {

			// If the user is an administrator, always return true
			if ( $this->administrator ) return true;

			// Replace * with % (the SQL wildcard character)
			$identifiers = str_replace( '*', '%', $identifiers );

			// Loop through all comma-separated role identifiers
			foreach ( explode( ',', $identifiers ) as $identifier ) {

				foreach ( Permission::where( 'identifier', 'like', $identifier )->get() as $permission ) {
					if ( $permission->roles()->where( 'acl_role_id', $this->id )->count() ) return true;
				}

			}

			return false;

		}

		// ********************************************************************************
		// Function: permissions()
		// --------------------------------------------------------------------------------
		// Returns the permissions included in this role.
		// ********************************************************************************

		public function permissions() {
			return $this->hasMany( \App\Models\ACL\RolePermission::class, 'acl_role_id' );
		}

		public function permissionString() {

			$result = [];

			foreach ( $this->permissions as $permission ) {
				$result[] = "{$permission->permission->identifier}";
			}

			return implode( ',', $result );

		}

		// ********************************************************************************
		// Function: users()
		// --------------------------------------------------------------------------------
		// Returns the user accounts with this permission.
		// ********************************************************************************

		public function users() {
			return $this->hasMany( \App\Models\User\UserRole::class, 'acl_role_id' );
		}

	}

?>