<?php

	namespace App\Models\Blog;

	use Illuminate\Database\Eloquent\Model;

	class BlogEntryComment extends Model {

	    protected $table = 'blog_entry_comment';
	    protected $fillable = [ 'parent_comment_id', 'blog_entry_id', 'user_id', 'comment' ];

		// ********************************************************************************
		// Function: entries()
		// --------------------------------------------------------------------------------
		// Retrieve all blog entries in this category.
		// ********************************************************************************

		public function entries() {
			return $this->hasMany( \App\Models\Content\BlogEntry::class );
		}

		// ********************************************************************************
		// Function: entries()
		// --------------------------------------------------------------------------------
		// Retrieve all blog entries in this category.
		// ********************************************************************************

		public function poster() {
			return $this->belongsTo( \App\Models\User\User::class, 'user_id' );
		}

	}

?>