@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle( 'Sign Up' ) }}</title>
@endsection

@section('title')
	<div class="row">
		<div class="small-12 columns">
			<h1>Sign Up</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			@if ( setting( 'userSignupEnable' ) )
	
				<form id="userSignupForm" method="post" action="{{ route('user.signup' ) }}" data-form-ajax data-form-ajax-clear>
	
					@if ( setting( 'userActivateEnable' ) )
						<p>To sign up for an account, please fill out the form below. We'll then send you an e-mail with information on how to set a password on your account.</p>
					@else
						<p>Please fill out the form below in order to sign up for a new account.</p>
					@endif
	
					<div class="required field">
						<label>First Name:</label>
						<input class="input first-focus" type="text" name="firstName" placeholder="First Name">
					</div>
	
					<div class="required field">
						<label>Last Name:</label>
						<input class="input" type="text" name="lastName" placeholder="Last Name">
					</div>
	
					<div class="required field">
						<label>E-mail Address:</label>
						<input class="input" type="email" name="email" placeholder="E-mail Address">
					</div>
	
					@if ( !setting( 'userActivateEnable' ) )
						<div class="required field">
							<label>Password:</label>
							<input class="input" type="text" name="password" placeholder="Password">
						</div>
					@endif
	
					<button class="ui primary button" type="submit">Sign Up</button>
	
				</form>
	
			@else
	
				<div class="alert callout">
					<strong>User signups have been disabled.</strong>
				</div>
	
			@endif

		</div>

	</div>

@endsection

@section('scripts')

	<script type="text/javascript" language="JavaScript">
	<!--

		// Remove the form from the page upon successful registration
/*
		$(document).ready({
			$("#userSignupForm").on( "ajaxFormSuccess", function(e) {
				$("#userSignupForm").remove();
				showGlobalAlert( response.message, "success", false );
			});
		});
*/

	//-->
	</script>

@endsection
