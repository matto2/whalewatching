@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Change Your E-Mail Address') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Change Your E-Mail Address</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">
	
			<p>To change your e-mail address, please complete the following information. We will send you a confirmation message to both your old and new e-mail addresses.</p>
	
			<p>Your current e-mail address is <strong>{{ Auth::user()->email }}</strong>.</p>

			<form id="changeEmailForm" method="post" action="{{ route('user.email' ) }}" data-form-ajax data-form-ajax-reload-page autocomplete="off">
	
				<div class="row">
					<div class="large-12 columns">
						<label>Current Password:
							<input class="input first-focus" type="password" name="password" placeholder="Current Password">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="large-12 columns email">
						<label>New E-Mail Address:
							<input class="input" type="email" name="email" placeholder="New E-Mail Address">
						</label>
					</div>
				</div>
	
				<button class="button primary" type="submit">Change Your E-Mail Address</button>
				<a class="button secondary" href="{{ route('user' ) }}" title="Cancel">Cancel</a>
	
			</form>
	
		</div>

	</div>

@endsection
