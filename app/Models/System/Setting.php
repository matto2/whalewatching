<?php

	namespace App\Models\System;

	use Illuminate\Database\Eloquent\Model;

	class Setting extends Model {

	    protected $table = 'setting';
	    protected $primaryKey = 'key';
	    public $incrementing = false;
	    protected $fillable = ['key', 'value'];
	    public $timestamps = false;

		public function getValueAttribute( $value ) {
			$value = unserialize( $value );
			return is_array( $value ) ? collect( $value ) : $value;
		}

		public function setValueAttribute( $value ) {
			$this->attributes['value'] = serialize( $value );
		}

	}

?>