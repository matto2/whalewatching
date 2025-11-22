@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Your Password Has Expired') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Your Password Has Expired</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')
	
	<div class="row">

		<div class="small-12 columns">
	
			<p>In order to continue, you will need to change your password.</p>
	
			<form method="post" action="{{ route('user.expired' ) }}" autocomplete="off" data-form-ajax>
	
				<div class="row">
					<div class="large-12 columns">
						<label>New Password:
							<input class="input first-focus" type="password" name="password" placeholder="New Password">
						</label>
					</div>
				</div>
	
				<button class="button primary" type="submit">Change Your Password</button>
	
			</form>
	
		</div>

	</div>

@endsection