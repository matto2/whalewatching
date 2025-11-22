<?php

	namespace App\Models\System;

	use Illuminate\Database\Eloquent\Model;

	class State extends Model {

	    protected $table = 'state';
	    protected $fillable = [ 'name', 'abbreviation', 'tax' ];

		// ********************************************************************************
		// Function: country()
		// --------------------------------------------------------------------------------
		// Retrieve the country this state belongs to.
		// ********************************************************************************

/*
		public function country() {
			return $this->belongsTo( 'App\Models\System\Country', 'country_id', 'id' );
		}
*/

	}

?>