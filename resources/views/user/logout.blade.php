@extends('layouts.frontend')

@section('head')
	<title>Log Off of Your Account</title>
@endsection

@section('title')

	<div class="row">
		<div class="small-12 columns">
			<h1>Log Off of Your Account</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
	
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			<button class="button userLogoutLink" type="submit">Click Here to Log Off</button>
	
		</div>

	</div>
	
@endsection
