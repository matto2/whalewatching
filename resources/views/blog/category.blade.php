@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle( 'Blog' ) }}</title>
@stop

@section('title')
	
@stop

@section('content')

	<div id="pageTitle" class="row collapse">
		<div class="small-12 columns">
			<h1>{{ 'Blog' }}</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

	@if ( $category && count( $category->entries() ) )

		<div class="row collapse">
	
			<div class="small-12 columns">
	
				@foreach ( $category->entries()->orderBy( 'created_at', 'desc' )->get() as $entry )
					<div class="secondary callout">
						<h2><a href="{{ route( 'blog.view', $entry->slug ) }}">{{ $entry->name}}</a></h2>
						{!! $entry->content !!}
						<div class="blogFooter">
							{{ $entry->poster->displayName() }} | {{ $entry->created_at->toDayDateTimeString() }} {!! $entry->categoryLink( "| " ) !!} @if ( auth()->check() && auth()->user()->administrator ) | <a href="{{ route( 'admin.blog.view', $entry->id )}}">Edit</a> @endif
						</div>
					</div>
				@endforeach
	
			</div>
	
		</div>

	@else

		<div class="row collapse">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>There are no blog entries.</strong>
				</div>
			</div>
		</div>

	@endif

@stop
