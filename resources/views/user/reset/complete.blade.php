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
	
			<form method="post" action="{{ Request::url() }}" data-form-ajax autocomplete="off">

				<input type="hidden" name="step" value="2">
	
				<p>Please complete the following form in order to reset your password.</p>
	
				<div class="row">
					<div class="large-12 columns">
						<label>E-mail Address:
							<input class="input first-focus" type="email" name="email" placeholder="E-mail Address">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="large-12 columns">
						<label>New Password:
							<input class="input" type="password" name="password" placeholder="Password">
						</label>
					</div>
				</div>
	
				<button type="submit" class="button primary">Change Password</button>
			
			</form>
	
		</div>

	</div>

@endsection