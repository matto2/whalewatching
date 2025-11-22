<?php

	namespace App\Models\ACL;

	use Illuminate\Database\Eloquent\Model;

	class RolePermission extends Model {

	    protected $table = 'acl_role_permission';

	    protected $fillable = [ 'acl_role_id', 'acl_permission_id' ];

		// ********************************************************************************
		// Function: permission()
		// --------------------------------------------------------------------------------
		// Returns the permission record for this role permission.
		// ********************************************************************************

		public function permission() {
			return $this->belongsTo( \App\Models\ACL\Permission::class, 'acl_permission_id' );
		}

	}

?>