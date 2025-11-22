<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\Blog\BlogAdminAddRequest;
	use App\Http\Requests\Admin\Blog\BlogAdminViewRequest;
	use App\Http\Requests\Admin\Blog\BlogSettingsAdminRequest;
	use App\Models\Blog\Blog;
	use App\Models\Blog\BlogCategory;
	use App\Models\Blog\BlogEntry;
	use App\Models\Blog\BlogEntryCategory;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;

	class BlogController extends Controller {

		// ********************************************************************************
		// Function: __construct()
		// --------------------------------------------------------------------------------
		// Class constructor
		// ********************************************************************************

		public function __construct() {

			// Set route middleware
			$this->middleware( 'HasPermission:admin.blog.*' );
			$this->middleware( 'HasPermission:admin.blog.entry.add' )->only([ 'getAdd', 'postAdd' ]);

		}

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getIndex( Request $request ) {
			return view( 'admin.blog', [ 'blogs' => Blog::orderBy( 'name', 'asc' )->get() ] );
		}

		// ********************************************************************************
		// Function: getAdd()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getAdd( Request $request ) {
			return view( 'admin.blog.add', [ 'categories' => BlogCategory::orderBy( 'name', 'asc' )->get() ] );
		}

		// ********************************************************************************
		// Function: postAdd()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postAdd( BlogAdminAddRequest $request ) {

			try {

				// Add the page to the database
				$blog = new Blog([
					'name'           => $request->input( 'name' ),
					'slug'           => $request->input( 'slug' ),
					'active'         => $request->input( 'active', 0 ),
					'hidden'         => $request->input( 'hidden', 0 ),
					'restricted'     => $request->input( 'restricted', 0 ),
					'allow_comments' => $request->input( 'allow_comments', 0 ),
				]);

				$blog->save();

				// Set a global success alert
				addGlobalFlashAlert( "<strong>The blog '{$blog->name}' was successfully added.</strong>", 'success', true );

				// Return a success redirect message
				return response()->json([ 'success' => true, 'redirect' => route('admin.blog.view', $blog->id ) ]);

			}

			catch ( Exception $e ) {
				return response()->json([ 'success' => false, 'message' => "An error occurred while adding the blog: {$e->getMessage()}." ]);
			}

		}

		// ********************************************************************************
		// Function: postDelete()
		// --------------------------------------------------------------------------------
		// Delete the specified page.
		// ********************************************************************************

		public function postDelete( Request $request, $id ) {

			if ( $blog = Blog::find( $id ) ) {

				try {

					// Set a global success alert
					addGlobalFlashAlert( "<strong>The blog '{$blog->name}' was successfully deleted.</strong>", 'success', true );

					// Delete the blog
					$blog->delete();

					// Return successfully
					return response()->json([ 'success' => true, 'redirect' => route( 'admin.blog' ) ]);

				}

				catch ( Exception $e ) {
					return response()->json([ 'success' => false, 'message' => "An error occurred while deleting this blog: {$e->getMessage()}." ]);
				}

			}

		}

		// ********************************************************************************
		// Function: getEdit()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getEdit( Request $request, $blog ) {
			return view( 'admin.blog.edit', [ 'blog' => Blog::find( $blog ) ] );
		}

		// ********************************************************************************
		// Function: postEdit()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postEdit( BlogAdminViewRequest $request, $id ) {

			if ( $blog = Blog::find( $id ) ) {

				try {

					// Start a database transaction
// 					DB::beginTransaction();

					// Update the entry
					$blog->name           = $request->input( 'name' );
					$blog->slug           = $request->input( 'slug' );
					$blog->active         = $request->input( 'active', 0 );
					$blog->hidden         = $request->input( 'hidden', 0 );
					$blog->restricted     = $request->input( 'restricted', 0 );
					$blog->allow_comments = $request->input( 'allow_comments', 0 );
					$blog->save();

/*
					// Upda
					foreach ( $blog->entries as $entry ) {
						$entry->url = "/{$blog->slug}/{$entry->slug}";
						$entry->save();
					}
*/

					// Return successfully
					return response()->json([ 'success' => true, 'message' => '<strong>Your changes were successfully saved.</strong>' ]);

				}

				catch ( Exception $e ) {
					return response()->json([ 'success' => false, 'message' => "An error occurred while saving your changes: {$e->getMessage()}." ]);
				}

			}

		}

		// ********************************************************************************
		// Function: getView()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getView( Request $request, $blog ) {
			return view( 'admin.blog.view', [ 'blog' => Blog::find( $blog ) ] );
		}

		// ********************************************************************************
		// Function: postView()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postView( BlogAdminViewRequest $request, $id ) {

			if ( $blog = Blog::find( $id ) ) {

				try {

					// Update the entry
					$blog->name           = $request->input( 'name' );
					$blog->slug           = $request->input( 'slug' );
					$blog->active         = $request->input( 'active', 0 );
					$blog->hidden         = $request->input( 'hidden', 0 );
					$blog->restricted     = $request->input( 'restricted', 0 );
					$blog->allow_comments = $request->input( 'allow_comments', 0 );
					$blog->save();

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

		// ********************************************************************************
		// Function: getSettings()
		// --------------------------------------------------------------------------------
		// Blog settings page.
		// ********************************************************************************

		public function getSettings( Request $request ) {
			return view( 'admin.blog.settings' );
		}

		// ********************************************************************************
		// Function: postSettings()
		// --------------------------------------------------------------------------------
		// Process an AJAX request to change blog settings.
		// ********************************************************************************

		public function postSettings( BlogSettingsAdminRequest $request ) {

			// Save all settings
			setting([

				'blogCommentEnable'             => $request->input( 'blogCommentEnable', 0 ),
				'blogCommentLoginRequired'      => $request->input( 'blogCommentLoginRequired', 0 ),

				'blogEntryActiveDefault'        => $request->input( 'blogEntryActiveDefault', 0 ),
				'blogEntryHiddenDefault'        => $request->input( 'blogEntryHiddenDefault', 0 ),
				'blogEntryAllowCommentsDefault' => $request->input( 'blogEntryAllowCommentsDefault', 0 ),
				'blogEntryRestrictedDefault'    => $request->input( 'blogEntryRestrictedDefault', 0 ),

			]);

			return jsonResponse([ 'success' => true, 'message' => '<strong>Your changes were successfully saved.</strong>' ]);

		}

	}

?>
