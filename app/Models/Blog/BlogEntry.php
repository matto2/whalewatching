<?php

	namespace App\Models\Blog;

	use Illuminate\Database\Eloquent\Model;

	class BlogEntry extends Model {

	    protected $table = 'blog_entry';
	    protected $fillable = [ 'blog_id', 'user_id', 'name', 'slug', 'url', 'active', 'restricted', 'allow_comments', 'content' ];

		// ********************************************************************************
		// Function: blog()
		// --------------------------------------------------------------------------------
		// Retrieve the blog this entry belongs to.
		// ********************************************************************************

		public function blog() {
			return $this->belongsTo( \App\Models\Blog\Blog::class );
		}

		// ********************************************************************************
		// Function: categories()
		// --------------------------------------------------------------------------------
		// Retrieve all categories for this blog entry.
		// ********************************************************************************

		public function categories() {
			return $this->hasMany( \App\Models\Blog\BlogEntryCategory::class );
		}

		public function categoryLink( $prefix = null ) {

			$result = '';

			foreach ( $this->categories as $category ) {

				if ( @$category->category->name ) {
					$result .= "<a href='" . route( "blog.{$this->blog->slug}.category.view", [ $this->blog_id, $category->category->slug ] ) . "'>{$category->category->name}</a>, ";
				}

			}

			if ( strlen( $result ) ) {
				$result = substr( $result, 0, strlen( $result ) - 2 );
				return "{$prefix}{$result}";
			}

			return null;

		}

		// ********************************************************************************
		// Function: comments()
		// --------------------------------------------------------------------------------
		// Retrieve all comments for this blog entry.
		// ********************************************************************************

		public function comments() {
			return $this->hasMany( \App\Models\Blog\BlogEntryComment::class );
		}

		// ********************************************************************************
		// Function: route()
		// --------------------------------------------------------------------------------
		// Return the route to view this entry.
		// ********************************************************************************

		public function route( $admin = false ) {
			if ( $admin ) return route( 'admin.blog.entry.view', [ $this->blog_id, $this->id ] );
			return route( "blog.{$this->blog->slug}.view", $this->slug );
		}

		// ********************************************************************************
		// Function: poster()
		// --------------------------------------------------------------------------------
		// Retrieve the user account of the poster.
		// ********************************************************************************

		public function poster() {
			return $this->belongsTo( \App\Models\User\User::class, 'user_id' );
		}

	}

?>