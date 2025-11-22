@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Administration') }}</title>
@endsection

@section('title')
	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Administration
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Administration</h1>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">
		@if ( auth()->user()->hasPermission( 'admin.user.*' ) )
	<div class="columns p0">
				<div class="secondary callout">
						<h2>Accounts &amp; Users</h2>

						<div class="small-12 medium-4 columns">
							<ul class="vertical menu">
@if ( auth()->user()->hasPermission( 'admin.user.add' ) ) <li><a href="{{ route( 'admin.user.add' ) }}">Add New User</a></li> @endif
	</ul>
						</div>
						<div class="small-12 medium-4 columns">
							<ul class="vertical menu">
								<li><a href="{{ route( 'admin.user' ) }}">View Users</a></li>
							</ul>
						</div>
						<div class="small-12 medium-4 columns">
							<ul class="vertical menu">
								@if ( auth()->user()->hasPermission( 'admin.user.settings.*' ) )
									<li><a href="{{ route( 'admin.user.settings' ) }}">Settings</a></li>
								@endif
							</ul>
						</div>
					<p class="holder">&nbsp;</p>
				</div>
			</div>

		@endif

		@if ( auth()->user()->hasPermission( 'admin.blog.*' ) )
			<div class="small-12 columns p0">
				<div class="secondary callout">
					<div class="row">
						<div class="columns p0">
							<div class="small-12 medium-6 columns">
								<h2>5 Recent Posts</h2>
							</div>
							<div class="small-12 medium-6 columns">
								<a class="primary button mb0" href="{{ route( 'admin.blog' ) }}" title="Manage Posts">Go to Sightings Posts</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="columns p0">
			@if ( count( $entries = \App\Models\Blog\BlogEntry::orderBy( 'created_at', 'desc' )->take( 5 )->get() ) > 0 )
				<ul class="posts">
					@foreach ( $entries as $entry )
						<li><a href="{{ route( 'admin.blog.entry.view', [ $entry->blog_id, $entry->id ] ) }}" title="Edit this entry">{{ $entry->name }}</a></li>
					@endforeach
				</ul>
			@else
								<div class="callout">
									There are no Sighting entries.
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection
