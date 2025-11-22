<?php

	namespace App\Models\User;

	use Illuminate\Database\Eloquent\Model;

	class UserAddress extends Model {

	    protected $table = 'user_address';

	    protected $fillable = [
	    	'name',
	    	'default_billing',
	    	'default_shipping',
	    	'first_name',
	    	'last_name',
	    	'company_name',
	    	'street1',
	    	'street2',
	    	'street3',
	    	'city',
	    	'state',
	    	'postal_code',
	    	'country',
	    	'phone'
	    ];

		// ********************************************************************************
		// Function: setDefaultBilling()
		// --------------------------------------------------------------------------------
		// Set this address as the default billing address.
		// ********************************************************************************

		public function seetDefaultBilling() {
			Auth::user()->addresses()->where( 'default_billing', 1 )->update( 'default_billing', 0 );
			$this->default_billing = true;
			$this->save();
		}

		// ********************************************************************************
		// Function: seetDefaultShipping()
		// --------------------------------------------------------------------------------
		// Set this address as the default shipping address.
		// ********************************************************************************

		public function seetDefaultShipping() {
			Auth::user()->addresses()->where( 'default_shipping', 1 )->update( 'default_shipping', 0 );
			$this->default_shipping = true;
			$this->save();
		}

	}

?>