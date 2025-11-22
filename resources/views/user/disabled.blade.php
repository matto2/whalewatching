@extends( 'layouts.frontend' )

@section('head')
	<title>{{ pageTitle('Account Disabled') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Account Disabled</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section( 'content' )

	<div class="row">

		<div class="small-12 columns">

			<p>Sorry, your account has been disabled.</p>

		</div>

	</div>

@endsection