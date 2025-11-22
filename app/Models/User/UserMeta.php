<?php

	namespace App\Models\User;

	use Illuminate\Database\Eloquent\Model;

	class UserMeta extends Model {

	    protected $table = 'user_meta';

	    protected $fillable = [
	    	'key',
	    	'value',
	    ];

	}

?>