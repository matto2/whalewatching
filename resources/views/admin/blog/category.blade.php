@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Sightings Categories') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Sightings Categories
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Sightings Categories</h1>
		</div>
	</div>

@stop

@section('content')

	<div class="row columns">
		<div class="field"><input class="tableSearchBar" type="text" placeholder="Search..." data-search="#blogCategoryListTable" /></div>
	</div>

	<div class="row">
		<div class="small-12 columns">
			@if ( $blog->categories->count() )
				<table id="blogCategoryListTable" class="table-bordered table-striped table-hovered" width="100%">	
					<thead>
						<tr>
							<th width="40%">Category Name</th>
						</tr>
					</thead>	
					<tbody>
						@foreach ( $blog->categories as $category )
							<tr data-click="{{ route( 'admin.blog.category.view', [ $blog->id, $category->id ] ) }}" data-search-element>
								<td data-search-content>{{ $category->name }}</td>
							</tr>
						@endforeach
					</tbody>	
				</table>
			@else
				<div class="alert callout">
					<strong>There are no categories defined for this Sightings.</strong> <a href="{{ route( 'admin.blog.category.add', $blog->id ) }}" title="Add a new blog category">Add one?</a>
				</div>
			@endif
			<a class="button primary" href="{{ route( 'admin.blog.category.add', $blog->id ) }}" title="Add a new blog category">Add a Sightings Category</a>
		</div>
	</div>

@stop
