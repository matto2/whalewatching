<?php

	namespace App\Http\Middleware;

	use Auth;
	use Carbon\Carbon;
	use Closure;
	use Illuminate\Http\RedirectResponse;

	class CheckUser {

		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \Closure  $next
		 * @return mixed
		 */
		public function handle($request, Closure $next) {

			if ( Auth::check() ) {

				// Clear any reset password code and update the user's last active time
				Auth::user()->reset_password_code = null;
				Auth::user()->reset_password_code_expires = null;
				Auth::user()->last_active = Carbon::now();
				Auth::user()->save();

				if ( !$this->isUnrestrictedroute($request ) ) {

					// Check if the user's account is disabled
					if ( !Auth::user()->enabled ) {
		 				return redirect()->route('user.disabled' );
					}

					// Check if the user's account is confirmed
					if ( Auth::check() && !Auth::user()->isActivated() ) {
		 				return redirect()->route('user.activate' );
					}

					// Check if the user's password is expired
					if ( Auth::user()->password_expires != null && Auth::user()->password_expires <= Carbon::now() ) {
		 				return redirect()->route('user.expired' );
					}

				}

			}

			return $next($request);

		}

		public function isUnrestrictedroute($request ) {
			if ( $request->is( 'user/activate*' ) ) return true;
			if ( $request->is( 'user/disabled' ) ) return true;
			if ( $request->is( 'user/expired' ) ) return true;
			if ( $request->is( 'user/logout' ) ) return true;
			if ( $request->is( 'user/login' ) ) return true;
			return false;
		}

	}

?>