@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Recent Sightings While Whale Watching in Monterey Bay') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Archives: Recent Sightings</h1>

					@include('includes.2016.winter-solstice-brings-friendly-humpback-whales-lively-dolphins-and-ocean-birds')

					@include('includes.2016.orca-sighting-on-sunday')

					@include('includes.2016.lunge-feeding-whales-sea-lions')

					@include('includes.2016.fall-winter-sightings')

					@include('includes.2016.happy-thanksgiving')

					@include('includes.2016.dolphins-and-humpback-whales-this-week')

					@include('includes.2016.november-humpbacks-near-santa-cruz')

					@include('includes.2016.look-for-spouts-west-cliff-and-seabright')

					@include('includes.2016.october-humpbacks-feeding-dolphins')

					@include('includes.2016.beautiful-day-up-close-with-humpback-whales-video')

					@include('includes.2016.welcome-to-autumn-in-monterey-bay')
@stop

@section('scripts')
@append