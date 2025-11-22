<?php

	namespace App\Http\Middleware;

	use Auth;
	use Closure;

	class Administrator {

		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \Closure  $next
		 * @return mixed
		 */
		public function handle($request, Closure $next) {

			if ( Auth::guest() ) {

				if ($request->ajax()) {
					return response()->json([ 'success' => false, 'message' => 'You must be logged on to perform this action.' ]);			
				}

				return redirect()->guest( route( 'user.login' ) );

			}

			if ( !Auth::user()->administrator ) {

				if ($request->ajax()) {
					return response()->json([ 'success' => false, 'message' => 'You must be an administrator to perform this action.' ]);			
				}

				return redirect()->route( 'home' );

			}

			return $next($request);

		}

	}

?>