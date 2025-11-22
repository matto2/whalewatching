@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Account Activated') }}</title>
@stop

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Account Activated</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@stop

@section('content')

	<div class="row">
		<div class="small-12 columns">
			<p><strong>Thank you for activating your account!</strong> You can now <a href="{{ route('user.login' ) }}" title="Log on to your account">log on to your account</a>.</p>
			<p><a class="button" href="{{ route('user.login' ) }}" title="Log on to your account">Log on to your account</a>
		</div>
	</div>

@stop

@section('scripts')
@append
