@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Edit Addresses') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Edit Address</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			@if ( $address )

				<div class="primary callout">
					<strong>To edit this address, make any necessary changes and then click "Save Changes" below.</strong></a>
				</div>

				<form id="editAddressForm" method="post" action="{{ route('user.address.edit', $address->id ) }}" data-form-ajax>
	
					<div class="row">
						<div class="small-12 columns">
							<label>
								Name This Address:
								<input class="first-focus" type="text" name="addressName" placeholder="Name This Address" data-form-initial-value="{{ $address->name }}">
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="small-12 columns">
							<label>
								Company Name:
								<input type="text" name="addressCompanyName" placeholder="Optional Company Name" data-form-initial-value="{{ $address->company_name }}">
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="small-12 medium-6 columns">
							<label>
								First Name:
								<input type="text" name="addressFirstName" placeholder="First Name" data-form-initial-value="{{ $address->first_name }}">
							</label>
						</div>
						<div class="small-12 medium-6 columns">
							<label>
								First Name:
								<input type="text" name="addressLastName" placeholder="Last Name" data-form-initial-value="{{ $address->last_name }}">
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="small-12 columns">
							<label>
								Address:
								<input type="text" name="addressStreet1" placeholder="Street Address Line 1" data-form-initial-value="{{ $address->street1 }}">
								<input type="text" name="addressStreet2" placeholder="Optional Street Address Line 2" data-form-initial-value="{{ $address->street2 }}">
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="small-12 medium-4 columns">
							<label>
								City:
								<input type="text" name="addressCity" placeholder="City" data-form-initial-value="{{ $address->city }}">
							</label>
						</div>
						<div class="small-12 medium-4 columns">
							<label>
								State:
								<select name="addressState" data-form-initial-value="{{ $address->state }}">
									@foreach ( $states as $state )
										<option value="{{ $state->id }}">{{ $state->name }}</option>
									@endforeach
								</select>
							</label>
						</div>
						<div class="small-12 medium-4 columns">
							<label>
								Postal Code:
								<input type="text" name="addressPostalCode" placeholder="Postal Code" data-form-initial-value="{{ $address->postal_code }}">
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="small-12 columns">
							<label>
								Country:
								<select name="addressCountry" data-form-initial-value="{{ $address->country }}">
									@foreach ( countries() as $country )
										<option value="{{ $country->id }}">{{ $country->name }}</option>
									@endforeach
								</select>
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="small-12 columns">
							<label>
								Phone Number:
								<input type="text" name="addressPhone" placeholder="Phone Number" data-form-initial-value="{{ $address->phone }}">
							</label>
						</div>
					</div>
	
					<div class="row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="addressDefaultBilling" data-form-initial-value="{{ $address->default_billing }}"> Make this my default billing address
							</label>
							<label>
								<input type="checkbox" name="addressDefaultShipping" data-form-initial-value="{{ $address->default_shipping }}"> Make this my default shipping address
							</label>
						</div>
					</div>
	
					@if ( $address )
						<button class="button primary" type="submit" data-submit-form="editAddressForm">Save Changes</button>
						<button class="button alert" type="submit" data-open="deleteAddressModal">Delete Address</button>
					@endif
					<a class="button secondary" href="{{ route('user.address' ) }}" title="Go to the My Addresses page">Go To My Addresses</a>

				</form>

				<div id="deleteAddressModal" class="reveal" data-reveal>
			
					<form id="deleteAddressForm" data-url="{{ route('user.address.delete', $address->id ) }}">
			
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
			
						<a class="close-reveal">&#215;</a>
			
					</form>
			
				</div>

			@else

				<div data-alert class="error-alert alert-box alert">
					<strong>The address you are trying to edit could not be found.</strong></a>
				</div>

				<a class="button primary" href="{{ route('user.address' ) }}" title="Return to the My Addresses page">Return to My Addresses</a>

			@endif

		</div>

	</div>

@endsection

@section('scripts')
@append
