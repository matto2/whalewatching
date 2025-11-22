@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Edit a Sighting') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.blog' ) }}">Sightings</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Edit Sightings
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Edit Sightings</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@stop

@section('content')

	@if ( $blog )

		<div class="row">	
			<div class="small-12 columns">	
				<form id="editBlogForm" method="post" action="{{ route( 'admin.blog.view', $blog->id ) }}" data-form-ajax autocomplete="off" data-form-ajax-clear data-form-wait-title="Saving your changes...">	
					<div class="secondary callout">	
						<div class="small-12">
							<label>
								Name:
								<input class="first-focus" name="name" type="text" placeholder="Name" data-url-slug="input[name=slug]" data-form-initial-value="{{ $blog->name }}">
							</label>
						</div>	
						<div class="small-12">
							<label>
								URL Slug:
								<div class="input-group">
									<span class="input-group-label">/</span>
									<input class="input-group-field" name="slug" type="text" placeholder="URL Slug" data-form-initial-value="{{ $blog->slug }}">
								</div>
							</label>
						</div>	
					</div>
	
					<div class="small-12">	
						<div class="secondary callout">	
							<h2>Blog Options</h2>	
							<label><input name="active" type="checkbox" data-form-initial-value="{{ $blog->active }}">This sighting is active</label>
							<label><input name="hidden" type="checkbox" data-form-initial-value="{{ $blog->hidden }}">This sighting is hidden (can only be accessed if the visitor knows the URL)</label>
							<label><input name="restricted" type="checkbox" data-form-initial-value="{{ $blog->restricted }}">Users must be logged in to see this sighting</label>	
							<label><input name="comments" type="checkbox" data-form-initial-value="{{ $blog->allow_comments }}">Allow comments</label>	
						</div>	
					</div>
	
					<div class="small-12">
						<button class="button primary" type="submit" data-form-submit="editBlogForm">Save Changes</button>
						@if ( auth()->user()->hasPermission( 'admin.blog.delete' ) ) <button class="alert button" type="button" data-open="deleteBlogModal">Delete Sighting</button> @endif
						<a class="button secondary" href="{{ route( 'admin.blog' ) }}" title="Cancel">Cancel</a>
					</div>	
				</form>	
			</div>	
		</div>
	
		<div id="deleteBlogModal" class="reveal" data-reveal>
			<form id="deleteBlogForm" method="post" action="{{ route( 'admin.blog.delete', $blog->id ) }}" data-form-ajax data-form-wait-title="Deleting Sighting...">
				<h2>Delete Sighting?</h2>
				<p><strong>Are you sure you want to delete the Sighting "{{ $blog->name}}"?</strong> All Sighting entries in this Sighting will be deleted. This action cannot be undone.</p>
				<button type="submit" class="button alert">Delete Sighting</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

	@else
		<div class="expanded row columns">
			<div class="alert callout">
				<strong>The Sighting you are looking for could not be found.</div>
			</div>
		</div>
	@endif

@stop
