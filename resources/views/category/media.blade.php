@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Media') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Santa Cruz Whale Watching in the News</h1>

					@include('includes.show-goes-whales-birds-dolphins-still-drawing-crowds')

					@include('includes.rare-pacific-leatherback-sea-turtles-spotted-monterey-bay')

					@include('includes.santa-cruz-among-best-whale-watching-california-coast')

					@include('includes.cbs-evening-news-rides-along-santa-cruz-whale-watching')

					@include('includes.monterey-whale-watching-abc-news')

					@include('includes.dan-haifley-ocean-backyard-gray-whale-time')

					@include('includes.a-variety-of-whales')

					@include('includes.year-whale-2013-brought-marine-show-unlike')

					@include('includes.monterey-bay-humpbacks-made-new-york-times')

					@include('includes.whales-still-going-wild-monterey-bay-ksbw-news-report-2')

					@include('includes.lets-go-fishin-whales-red-tide')
@stop

@section('scripts')
@append