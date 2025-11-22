@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle( 'User Accounts' ) }}</title>
@endsection

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li>
						<span class="show-for-sr">Current: </span> User Accounts
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>User Accounts</h1>
		</div>
	</div>

@endsection

@section('content')

	<div class="expanded row columns">
		<div class="field"><input class="tableSearchBar" type="text" placeholder="Search..." data-search="#userListTable" /></div>
	</div>

	<div class="expanded row">
		<div class="small-12 columns">
			<table id="userListTable" width="100%">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th class="hide-for-small-only">Created</th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $users as $user )
						<tr data-click="{{ route('admin.user.view', $user->id ) }}" data-search-element>
							<td data-search-content>{{ $user->first_name }}</td>
							<td data-search-content>{{ $user->last_name }}</td>
							<td data-search-content>{{ $user->email }}</td>
							<td class="hide-for-small-only">{{ $user->created_at->toDateString() }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="expanded row">
		<div class="small-12 columns">
			@if ( auth()->user()->hasPermission( 'admin.user.add' ) ) <a class="primary button" href="{{ route( 'admin.user.add' ) }}" title="Add a User">Add a User<i class="add icon"></i></a> @endif
			@if ( auth()->user()->hasPermission( 'admin.user.settings.*' ) ) <a class="secondary button" href="{{ route( 'admin.user.settings' ) }}" title="Adjust user account settings">Settings</a> @endif
		</div>
	</div>

@endsection
