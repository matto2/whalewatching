@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Lots of Dolphins') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Lots of Dolphins</h1>

					<h2>December 21, 2012</h2>

					<p>Wednesday we saw some of the first Gray Whales of the year. We followed 3 animals for about 45 minutes. The winter migration has begun!!</p>

					<p class="credit">This entry was posted on December 21, 2012 by admin.</p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append