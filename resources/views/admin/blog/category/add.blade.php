@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Add a Blog Category') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.blog' ) }}">Blog</a></li>
					<li><a href="{{ route( 'admin.blog.view', $blog->id ) }}">{{ $blog->name }}</a></li>
					<li><a href="{{ route( 'admin.blog.category', $blog->id ) }}">Categories</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Add a Blog Category
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Add a Blog Category</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@stop

@section('content')

	@if ( $blog )

		<div class="expanded row">
	
			<div class="small-12 columns">
	
				<form id="addBlogCategoryForm" method="post" action="{{ route( 'admin.blog.category.add', $blog->id ) }}" data-form-ajax autocomplete="off" data-form-ajax-clear data-form-wait-title="Adding blog category...">
	
					<div class="small-12">
						<label>
							Blog:
							<input type="text" value="{{ $blog->name }}" disabled="disabled">
						</label>
					</div>

					<div class="small-12">
						<label>
							Name:
							<input class="first-focus" name="name" type="text" placeholder="Name" data-url-slug="input[name=slug]">
						</label>
					</div>
	
					<div class="small-12">
						<label>
							URL Slug:
							<div class="input-group">
								<span class="input-group-label">/{{ $blog->slug }}/</span>
								<input class="input-group-field" name="slug" type="text" placeholder="URL Slug">
							</div>
						</label>
					</div>
	
					<div class="small-12">
						<label>
							<input name="active" type="checkbox" checked="checked">
							This blog category is active
						</label>
					</div>
	
					<div class="small-12">
						<button class="button primary" type="submit" data-form-submit="addBlogCategoryForm">Add Blog Category</button>
						<a class="button secondary" href="{{ route( 'admin.blog.category', $blog->id ) }}" title="Cancel">Cancel</a>
					</div>
	
				</form>
	
			</div>
	
		</div>

	@else

		<div class="alert callout">
			<strong>The blog you specified could not be found.</strong>
		</div>

	@endif

@stop
