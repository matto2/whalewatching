<?php

	namespace App\Models\System;

	use Illuminate\Database\Eloquent\Model;

	class Country extends Model {

	    protected $table = 'country';
	    protected $fillable = [ 'active', 'code', 'name' ];

		// ********************************************************************************
		// Function: addresses()
		// --------------------------------------------------------------------------------
		// Retrieve all of the user's addresses.
		// ********************************************************************************

		public function states() {
			return $this->hasMany( 'App\Models\System\State', 'country_id', 'id' );
		}

	}

?>