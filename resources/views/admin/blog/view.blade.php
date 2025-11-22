@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle( $blog ? 'View Sightings' : 'Sightings Not Found' ) }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.blog' ) }}">Posts</a></li>
					<li>
						<span class="show-for-sr">Current: </span> View Sightings
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>{{ @$blog ? $blog->name : 'Sightings Not Found' }}</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@stop

@section('content')

	@if ( @$blog )

		<div class="row">
			<div class="small-12 columns">
				@if ( $blog->entries->count() )
					<table id="blogEntryListTable" class="table-bordered table-striped table-hovered" width="100%">
						<thead>
							<tr>
								<th>Entry Name</th>
								<th class="hide-for-small-only">Slug</th>
								<th class="hide-for-small-only">Active</th>
								<th class="hide-for-small-only">Hidden</th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $blog->entries()->orderBy( 'created_at', 'desc' )->get() as $entry )
								<tr data-click="{{ route( 'admin.blog.entry.view', [ $blog->id, $entry->id ] ) }}" data-search-element>
									<td data-search-content>{{ $entry->name }}</td>
									<td data-search-content class="hide-for-small-only">{{ $entry->slug }}</td>
									<td class="hide-for-small-only">{{ $entry->active ? 'Active' : 'Inactive' }}</td>
									<td class="hide-for-small-only">{{ $entry->hidden ? 'Hidden' : 'Visible' }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<div class="alert callout">
						<strong>There are no entries for this blog.</strong> @if ( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ) <a href="{{ route('admin.blog.entry.add', $blog->id ) }}" title="Add a new sighting entry">Add one?</a> @endif
					</div>
				@endif

				@if ( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ) <a class="primary button" href="{{ route( 'admin.blog.entry.add', $blog->id ) }}" title="Add a new sighting">Add a Post</a> @endif
				@if ( auth()->user()->hasPermission( 'admin.blog.settings.edit' ) ) <a class="secondary button hide" href="{{ route( 'admin.blog.edit', $blog->id ) }}" title="Edit this sighting">Edit Sighting</a> @endif
				@if ( auth()->user()->hasPermission( 'admin.blog.settings.edit' ) ) <a class="secondary button hide" href="{{ route( 'admin.blog.category', $blog->id ) }}" title="Edit categories this post">Edit Categories</a> @endif
				<p>Click on an entry in order to modify it</p>

			</div>
		</div>

	@else

		<div class="row">
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>The sighting you are looking for was not found.</strong>
				</div>
			</div>
		</div>

	@endif

@stop
