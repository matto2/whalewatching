<?php

	namespace App\Models\Blog;

	use Illuminate\Database\Eloquent\Model;

	class BlogCategory extends Model {

	    protected $table = 'blog_category';
	    protected $fillable = [ 'name', 'active' ];

		// ********************************************************************************
		// Function: entries()
		// --------------------------------------------------------------------------------
		// Retrieve all blog entries in this category.
		// ********************************************************************************

		public function entries() {

			if ( auth()->check() ) {
				return BlogEntry::whereHas( 'categories', function( $query ) {
					$query->where( 'blog_category_id', $this->id );
				});
			}

			else {
				return BlogEntry::where( 'restricted', 0 )->whereHas( 'categories', function( $query ) {
					$query->where( 'blog_category_id', $this->id );
				});
			}

		}

	}

?>