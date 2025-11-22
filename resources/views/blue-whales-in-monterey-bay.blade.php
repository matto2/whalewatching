@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Blue Whales in Monterey Bay') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Blue Whales in Monterey Bay</h1>

					<p><a href="http://theterramarproject.org/" title="">The Terramar Project</a></p>

					<p class="credit">This entry was posted in Media, Press Coverage on April 3, 2013 by admin.</p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append