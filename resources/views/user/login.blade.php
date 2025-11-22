@extends('layouts.frontend')

@section('head')
	<title>Log In to Your Account</title>
@endsection

@section('title')

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Log In to Your Account</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
	
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			<form method="post" action="{{ route( 'user.login' ) }}" data-form-ajax>
		
				@if ( session()->has( 'userLoginRedirect' ) )
					<div class="warning callout">
						<strong>You must log in to your account in order to continue.</strong>
					</div>
				@endif
		
				<label>
					E-mail Address:
					<input class="first-focus" type="email" name="email" placeholder="E-mail Address">
				</label>
		
				<label>
					Password:
					<input type="password" name="password" placeholder="Password">
				</label>
		
				<button class="button" type="submit">Log In</button>
				<a href="{{ route( 'user.reset' ) }}" class="secondary button">Forgot Password</a>
				@if ( setting( 'userSignupEnable' ) )
					<a href="{{ route( 'user.signup' ) }}" class="secondary button">Sign Up</a>
				@endif
		
			</form>

		</div>

	</div>	

@endsection
