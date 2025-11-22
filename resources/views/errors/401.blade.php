@extends('layouts.frontend')

@section('head')
	<meta name="robots" content="none">
	<meta name="Keywords" content="401 Unauthorized">
	<meta name="Description" content="401 Unauthorized">
	<title>{{ pageTitle('401 Unauthorized') }}</title>
@stop

@section('title')
@stop

@section('content')

					<h1>401 Unauthorized</h1>

					<p>401 Unauthorized — Forbidden or HTTP 401. That's kind of geek speak. In plain English that means you're not allowed to visit this page. There are all sorts of reasons to get a 401, you can google about it, or simply hit your back arrow or go to our <a class="a" href="/" title="Click to go to Home Page">Home Page</a> and start over.</p>
@stop

@section('scripts')
@append