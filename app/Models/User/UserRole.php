<?php

	namespace App\Models\User;

	use Illuminate\Database\Eloquent\Model;

	class UserRole extends Model {

	    protected $table = 'user_role';

	    protected $fillable = [ 'user_id', 'acl_role_id', ];

		// ********************************************************************************
		// Function: role()
		// --------------------------------------------------------------------------------
		// Returns the ACL role record.
		// ********************************************************************************

		public function role() {
			return $this->belongsTo( \App\Models\ACL\Role::class, 'acl_role_id' );
		}

	}

?>