@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Edit Blog Category') }}</title>
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
						<span class="show-for-sr">Current: </span> Edit Blog Category
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Edit Blog Category</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@stop

@section('content')

	@if ( $blog )

		<div class="expanded row">

			<div class="small-12 columns">

				<form id="editBlogCategoryForm" method="post" action="{{ route( 'admin.blog.category.view', [ $blog->id, $category->id ] ) }}" data-form-ajax autocomplete="off" data-form-wait-title="Adding blog entry...">

					<div class="small-12">
						<label>
							Blog:
							<input type="text" value="{{ $blog->name }}" disabled="disabled">
						</label>
					</div>

					<div class="small-12">
						<label>
							Name:
							<input class="first-focus" name="name" type="text" placeholder="Name" data-url-slug="input[name=slug]" data-form-initial-value="{{ $category->name }}">
						</label>
					</div>

					<div class="small-12">
						<label>
							URL Slug:
							<div class="input-group">
								<span class="input-group-label">/{{ $blog->slug }}/</span>
								<input class="input-group-field" name="slug" type="text" placeholder="URL Slug" data-form-initial-value="{{ $category->slug }}">
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
						<button class="button primary" type="submit" data-form-submit="editBlogCategoryForm">Save Blog Category</button>
						<button type="button" class="button alert" data-open="deleteBlogCategoryModal">Delete Blog Category</button>
						<a class="button secondary" href="{{ route('admin.content.page' ) }}" title="Cancel">Cancel</a>
					</div>

				</form>

			</div>

		</div>

		<div id="deleteBlogCategoryModal" class="reveal" data-reveal>
			<form id="deleteBlogCategoryForm" method="post" action="{{ route( 'admin.blog.category.delete', [ $blog->id, $category->id ] ) }}" data-form-ajax data-form-wait-title="Deleting blog entry...">
				<h2>Delete Blog Category?</h2>
				<p><strong>Are you sure you want to delete the blog category "{{ $category->name}}"?</strong> This action cannot be undone.</p>
				<button type="submit" class="button alert">Delete Blog Category</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

	@else

		<div class="alert callout">
			<strong>The blog you specified could not be found.</strong>
		</div>

	@endif

@stop
