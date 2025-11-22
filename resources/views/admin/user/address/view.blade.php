@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('Edit User Address') }}</title>
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
						<span class="show-for-sr">Current: </span> View Address
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>Edit User Address</h1>
		</div>
	</div>

@stop

@section('content')

	<div class="expanded row">

		<div class="small-12 columns">

			@if ( $address )

				<div data-alert class="primary callout">
					<strong>To edit this address, make any necessary changes below, then click "Save Changes".</strong>
				</div>

				<form id="editAddressForm" method="post" action="{{ route('admin.user.address.view', [ $user->id, $address->id ] ) }}" data-form-ajax>
	
					<input type="hidden" name="addressCountry" value="USA">
	
					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Name This Address:
								<input class="first-focus" type="text" name="addressName" placeholder="Name This Address" value="{{ $address->name }}">
							</label>
						</div>
					</div>
	
					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Company Name:
								<input type="text" name="addressCompanyName" placeholder="Optional Company Name" value="{{ $address->company_name }}">
							</label>
						</div>
					</div>
	
					<div class="expanded row">
						<div class="small-6 columns">
							<label>
								First Name:
								<input type="text" name="addressFirstName" placeholder="First Name" value="{{ $address->first_name }}">
							</label>
						</div>
						<div class="small-6 columns">
							<label>
								First Name:
								<input type="text" name="addressLastName" placeholder="Last Name" value="{{ $address->last_name }}">
							</label>
						</div>
					</div>
	
					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Address:
								<input type="text" name="addressStreet1" placeholder="Street Address Line 1" value="{{ $address->street1 }}">
								<input type="text" name="addressStreet2" placeholder="Optional Street Address Line 2" value="{{ $address->street2 }}">
								<input type="text" name="addressStreet3" placeholder="Optional Street Address Line 3" value="{{ $address->street3 }}">
							</label>
						</div>
					</div>
	
					<div class="expanded row">
						<div class="small-4 columns">
							<label>
								City:
								<input type="text" name="addressCity" placeholder="City" value="{{ $address->city }}">
							</label>
						</div>
						<div class="small-4 columns">
							<label>
								State:
								<select name="addressState">
									@foreach ( $states as $state )
										@if ( $address->state == $state->abbreviation )
											<option value="{{ $state->abbreviation }}" selected="selected">{{ $state->name }}</option>
										@else
											<option value="{{ $state->abbreviation }}">{{ $state->name }}</option>
										@endif
									@endforeach
								</select>
							</label>
						</div>
						<div class="small-4 columns">
							<label>
								Postal Code:
								<input type="text" name="addressPostalCode" placeholder="Postal Code" value="{{ $address->postal_code }}">
							</label>
						</div>
					</div>
	
					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Phone Number:
								<input type="text" name="addressPhone" placeholder="Phone Number" value="{{ $address->phone }}">
							</label>
						</div>
					</div>
	
					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								@if ( $address->default_billing )
									<input type="checkbox" name="addressDefaultBilling" value="1" checked="checked"> Make this my default billing address
								@else
									<input type="checkbox" name="addressDefaultBilling" value="1"> Make this my default billing address
								@endif
							</label>
							<label>
								@if ( $address->default_shipping )
									<input type="checkbox" name="addressDefaultShipping" value="1" checked="checked"> Make this my default shipping address
								@else
									<input type="checkbox" name="addressDefaultShipping" value="1"> Make this my default shipping address
								@endif
							</label>
						</div>
					</div>
	
					@if ( $address )
						<button class="button primary" type="submit" data-submit-form="editAddressForm">Save Changes</button>
						<button class="button alert" type="button" data-open="deleteAddressModal">Delete Address</button>
					@endif
					<a class="button secondary" href="{{ route('admin.user.view', $user->id ) }}" title="Return to the user's account page">Cancel</a>

				</form>

				<div id="deleteAddressModal" class="reveal">
			
					<form id="deleteAddressForm" method="post" action="{{ route('admin.user.address.delete', [ $user->id, $address->id ] ) }}" data-form-ajax>
			
						<div class="row collapse">
							<div class="small-12 columns">
								<h2>Delete Address</h2>
								<p><strong>Are you sure you want to delete the address "{{ $address->name }}"?</strong> This cannon be undone.
							</div>
						</div>
			
						<div class="row collapse">
							<div class="small-12 columns">
								<button type="submit" class="button alert">Delete Address</button>
								<button type="button" class="close_modal button secondary">Cancel</button>
							</div>
						</div>
			
						<a class="close-reveal-modal">&#215;</a>
			
					</form>
			
				</div>

			@else

				<div class="alert callout">
					<strong>The address you are trying to edit could not be found.</strong></a>
				</div>

				<a class="button primary" href="{{ route('admin.user.view', $user->id ) }}" title="Return to the User Administration page">Return to User</a>

			@endif

		</div>

	</div>

@stop

@section('scripts')
@append
