<?php

	namespace App\Http\Controllers\Admin\Blog;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\Blog\BlogEntryAdminAddRequest;
	use App\Http\Requests\Admin\Blog\BlogEntryAdminViewRequest;
	use App\Http\Requests\Admin\Blog\BlogSettingsAdminRequest;
	use App\Models\Blog\Blog;
	use App\Models\Blog\BlogCategory;
	use App\Models\Blog\BlogEntry;
	use App\Models\Blog\BlogEntryCategory;
	use App\Models\Content\Redirect;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;

	class EntryController extends Controller {

		// ********************************************************************************
		// Function: __construct()
		// --------------------------------------------------------------------------------
		// Class constructor
		// ********************************************************************************

		public function __construct() {

			// Set route middleware
			$this->middleware( 'HasPermission:admin.blog.entry.*' );
			$this->middleware( 'HasPermission:admin.blog.entry.add' )->only([ 'getAdd', 'postAdd' ]);

		}

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getIndex( Request $request, $blog ) {
			return view( 'admin.blog.entry', [ 'blog' => Blog::find( $blog ), 'entries' => BlogEntry::get() ] );
		}

		// ********************************************************************************
		// Function: getAdd()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getAdd( Request $request, $blog ) {
			return view( 'admin.blog.entry.add', [ 'blog' => Blog::find( $blog ), 'categories' => BlogCategory::orderBy( 'name', 'asc' )->get() ] );
		}

		// ********************************************************************************
		// Function: postAdd()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postAdd( BlogEntryAdminAddRequest $request, $blog ) {

			// Make sure a valid blog was specified
			if ( !$blog = Blog::find( $blog ) ) {
				return response()->json([ 'success' => false, 'message' => '<strong>The post you specified could not be found.</strong>' ]);
			}

			try {

				// Start a database transaction
				DB::beginTransaction();

				// Add the page to the database
				$entry = new BlogEntry([
					'blog_id'        => $blog->id,
					'user_id'        => auth()->user()->id,
					'name'           => $request->input( 'name' ),
					'slug'           => $request->input( 'slug' ),
					'content'        => $request->input( 'content' ),
					'active'         => $request->input( 'active', 0 ),
					'hidden'         => $request->input( 'hidden', 0 ),
					'restricted'     => $request->input( 'restricted', 0 ),
					'allow_comments' => $request->input( 'allow_comments', 0 ),
				]);

				$entry->save();

				$categories = [];

				// Create all of the transfer type records
				if ( is_array( $request->input( 'categories' ) ) ) {

					foreach ( $request->input( 'categories' ) as $item ) {
						$categories[] = new BlogEntryCategory([ 'blog_category_id' => intval( $item ) ]);
					}

					// Save the transfer type records
					$entry->categories()->saveMany( $categories );

				}

				// Commit the database changes
				DB::commit();

				// Set a global success alert
				addGlobalFlashAlert( "<strong>The post '{$entry->name}' was successfully added.</strong>", 'success', true );

				// Return a success redirect message
				return response()->json([ 'success' => true, 'redirect' => route( 'admin.blog.entry.view', [ $blog->id, $entry->id ] ) ]);

			}

			catch ( Exception $e ) {

				// Roll back the database changes
				DB::rollback();

				return response()->json([ 'success' => false, 'message' => "An error occurred while adding the post: {$e->getMessage()}." ]);

			}

		}

		// ********************************************************************************
		// Function: postDelete()
		// --------------------------------------------------------------------------------
		// Delete the specified page.
		// ********************************************************************************

		public function postDelete( Request $request, $blog, $id ) {

			if ( $entry = BlogEntry::find( $id ) ) {

				try {

					// Set a global success alert
					addGlobalFlashAlert( "<strong>The post '{$entry->name}' was successfully deleted.</strong>", 'success', true );

					// Delete the page
					$entry->delete();

					// Return successfully
					return response()->json([ 'success' => true, 'redirect' => route( 'admin.blog.entry', $blog ) ]);

				}

				catch ( Exception $e ) {
					return response()->json([ 'success' => false, 'message' => "An error occurred while deleting this post: {$e->getMessage()}." ]);
				}

			}

		}

		// ********************************************************************************
		// Function: getView()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getView( Request $request, $blog, $id ) {

			// Retain referring page, if necessary
			session()->keep( 'blogViewEntryReferer' );

			// Store the referring page, if necessary
			if ( !session()->has( 'blogViewEntryReferer' ) && substr( referer(), 0, 5 ) == '/blog' ) session()->flash( 'blogViewEntryReferer', referer() );

			// Determine which view to use
			$view = auth()->user()->hasPermission( 'admin.blog.entry.edit' ) ? 'admin.blog.entry.edit' : 'admin.blog.entry.view';

			return view( $view, [ 'blog' => Blog::find( $blog ), 'entry' => BlogEntry::where( 'blog_id', $blog )->find( $id ) ] );

		}

		// ********************************************************************************
		// Function: postView()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postView( BlogEntryAdminViewRequest $request, $blog, $id ) {

			if ( $entry = BlogEntry::find( $id ) ) {

				try {

					// Start a database transaction
					DB::beginTransaction();

					// Add a redirect, if necessary
					if ( $request->input( 'add_redirect' ) == 1 ) {

						// Delete any old redirects
						Redirect::where( 'to', "/{$entry->blog->slug}/{$entry->slug}" )->delete();

						// Create a new redirect
						$redirect = new Redirect([
							'from'   => "/{$entry->blog->slug}/{$entry->slug}",
							'to'     => "/{$entry->blog->slug}/{$request->input( 'slug' )}",
							'active' => 1,
						]);
						$redirect->save();

					}

					// Update the entry
					$entry->name           = $request->input( 'name' );
					$entry->slug           = $request->input( 'slug' );
					$entry->content        = $request->input( 'content' );
					$entry->active         = $request->input( 'active', 0 );
					$entry->hidden         = $request->input( 'hidden', 0 );
					$entry->restricted     = $request->input( 'restricted', 0 );
					$entry->allow_comments = $request->input( 'allow_comments', 0 );
					$entry->save();

					$categories = [];

					// Delete the existing category entries
					$entry->categories()->delete();

					// Create all of the transfer type records
					if ( is_array( $request->input( 'categories' ) ) ) {

						foreach ( $request->input( 'categories' ) as $item ) {
							$categories[] = new BlogEntryCategory([ 'blog_category_id' => intval( $item ) ]);
						}

						// Save the transfer type records
						$entry->categories()->saveMany( $categories );

					}

					// Commit the database changes
					DB::commit();

					// Return successfully
					return response()->json([ 'success' => true, 'message' => '<strong>Your changes were successfully saved.</strong>' ]);

				}

				catch ( Exception $e ) {

					// Roll back the database changes
					DB::rollback();

					return response()->json([ 'success' => false, 'message' => "An error occurred while saving your changes: {$e->getMessage()}." ]);

				}

			}

		}

	}

?>
