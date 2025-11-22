@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Change Your Password') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Change Your Password</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			@if( Auth::user()->canChangePassword() )

				<p>To change your password, please complete the following information. We will send you a confirmation message to your e-mail account.</p>
		
				<form method="post" action="{{ route('user.password' ) }}" data-form-ajax data-form-ajax-clear autocomplete="off">
		
					<div class="row">
						<div class="large-12 columns password">
							<label>Current Password:
								<input class="input first-focus" type="password" name="password" placeholder="Current Password">
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="large-12 columns new_password">
							<label>New Password:
								<input class="input" type="password" name="newPassword" placeholder="New Password">
							</label>
						</div>
					</div>
		
					<button class="button primary" type="submit">Change Your Password</button>
					<a class="button secondary" href="{{ route('user' ) }}" title="Cancel">Cancel</a>
		
				</form>

			@else

				<div class="alert callout">
					<strong>You can only change your password once every {{ setting( 'userPasswordAgeMin' ) }} days.</strong>
				</div>

			@endif
	
		</div>

	</div>

@endsection
