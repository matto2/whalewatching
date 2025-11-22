@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Add a Blog') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.blog' ) }}">Post</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Add a Blog
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Add a Blog</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@stop

@section('content')

	<div class="row">
		<div class="small-12 columns">
			<form id="addBlogForm" method="post" action="{{ route( 'admin.blog.add' ) }}" data-form-ajax autocomplete="off" data-form-ajax-clear data-form-wait-title="Adding sighting...">

				<div class="secondary callout">
					<h2>Entry Details</h2>
					<div class="small-12">
						<label>Name: <input class="first-focus" name="name" type="text" placeholder="Name" data-url-slug="input[name=slug]"></label>
					</div>
					<div class="small-12">
						<label>
							URL Slug:
							<div class="input-group">
								<span class="input-group-label">/</span>
								<input class="input-group-field" name="slug" type="text" placeholder="URL Slug">
							</div>
						</label>
					</div>
				</div>

				<div class="small-12">
					<div class="secondary callout">
						<h2>Blog Options</h2>
						<label><input name="active" type="checkbox" data-form-initial-value="{{ setting( 'blogActiveDefault' ) }}">This sighting is active</label>
						<label><input name="hidden" type="checkbox" data-form-initial-value="{{ setting( 'blogHiddenDefault' ) }}">This sighting is hidden (can only be accessed if the visitor knows the URL)</label>
						<label><input name="restricted" type="checkbox" data-form-initial-value="{{ setting( 'blogRestrictedDefault' ) }}">Users must be logged in to see this sighting</label>
						<label><input name="comments" type="checkbox" data-form-initial-value="{{ setting( 'blogAllowCommentsDefault' ) }}">Allow comments</label>
					</div>
				</div>

				<div class="small-12">
					<button class="button primary" type="submit" data-form-submit="addBlogForm">Add Blog</button>
					<a class="button secondary" href="{{ route('admin.blog' ) }}" title="Cancel">Cancel</a>
				</div>

			</form>
		</div>
	</div>

@stop
