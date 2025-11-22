@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Comments') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')
					<h1>Santa Cruz Whale Watching</h1>
					<h2>By Stagnaro Charters</h2>

					@include('includes.every-day-is-different-blue-fin-and-humpback')

					@include('includes.price-buster')

					@include('includes.humpbacks-and-orca-thrill-on-monterey-bay')

					@include('includes.show-goes-whales-birds-dolphins-still-drawing-crowds')

					@include('includes.rare-pacific-leatherback-sea-turtles-spotted-monterey-bay')

					@include('includes.santa-cruz-among-best-whale-watching-california-coast')

					@include('includes.rare-finds-monterey-bay-2')

					@include('includes.cbs-evening-news-rides-along-santa-cruz-whale-watching')

					@include('includes.monterey-whale-watching-abc-news')
@stop

@section('scripts')
@append