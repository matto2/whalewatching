@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('xxxxxxxxxx') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')
					<h6>This page is no longer maintained. Please visit <a href="/recent-sightings" title="Recent Sightings">Recent Sightings</a></h6>
					<h1>xxxxxxxxxx</h1>

					<p><img src="/images/map.jpg" alt="xxxxxxxxxxx while Whale Watching in Monterey Bay California with Stagnaro Charters"></p>

					<p>xxxxxxxxxxxxxxx</p>

					<p class="credit"><a href="xxxxxxxx" title="">Santa Cruz Sentinel</a></p>

					<p class="credit">xxxxxxxxxxxxxxx</p>

					<p class="credit">xxxxxxxxxxxxxxx</p>



					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append