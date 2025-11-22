@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Blog Settings') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.blog' ) }}">Blog</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Settings
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Blog Settings</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@stop

@section('content')

	<div class="expanded row">

		<div class="small-12 columns">

			<form id="blogSettingsForm" method="post" action="{{ route('admin.blog.settings' ) }}" data-form-ajax autocomplete="off">

				<div class="secondary callout">

					<h2>Comments</h2>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="blogCommentEnable" data-form-initial-value="{{ setting( 'blogCommentEnable' ) }}">
								Allow comments
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="blogCommentLoginRequired" data-form-initial-value="{{ setting( 'blogCommentLoginRequired' ) }}">
								Users must be logged in to comment
							</label>
						</div>
					</div>

				</div>

				<div class="secondary callout">

					<h2>Blog Entry Defaults</h2>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="blogEntryActiveDefault" data-form-initial-value="{{ setting( 'blogEntryActiveDefault' ) }}">
								Entry is actiive
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="blogEntryActiveDefault" data-form-initial-value="{{ setting( 'blogEntryHiddenDefault' ) }}">
								Entry is hidden (can only be accessed if the visitor knows the URL)
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="blogEntryAllowCommentsDefault" data-form-initial-value="{{ setting( 'blogEntryAllowCommentsDefault' ) }}">
								Allow comments (if comments are enabled)
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="blogEntryRestrictedDefault" data-form-initial-value="{{ setting( 'blogEntryRestrictedDefault' ) }}">
								User must be logged in to view entry
							</label>
						</div>
					</div>

				</div>

				<button class="button primary" type="submit">Save Changes</button>
				<a class="button secondary" href="{{ route('admin.blog' ) }}" title="Return to the main blog administration page">Cancel</a>

			</form>

		</div>

	</div>

@stop
