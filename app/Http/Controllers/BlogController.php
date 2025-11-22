<?php

	namespace App\Http\Controllers;

	use App\Models\Blog\Blog;
	use App\Models\Blog\BlogCategory;
	use App\Models\Blog\BlogEntry;
	use App\Models\Blog\BlogEntryComment;
	use Illuminate\Http\Request;

	use App\Modules\Payment\Payment;
	
	class BlogController extends Controller {

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// 
		// ********************************************************************************

		public function getIndex( Request $request ) {

			$data = [];

			if ( $data['blog'] = Blog::where( 'slug', $request->path() )->first() ) {

				if ( auth()->check() ) {
					$data['entries'] = $data['blog']->entries()->where( 'active', 1 )->where( 'hidden', 0 )->orderBy( 'created_at', 'desc' )->get();
				}

				else {
					$data['entries'] = $data['blog']->entries()->where( 'active', 1 )->where( 'hidden', 0 )->orderBy( 'created_at', 'desc' )->get();
				}

			}

			// If the user is NOT logged on, do not include restricted entries
			return view( 'blog', $data );

		}

		// ********************************************************************************
		// Function: getWildcard()
		// --------------------------------------------------------------------------------
		// For routes that do not exist, display a view file if one exists.
		// ********************************************************************************

		public function getWildcard( Request $request, $path ) {

			$path = explode( '/', $path );
			if ( !is_array( $path ) ) $path = [ $path ];

			if ( count( $path ) == 1 ) {

				// Check for a matching blog entry
				if ( auth()->check() ) {
					if ( $entry = BlogEntry::where( 'active', 1 )->where( 'slug', $path[0] )->first() ) {
						return view( 'blog.view', [ 'entry' => $entry ] );
					}
				}

				else {
					if ( $entry = BlogEntry::where( 'active', 1 )->where( 'slug', $path[0] )->where( 'restricted', 0 )->first() ) {
						return view( 'blog.view', [ 'entry' => $entry ] );
					}
				}

				// Check for a matching blog category
				if ( $category = BlogCategory::where( 'slug', $path[0] )->first() ) {
					return view( 'blog.category', [ 'category' => $category ] );
				}

			}

			elseif ( count( $path ) == 2 ) {

				// Check for a matching blog entry
				if ( auth()->check() ) {
					if ( $entry = BlogEntry::where( 'active', 1 )->where( 'slug', $path[1] )->first() ) {
						return view( 'blog.view', [ 'entry' => $entry ] );
					}
				}

				else {
					if ( $entry = BlogEntry::where( 'active', 1 )->where( 'slug', $path[1] )->where( 'restricted', 0 )->first() ) {
						return view( 'blog.view', [ 'entry' => $entry ] );
					}
				}

			}

			// If a static view exists, show it.
			if ( view()->exists( $view = str_replace( '/', '.', $request->path() ) ) ) {
				return view( $view );
			}

			return view( 'blog.view' );

		}

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		// 
		// ********************************************************************************

		public function postCommentAdd( Request $request, $id ) {

			if ( $entry = BlogEntry::find( $id ) ) {

				$comment = new BlogEntryComment([
					'user_id' => @auth()->user()->id ?: 0,
					'comment' => $request->input( 'comment' ),
				]);

				$entry->comments()->save( $comment );

				return jsonResponse([ 'success' => true, 'reload' => true ]);

			}

			return jsonResponse([ 'success' => false, 'message' => '<strong>The specified post could not be found.</strong>' ]);

		}

	}

?>