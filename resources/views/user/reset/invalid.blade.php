@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Reset Your Password') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Reset Your Password</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">
	
			<p>In order to reset your password, please enter your email address below. We'll then send you an email with a link that will allow you to reset your password.</p>
	
			<form id="userResetForm" method="post" action="{{ route('user.reset' ) }}" data-form-ajax autocomplete="off">
	
				<div class="row">
					<div class="large-12 columns">
						<label>E-mail Address:
							<input class="input first-focus" type="email" name="email" placeholder="E-mail Address">
						</label>
					</div>
				</div>
	
				<button class="button primary" type="submit">Reset Your Password</button>
	
			</form>
	
		</div>

	</div>

@endsection
