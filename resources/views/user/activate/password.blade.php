@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Set Your Password') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Set Your Password</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">
		<div class="columns">
			<form method="post" action="{{ Request::url() }}" data-form-ajax>
				<div class="warning callout">
					<strong>In order to activate your account, you'll need to choose a password.</strong>
				</div>
				<div class="row">
					<div class="columns">
						<label>New Password:
							<input class="input first-focus" type="password" name="password" placeholder="New Password">
						</label>
					</div>
				</div>
				<button type="submit" class="button">Set Password</button>
			</form>
		</div>
	</div>

@endsection