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

					@include('includes.2016.friday-orcas')

					@include('includes.2016.feeding-humpbacks-dolphins-sea-lions-birds')

					@include('includes.2016.rissos-dolphins-baby-bottlenose-humpback-whales')

					@include('includes.2016.orcas-again-today')

					@include('includes.2016.dolphins-blues-humpback-whales-video')

					@include('includes.2016.every-blue-whale-is-here-right-now')

					@include('includes.2016.humpback-blue-fin-whales-in-monterey-bay')

					@include('includes.2016.monterey-bay-has-it-all')

					@include('includes.2016.so-many-whales-blues-and-humpbacks')
@stop

@section('scripts')
@append