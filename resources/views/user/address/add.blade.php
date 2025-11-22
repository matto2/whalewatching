@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('Add a New Address') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Add a New Address</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			<form id="addAddressForm" method="post" action="{{ route('user.address.add' ) }}" data-form-ajax data-form-ajax-clear autocomplete="off">

				<div class="row">
					<div class="small-12 columns">
						<label>
							Name This Address:
							<input class="first-focus" type="text" name="addressName" placeholder="Name This Address">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="small-12 columns">
						<label>
							Company Name:
							<input type="text" name="addressCompanyName" placeholder="Optional Company Name">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="small-6 columns">
						<label>
							First Name:
							<input type="text" name="addressFirstName" placeholder="First Name" value="{{ Auth::user()->first_name }}">
						</label>
					</div>
					<div class="small-6 columns">
						<label>
							First Name:
							<input type="text" name="addressLastName" placeholder="Last Name" value="{{ Auth::user()->last_name }}">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="small-12 columns">
						<label>
							Address:
							<input type="text" name="addressStreet1" placeholder="Street Address Line 1">
							<input type="text" name="addressStreet2" placeholder="Optional Street Address Line 2">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="small-12 columns">
						<label>
							Country:
							<select name="addressCountry" data-state-select="select[name=addressState]">
								<option value="0">--- Choose Country ---</option>
								@foreach ( countries()->where( 'active', true )->sortBy( 'name' ) as $country )
									<option value="{{ $country->id }}" data-country-id="{{ $country->id }}">{{ $country->name }}</option>
								@endforeach
							</select>
						</label>
					</div>
				</div>

				<div class="row">
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
								@foreach ( states() as $state )
									<option value="{{ $state->abbreviation }}" data-country-id="{{ $state->country_id }}" hidden="hidden">{{ $state->name }}</option>
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

				<div class="row">
					<div class="small-12 columns">
						<label>
							Phone Number:
							<input type="text" name="addressPhone" placeholder="Phone Number">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="small-12 columns">
						<label>
							<input type="checkbox" name="addressDefaultBilling"> Make this my default billing address
						</label>
						<label>
							<input type="checkbox" name="addressDefaultShipping"> Make this my default shipping address
						</label>
					</div>
				</div>

				<button class="button primary" type="submit">Save Address</button>

			</form>

		</div>

	</div>

@endsection

