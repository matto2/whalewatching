<?php

	namespace App\Http\Middleware;

	use Closure;

	class HasPermission {

		// ********************************************************************************
		// Function: handle()
		// --------------------------------------------------------------------------------
		// Determine if the user has the specified permission.
		// ********************************************************************************

		public function handle( $request, Closure $next, $role ) {

			if ( auth()->guest() ) {

				if ($request->ajax()) {
					return response()->json([ 'success' => false, 'message' => 'You must be logged in to perform this action.' ]);			
				}

				return redirect()->guest( route( 'user.login' ) );

			}

			if ( !auth()->user()->administrator && !auth()->user()->hasPermission( $role ) ) {

				if ($request->ajax()) {
					return response()->json([ 'success' => false, 'message' => 'Your account does not have sufficient privilege to perform this action.' ]);			
				}

				abort( 403 );

			}

			return $next($request);

		}

	}

?>