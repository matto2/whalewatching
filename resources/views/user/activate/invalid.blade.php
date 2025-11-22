@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Invalid Account Activation Link') }}</title>
@endsection

@section('pageTitle')
Invalid Account Activation Link
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="columns">
			<h1>Invalid Account Activation Link</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">
		<div class="columns">
			<form method="post" action="{{ route('user.activate' ) }}" data-form-ajax autocomplete="off">
				<p><strong>The activation link you clicked on is invalid or has expired.</strong> This can occur if you have requested a new activation email from us, but clicked the activation link in a previous email.</p>

				<p>To request a new activation email, please enter your e-mail address below and click "Resend Activation Email".</p>

				<div class="row">
					<div class="large-12 columns">
						<label>E-mail Address:
							<input class="input first-focus" type="email" name="email" placeholder="E-mail Address">
						</label>
					</div>
				</div>

				<button class="button primary" type="submit">Resend Activation Email</button>
			</form>
		</div>
	</div>

@endsection