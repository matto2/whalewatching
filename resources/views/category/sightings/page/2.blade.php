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

					@include('includes.whale-time-anchovies-bring-record-numbers-humpbacks')

					@include('includes.monterey-whale-watching-whales-on-vacation')

					@include('includes.my-blue-heaven-abundance-of-worlds-largest-creature-seen-in-monterey-bay')

					@include('includes.photos-whales-fill-the-monterey-bay-2')

					@include('includes.a-whale-of-a-show-krill-bloom-draws-blues-and-humpbacks-to-bay')

					@include('includes.nbc-news-bay-area')

					@include('includes.fox-news')

					@include('includes.huffington-post')
@stop

@section('scripts')
@append