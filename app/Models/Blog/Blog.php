<?php

	namespace App\Models\Blog;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Support\Facades\Route;

	class Blog extends Model {

	    protected $table = 'blog';
	    protected $fillable = [ 'name', 'slug', 'active' ];

		// ********************************************************************************
		// Function: categories()
		// --------------------------------------------------------------------------------
		// Retrieve all categories for this blog entry.
		// ********************************************************************************

		public function categories() {
			return $this->hasMany( \App\Models\Blog\BlogCategory::class );
		}

		// ********************************************************************************
		// Function: entries()
		// --------------------------------------------------------------------------------
		// Retrieve all categories for this blog entry.
		// ********************************************************************************

		public function entries() {
			return $this->hasMany( \App\Models\Blog\BlogEntry::class );
		}

		// ********************************************************************************
		// Function: categories()
		// --------------------------------------------------------------------------------
		// Retrieve all categories for this blog entry.
		// ********************************************************************************

		public static function routes() {

			if ( \Schema::hasTable( 'blog' ) ) {

                // Blog admin routes
                Route::group( [ 'prefix' => 'admin/blog' ], function( $router ) {

                    // Add a new blog
                    Route::get( 'add', [ 'as' => 'admin.blog.add', 'uses' => 'Admin\BlogController@getAdd' ] );
                    Route::post( 'add', [ 'as' => 'admin.blog.add', 'uses' => 'Admin\BlogController@postAdd' ] );

                    // Blog settings
                    Route::get( 'settings', [ 'as' => 'admin.blog.settings', 'uses' => 'Admin\BlogController@getSettings' ] );
                    Route::post( 'settings', [ 'uses' => 'Admin\BlogController@postSettings' ] );

                    // Blogs
                    Route::group( [ 'prefix' => '{blog}' ], function( $router ) {

                        // Blog categories
                        Route::group( [ 'prefix' => 'category' ], function( $router ) {

                            // Add a new blog entry category
                            Route::get( 'add', [ 'as' => 'admin.blog.category.add', 'uses' => 'Admin\Blog\CategoryController@getAdd' ] );
                            Route::post( 'add', [ 'as' => 'admin.blog.category.add', 'uses' => 'Admin\Blog\CategoryController@postAdd' ] );

                            // Delete an existing blog entry category
                            Route::post( '{id}/delete', [ 'as' => 'admin.blog.category.delete', 'uses' => 'Admin\Blog\CategoryController@postDelete' ] );

                            // View an existing blog entry category
                            Route::get( '{id}', [ 'as' => 'admin.blog.category.view', 'uses' => 'Admin\Blog\CategoryController@getView' ] );
                            Route::post( '{id}', [ 'as' => 'admin.blog.category.view', 'uses' => 'Admin\Blog\CategoryController@postView' ] );

                            // Main blog entry category admin page
                            Route::get( '/', [ 'as' => 'admin.blog.category', 'uses' => 'Admin\Blog\CategoryController@getIndex' ] );

                        });

                        // Blog entries
                        Route::group( [ 'prefix' => 'entry' ], function( $router ) {

                            // Add a new blog entry
                            Route::get( 'add', [ 'as' => 'admin.blog.entry.add', 'uses' => 'Admin\Blog\EntryController@getAdd' ] );
                            Route::post( 'add', [ 'as' => 'admin.blog.entry.add', 'uses' => 'Admin\Blog\EntryController@postAdd' ] );

                            Route::group( [ 'prefix' => '{id}' ], function( $router ) {

                                // Add a comment
                                Route::post( 'comment/add', [ 'as' => 'admin.blog.entry.comment.add', 'uses' => 'Admin\Blog\EntryController@postCommentAdd' ] );

                                // Delete an existing blog entry
                                Route::post( 'delete', [ 'as' => 'admin.blog.entry.delete', 'uses' => 'Admin\Blog\EntryController@postDelete' ] );

                                // View an existing blog entry
                                Route::get( '/', [ 'as' => 'admin.blog.entry.view', 'uses' => 'Admin\Blog\EntryController@getView' ] );
                                Route::post( '/', [ 'as' => 'admin.blog.entry.view', 'uses' => 'Admin\Blog\EntryController@postView' ] );

                            });

                            // View all existing blog entries
                            Route::get( '/', [ 'as' => 'admin.blog.entry', 'uses' => 'Admin\Blog\EntryController@getIndex' ] );
                            Route::post( '/', [ 'as' => 'admin.blog.entry', 'uses' => 'Admin\Blog\EntryController@postIndex' ] );

                        });

                        // Delete an existing blog
                        Route::post( 'delete', [ 'as' => 'admin.blog.delete', 'uses' => 'Admin\BlogController@postDelete' ] );

                        // Edit an existing blog
                        Route::get( 'edit', [ 'as' => 'admin.blog.edit', 'uses' => 'Admin\BlogController@getEdit' ] );
                        Route::post( 'edit', [ 'as' => 'admin.blog.edit', 'uses' => 'Admin\BlogController@postEdit' ] );

                        // View an existing blog
                        Route::get( '/', [ 'as' => 'admin.blog.view', 'uses' => 'Admin\BlogController@getView' ] );
                        Route::post( '/', [ 'as' => 'admin.blog.view', 'uses' => 'Admin\BlogController@postView' ] );

                    });

                    // Main blog admin page
                    Route::get( '/', [ 'as' => 'admin.blog', 'uses' => 'Admin\BlogController@getIndex' ] );

                });

                foreach ( Blog::where( 'active', 1 )->get() as $blog ) {
					Route::get( "{$blog->slug}/category/{all}", [ 'as' => "blog.{$blog->slug}.category.view", 'uses' => 'BlogController@getCategory' ] );
					Route::get( "{$blog->slug}/{all}", [ 'as' => "blog.{$blog->slug}.view", 'uses' => 'BlogController@getWildcard' ] );
					Route::get( $blog->slug, [ 'as' => "blog.{$blog->slug}", 'uses' => 'BlogController@getIndex' ] );
				}

            }

		}

	}

?>