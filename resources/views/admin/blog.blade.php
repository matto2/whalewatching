@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Posts') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Posts
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Posts</h1>
		</div>
	</div>

@stop

@section('content')

	<div class="expanded row columns">
		<div class="field"><input class="tableSearchBar" type="text" placeholder="Search..." data-search="#blogEntryListTable" /></div>
	</div>

	<div class="expanded row">
		<div class="small-12 columns">
			@if ( $blogs && count( $blogs ) > 0 )

				<table id="blogEntryListTable" class="table-bordered table-striped table-hovered" width="100%">	
					<thead>
						<tr>
							<th>Post Category</th>
							<th class="hide-for-small-only">URL (page)</th>
							<th class="hide-for-small-only">Posts</th>
						</tr>
					</thead>	
					<tbody>
						@foreach ( $blogs as $blog )
							<tr data-click="{{ route('admin.blog.view', $blog->id ) }}" data-search-element>
								<td data-search-content>{{ $blog->name }}</td>
								<td data-search-content class="hide-for-small-only">/{{ $blog->slug }}</td>
								<td class="hide-for-small-only">{{ $blog->entries->count() }}</td>
							</tr>
						@endforeach
					</tbody>	
				</table>

			@else
				<div class="alert callout">
					<strong>There are no Posts.</strong> @if ( auth()->user()->hasPermission( 'admin.blog.entry.add' ) ) <a href="{{ route('admin.blog.add' ) }}" title="Add a new post?">Add one?</a> @endif
				</div>
			@endif
			@if ( auth()->user()->hasPermission( 'admin.blog.entry.add' ) )
				<a class="button primary hide" href="{{ route('admin.blog.add' ) }}" title="Add a new post">Add a New Posting Category</a>
			@endif
		</div>
	</div>

@stop
