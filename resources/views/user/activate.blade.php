@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Activate Account') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Activate Account</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			<form method="post" action="{{ Request::url() }}" data-form-ajax>

				<p>In order to log on to your account, you will first need to verify your email address. You should have received an email from us with an activation link shortly after you signed up for an account.</p>
				<p>If you did not receive an activation email from us, please click "Resend Activation Email" below to have another activation email sent to you.</p>

				<button class="button primary" type="submit">Resend Activation Email</button>

			</form>

		</div>

	</div>

@endsection