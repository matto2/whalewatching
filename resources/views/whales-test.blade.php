@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Whales test') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Whales test</h1>

					<p class="credit">This entry was posted in simple sightings on June 18, 2014 by admin.</p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append