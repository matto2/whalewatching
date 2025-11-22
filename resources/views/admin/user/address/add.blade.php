@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Add a New User Address') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.user' ) }}">User Accounts</a></li>
					<li><a href="{{ route( 'admin.user.view', $user->id ) }}">View User</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Add New Address
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Add a New Address</h1>
		</div>
	</div>

@stop

@section('content')

	<div class="expanded row">

		<div class="small-12 columns">

			<form id="addAddressForm" method="post" action="{{ route('admin.user.address.add', $user->id ) }}" data-form-ajax autocomplete="off">

				<div class="expanded row">
					<div class="small-12 columns">
						<label>
							Name This Address:
							<input class="first-focus" type="text" name="addressName" placeholder="Name This Address">
						</label>
					</div>
				</div>

				<div class="expanded row">
					<div class="small-12 columns">
						<label>
							Company Name:
							<input type="text" name="addressCompanyName" placeholder="Optional Company Name">
						</label>
					</div>
				</div>

				<div class="expanded row">
					<div class="small-6 columns">
						<label>
							First Name:
							<input type="text" name="addressFirstName" placeholder="First Name" value="{{ $user->first_name }}">
						</label>
					</div>
					<div class="small-6 columns">
						<label>
							First Name:
							<input type="text" name="addressLastName" placeholder="Last Name" value="{{ $user->last_name }}">
						</label>
					</div>
				</div>

				<div class="expanded row">
					<div class="small-12 columns">
						<label>
							Address:
							<input type="text" name="addressStreet1" placeholder="Street Address Line 1">
							<input type="text" name="addressStreet2" placeholder="Optional Street Address Line 2">
							<input type="text" name="addressStreet3" placeholder="Optional Street Address Line 3">
						</label>
					</div>
				</div>

				<div class="expanded row">
					<div class="small-12 columns">
						<label>
							Country:
							<select name="addressCountry">
								<option value="0">--- Choose Country ---</option>
								@foreach ( countries()->sortBy('name') as $country )
									<option value="{{ $country->code }}">{{ $country->name }}</option>
								@endforeach
							</select>
						</label>
					</div>
				</div>

				<div class="expanded row">
					<div class="small-4 columns">
						<label>
							City:
							<input type="text" name="addressCity" placeholder="City">
						</label>
					</div>
					<div class="small-4 columns">
						<label>
							State:
							<select name="addressState">
								<option value="0">--- Choose State ---</option>
								@foreach ( $states as $state )
									<option value="{{ $state->abbreviation }}">{{ $state->name }}</option>
								@endforeach
							</select>
						</label>
					</div>
					<div class="small-4 columns">
						<label>
							Postal Code:
							<input type="text" name="addressPostalCode" placeholder="Postal Code">
						</label>
					</div>
				</div>

				<div class="expanded row">
					<div class="small-12 columns">
						<label>
							Phone Number:
							<input type="text" name="addressPhone" placeholder="Phone Number">
						</label>
					</div>
				</div>

				<div class="expanded row">
					<div class="small-12 columns">
						<label>
							<input type="checkbox" name="addressDefaultBilling" value="1"> Make this the default billing address
						</label>
						<label>
							<input type="checkbox" name="addressDefaultShipping" value="1"> Make this the default shipping address
						</label>
					</div>
				</div>

				<button class="button primary" type="submit" data-form-submit="addAddressForm">Save Address</button>
				<a class="button secondary" href="{{ route('admin.user.view', $user->id ) }}" title="Return to the user's account page">Cancel</a>

			</form>

		</div>

	</div>

@stop
