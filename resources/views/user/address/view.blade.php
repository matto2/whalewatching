@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('View/Edit Addresses') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>View/Edit Address</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns">

			@if ( $address )

				<div id="deleteAddressModal" class="reveal" data-reveal>
			
					<form id="deleteAddressForm" method="post" action="{{ route('user.address.delete', $address->id ) }}" data-form-ajax>
			
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
			
						<a class="button secondary" href="{{ route('user.address' ) }}" title="Go to the My Addresses page">Go To My Addresses</a>
						@if ( $address )
							<button class="button alert" type="submit" data-open="deleteAddressModal">Delete Address</button>
							<a class="button primary" href="{{ route('user.address.edit', $address->id ) }}" title="Edit this address">Edit Address</a>
						@endif

					</form>
			
				</div>

			@else

				<div data-alert class="error-alert alert-box alert">
					<strong>The address you are trying to view could not be found.</strong>
				</div>

				<a class="button primary" href="{{ route('user.address' ) }}" title="Return to the My Addresses page">Return to My Addresses</a>

			@endif

		</div>

	</div>

@endsection

@section('scripts')
@append
