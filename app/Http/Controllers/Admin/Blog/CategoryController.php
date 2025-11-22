<?php

	namespace App\Http\Controllers\Admin\Blog;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\Blog\BlogCategoryAdminAddRequest;
	use App\Http\Requests\Admin\Blog\BlogCategoryAdminViewRequest;
	use App\Models\Blog\Blog;
	use App\Models\Blog\BlogCategory;
	use Illuminate\Http\Request;

	class CategoryController extends Controller {

		// ********************************************************************************
		// Function: getIndex()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getIndex( Request $request, $blog ) {
			return view( 'admin.blog.category', [ 'blog' => Blog::find( $blog ) ] );
		}

		// ********************************************************************************
		// Function: getAdd()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getAdd( Request $request, $blog ) {
			return view( 'admin.blog.category.add', [ 'blog' => Blog::find( $blog ) ] );
		}

		// ********************************************************************************
		// Function: postAdd()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postAdd( BlogCategoryAdminAddRequest $request, $blog ) {

			if ( $blog = Blog::find( $blog ) ) {

				try {

					// Add the page to the database
					$category = new BlogCategory();
					$category->name       = $request->input( 'name' );
					$category->slug       = $request->input( 'slug' );
					$blog->categories()->save( $category );

					// Set a global success alert
					addGlobalFlashAlert( "<strong>The blog category '{$category->name}' was successfully added.</strong>", 'success', true );

					// Return a success redirect message
					return response()->json([ 'success' => true, 'redirect' => route( 'admin.blog.category.view', [ $blog->id, $category->id ] ) ]);

				}

				catch ( Exception $e ) {
					return response()->json([ 'success' => false, 'message' => "An error occurred while adding the blog category: {$e->getMessage()}." ]);
				}

			}

			return response()->json([ 'success' => false, 'message' => '<strong>The blog you specified could not be found.</strong>' ]);

		}

		// ********************************************************************************
		// Function: postDelete()
		// --------------------------------------------------------------------------------
		// Delete the specified page.
		// ********************************************************************************

		public function postDelete( Request $request, $blog, $id ) {

			if ( $blog = Blog::find( $blog ) ) {

				if ( $category = BlogCategory::where( 'blog_id', $blog->id )->where( 'id', $id )->first() ) {

					try {

						// Set a global success alert
						addGlobalFlashAlert( "<strong>The blog category '{$category->name}' was successfully deleted.</strong>", 'success', true );

						// Delete the page
						$category->delete();

						// Return successfully
						return response()->json([ 'success' => true, 'redirect' => route( 'admin.blog.category', $blog->id ) ]);

					}

					catch ( Exception $e ) {
						return response()->json([ 'success' => false, 'message' => "An error occurred while deleting this blog category: {$e->getMessage()}." ]);
					}

				}

				return response()->json([ 'success' => false, 'message' => '<strong>The blog category you specified could not be found.</strong>' ]);

			}

			return response()->json([ 'success' => false, 'message' => '<strong>The blog you specified could not be found.</strong>' ]);

		}

		// ********************************************************************************
		// Function: getView()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function getView( Request $request, $blog, $id ) {
			return view( 'admin.blog.category.view', [ 'blog' => Blog::find( $blog ), 'category' => BlogCategory::find( $id ) ] );
		}

		// ********************************************************************************
		// Function: postView()
		// --------------------------------------------------------------------------------
		//
		// ********************************************************************************

		public function postView( BlogCategoryAdminViewRequest $request, $blog, $id ) {

			if ( $blog = Blog::find( $blog ) ) {

				if ( $category = BlogCategory::where( 'blog_id', $blog->id )->where( 'id', $id )->first() ) {

					try {

						// Update the page
						$category->name       = $request->input( 'name' );
						$category->slug       = $request->input( 'slug' );
						$category->active     = $request->input( 'active', true );
						$category->save();

						// Return successfully
						return response()->json([ 'success' => true, 'message' => '<strong>Your changes were successfully saved.</strong>' ]);

					}

					catch ( Exception $e ) {
						return response()->json([ 'success' => false, 'message' => "An error occurred while saving your changes: {$e->getMessage()}." ]);
					}

				}

				return response()->json([ 'success' => false, 'message' => '<strong>The blog category you specified could not be found.</strong>' ]);

			}

			return response()->json([ 'success' => false, 'message' => '<strong>The blog you specified could not be found.</strong>' ]);

		}

	}

?>
