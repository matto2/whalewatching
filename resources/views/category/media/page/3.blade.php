@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Media') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Media</h1>

					<h2>Santa Cruz Whale Watching in the News</h2>

					@include('includes.paul-schraubs-whales-shot-shows-why-californias-santa-cruz-is-so-special')

					@include('includes.whale-watchers-get-up-close-personal-in-santa-cruz-harbor')

					@include('includes.monterey-california-whale-watching')

					@include('includes.a-whale-of-a-show-krill-bloom-draws-blues-and-humpbacks-to-bay')

					@include('includes.whale-watching-monterey-california')

					@include('includes.cbs-evening-news')

					@include('includes.humpback-whales-return-to-monterey-bay')
@stop

@section('scripts')
@append