@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle( $blog->name ) }}</title>
@stop

@section('title')
	<div id="pageTitle" class="row collapse">
		<div class="small-12 columns">
			<h1>{{ $blog->name }}</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@stop

@section('content')

	@if ( $entries && count( $entries ) )

		<div class="row collapse">
	
			<div class="small-12 columns">

				@foreach ( $entries as $entry )
					<div class="secondary callout">
						<h2><a href="{{ $entry->route() }}">{{ $entry->name}}</a></h2>
						{!! $entry->content !!}
						<div class="blogFooter">
							{{ $entry->poster->displayName() }} | {{ $entry->created_at->toDayDateTimeString() }} {!! $entry->categoryLink( "| " ) !!} @if ( auth()->check() && auth()->user()->administrator ) | <a href="{{ $entry->route( true ) }}">Edit</a> @endif
						</div>
					</div>
				@endforeach
	
			</div>
	
		</div>

	@else

		<div class="row collapse">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>There are no {{ $blog->name }} entries.</strong>
				</div>
				@if ( auth()->check() && auth()->user()->hasPermission( 'admin.blog.entry.add' ) )
					<a class="primary button" href="{{ route( 'admin.blog.entry.add', $blog->id ) }}" title="Add a {{ $blog->name }} entry">Add a {{ $blog->name }} entry</a>
				@endif
			</div>
		</div>

	@endif

@stop
