@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Sighting Entries') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Sighting Entries
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Sighting Entries</h1>
		</div>
	</div>

@stop

@section('content')

	@if ( $blog )

		<div class="expanded row columns">
			<div class="field"><input class="tableSearchBar" type="text" placeholder="Search..." data-search="#blogEntryListTable" /></div>
		</div>

		<div class="expanded row">
			<div class="small-12 columns">
				@if ( $entries && count( $entries ) > 0 )
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
							@foreach ( $entries as $entry )
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
						<strong>There are no Sighting entries.</strong> @if ( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ) <a href="{{ route( 'admin.blog.entry.add', $blog->id ) }}" title="Add a new blog entry">Add one?</a> @endif
					</div>
				@endif
				@if ( auth()->user()->hasPermission( 'admin.blog.entry.add' ) )
					<a class="button primary" href="{{ route( 'admin.blog.entry.add', $blog->id ) }}" title="Add a new blog entry">Add a Sighting</a>
				@endif
			</div>
		</div>

	@else
		<div class="expanded row columns">
			<div class="alert callout">
				<strong>The Sighting you specified was not found.</strong>
			</div>
			<a class="primary button" href="{{ route( 'admin.blog' ) }}" title="Return to the list of blogs">Return to Sightings</a>
		</div>
	@endif

@stop
