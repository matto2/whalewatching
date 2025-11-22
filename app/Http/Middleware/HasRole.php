<?php

	namespace App\Http\Middleware;

	use Auth;
	use Closure;

	class HasRole {

		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \Closure  $next
		 * @return mixed
		 */
		public function handle( $request, Closure $next, $role ) {

			if ( auth()->guest() ) {

				if ($request->ajax()) {
					return response()->json([ 'success' => false, 'message' => 'You must be logged in to perform this action.' ]);			
				}

				return redirect()->guest( route( 'user.login' ) );

			}

			if ( !auth()->user()->administrator || !auth()->user()->hasRole( $role ) ) {

				if ($request->ajax()) {
					return response()->json([ 'success' => false, 'message' => 'Your account does not have sufficient privilege to perform this action.' ]);			
				}

				return redirect()->route( 'home' );

			}

			return $next($request);

		}

	}

?>