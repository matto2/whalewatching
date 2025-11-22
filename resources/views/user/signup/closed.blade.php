@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('New User Sign Ups Disabled') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Sign Up</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">
		<div class="small-12 columns">
			<div class="alert callout"><strong>Sorry, new user registrations are currently disabled.</strong></div>
		</div>
	</div>

@endsection