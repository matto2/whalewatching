@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle( $entry ? 'View Post' : 'Post Not Found' ) }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.blog' ) }}">Post</a></li>
					<li>
						<span class="show-for-sr">Current: </span> View Post
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>{{ @$entry ? $entry->name : 'Entry Not Found' }}</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@stop

@section('content')

	@if ( @$entry )
		<div class="expanded row">	
			<div class="small-12 columns">	
				<div class="warning callout">
					<strong>You do not have sufficient privilege to edit this post.</strong>
				</div>	
				{!! $entry->content !!}
				<div class="blogFooter">
					{{ $entry->poster->displayName() }} | {{ $entry->created_at->toDayDateTimeString() }} {!! $entry->categoryLink( "| " ) !!} @if ( auth()->check() && auth()->user()->administrator ) | <a href="{{ route( 'admin.blog.view', $entry->id )}}">Edit</a> @endif
				</div>	
			</div>	
		</div>
	@else
		<div class="expanded row">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>The post you are looking for was not found.</strong>
				</div>
			</div>
		</div>
	@endif

@stop
