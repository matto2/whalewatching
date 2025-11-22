<?php

	namespace App\Models\ACL;

	use Illuminate\Database\Eloquent\Model;

	class Permission extends Model {

	    protected $table = 'acl_permission';

	    protected $fillable = [ 'name', 'identifier', 'description' ];

		// ********************************************************************************
		// Function: roles()
		// --------------------------------------------------------------------------------
		// Returns the roles to which this permissions belongs.
		// ********************************************************************************

		public function roles() {
			return $this->hasMany( \App\Models\ACL\RolePermission::class, 'acl_permission_id' );
		}

		// ********************************************************************************
		// Function: users()
		// --------------------------------------------------------------------------------
		// Returns the user accounts with this permission.
		// ********************************************************************************

		public function users() {
			return $this->hasMany( \App\Models\User\UserPermission::class, 'acl_permission_id' );
		}

	}

?>