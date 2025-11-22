@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('SantaCruz.com') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>SantaCruz.com</h1>

					<h2>Stinky the Whale Stars in Santa Cruz</h2>

					<p>Unfortunately the link to "Stinky the Whale Stars in Santa Cruz" is no longer available at <a href="http://santacruz.com/" title="">Santa Cruz</a></p>

					<p class="credit"> This entry was posted on April 3, 2013 by admin.</p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append