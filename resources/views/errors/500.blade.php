@extends('layouts.frontend')

@section('head')
	<meta name="robots" content="none">
	<meta name="Keywords" content="500 Internal Server Error">
	<meta name="Description" content="500 Internal Server Error">
	<title>{{ pageTitle('500 Internal Server Error') }}</title>
@stop

@section('title')
@stop

@section('content')

					<h1>500 Internal Server Error</h1>

					<p>500 Internal Server Error — That's kind of geek speak. In plain English that means something went wrong when trying to visit this page. There are all sorts of reasons to get a 500, you can google about it, or simply hit your back arrow or go to our <a class="a" href="/" title="Click to go to Home Page">Home Page</a> and start over.</p>
@stop

@section('scripts')
@append