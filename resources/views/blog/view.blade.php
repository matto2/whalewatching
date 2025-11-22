@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle( @$entry->name ?: config( 'blog.title' ) ) }}</title>
@stop

@section('title')
@stop

@section('content')

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>{{ @$entry ? $entry->name : config( 'blog.title' ) }}</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

	@if ( isset( $entry ) )

		<div class="row">
	
			<div class="small-12 columns">
	
				{!! $entry->content !!}

				<div class="blogFooter">
					{{ $entry->poster->displayName() }} | {{ $entry->created_at->toDayDateTimeString() }} {!! $entry->categoryLink( "| " ) !!} @if ( auth()->check() && auth()->user()->administrator ) | <a href="{{ route( 'admin.blog.view', $entry->id )}}">Edit</a> @endif
				</div>
	
			</div>
	
		</div>

		@if ( $entry->comments->count() )

			<div class="row columns">

				<h2>Comments</h2>

				@foreach ( $entry->comments as $comment )

					<div class="blogCommentBody">
						{{ $comment->comment }}
					</div>

					<div class="blogCommentFooter">
						Posted {{ \Carbon\Carbon::parse( $comment->created_at )->toDayDateTimeString() }} by {{ $comment->poster ? $comment->poster->displayName(): 'Anonymous' }}
					</div>

					@if ( !$loop->last )
						<hr>
					@endif

				@endforeach

			</div>

		@endif


		@if ( $entry->allow_comments && ( setting( 'blogCommentLoginRequired' ) && auth()->check() ) )
			<div class="row columns">
				<h2>Add a Comment</h2>
				<form method="post" action="{{ route( 'blog.comment.add', $entry->id ) }}" data-form-ajax data-form-ajax-reload data-abide>
					<textarea name="comment" required></textarea>
					<button class="primary button" type="submit">Add Comment</button>
				</form>
			</div>
		@endif

	@else

		<div class="row">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>The {{ config( 'blog.title' ) }} entry you're looking for was not found.</strong>
				</div>
			</div>
		</div>

	@endif

@stop
