<?php

	namespace App\Models\Blog;

	use Illuminate\Database\Eloquent\Model;

	class BlogEntryCategory extends Model {

	    protected $table = 'blog_entry_category';
	    protected $fillable = [ 'blog_entry_id', 'blog_category_id' ];

		// ********************************************************************************
		// Function: entries()
		// --------------------------------------------------------------------------------
		// Retrieve all blog entries in this category.
		// ********************************************************************************

		public function entries() {
			return $this->hasMany( 'App\Models\Blog\BlogEntry' );
		}

		// ********************************************************************************
		// Function: category()
		// --------------------------------------------------------------------------------
		// Retrieve the category record.
		// ********************************************************************************

		public function category() {
			return $this->belongsTo( 'App\Models\Blog\BlogCategory', 'blog_category_id' );
		}

	}

?>