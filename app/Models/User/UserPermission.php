<?php

	namespace App\Models\User;

	use Illuminate\Database\Eloquent\Model;

	class UserPermission extends Model {

	    protected $table = 'user_permission';

	    protected $fillable = [ 'user_id', 'acl_permission_id', ];

		// ********************************************************************************
		// Function: permission()
		// --------------------------------------------------------------------------------
		// Returns the ACL permission record.
		// ********************************************************************************

		public function permission() {
			return $this->belongsTo( \App\Models\ACL\Permission::class, 'acl_permission_id' );
		}

	}

?>