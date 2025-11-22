@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('My Addresses') }}</title>
@endsection

@section('title')
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>My Addresses</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@endsection

@section('content')

	<div class="row">

		<div class="small-12 columns" data-equalizer>

			@if ( $addresses->count() > 0 )

				<div class="row">

					@foreach ( $addresses as $address )
	
						@if ( $address == $addresses->last() )
							<div class="small-12 medium-6 large-4 columns end">
						@else
							<div class="small-12 medium-6 large-4 columns">
						@endif
	
							<div class="secondary callout" data-address-id="{{ $address->id }}" data-address-name="{{ $address->name }}">
	
								<div data-equalizer-watch>
	
									<h4><a href="{{ route('user.address.view', $address->id ) }}" title="View and edit this address">{{ $address->name }}</a></h4>
		
									<address>
										{!! @$address->company_name ? "{$address->company_name}<br>" : '' !!}
										{{ $address->first_name }} {{ $address->last_name }}<br>
										{{ $address->street1 }}<br>
										{!! @$address->street2 ? "{$address->street2}<br>" : '' !!}
										{!! @$address->street3 ? "{$address->street3}<br>" : '' !!}
										{{ $address->city }}, {{ state( $address->state )->name }} {{ $address->postal_code }}<br>
										{{ country( $address->country )->name }}<br>
										{{ $address->phone }}
									</address>
	
								</div>
		
								<hr>

								<p>

									@if ( $address->default_billing )
										<label><input class="setDefaultBilling" type="checkbox" checked="checked" data-address-id="{{ $address->id }}"> Default Billing Address</label>
									@else
										<label><input class="setDefaultBilling" type="checkbox" data-address-id="{{ $address->id }}"> Default Billing Address</label>
									@endif

									@if ( $address->default_shipping )
										<label><input class="setDefaultShipping" type="checkbox" checked="checked" data-address-id="{{ $address->id }}"> Default Shipping Address</label>
									@else
										<label><input class="setDefaultShipping" type="checkbox" data-address-id="{{ $address->id }}"> Default Shipping Address</label>
									@endif

								</p>

								<p>
									<div class="expanded button-group">
										<a class="button primary" href="{{ route('user.address.view', $address->id ) }}" title="View this address">View</a>
										<a class="button secondary" href="{{ route('user.address.edit', $address->id ) }}" title="Edit this address">Edit</a>
										<button class="deleteAddressButton button alert" type="button">Delete</button>
									</div>
								</p>

							</div>
	
						</div>
	
					@endforeach

				</div>

				<a class="button primary" href="{{ route('user.address.add' ) }}" title="Add a new address">Add New Address</a>

			@else

				<div data-alert class="primary callout">
					<strong>You have no addresses saved.</strong> <a href="{{ route('user.address.add' ) }}" title="Click here to add a new address">Would you like to add one?</a>
				</div>

			@endif

		</div>

	</div>

	<div id="deleteAddressModal" class="reveal" data-reveal>

		<form id="deleteAddressForm" method="post" action="" data-form-ajax data-form-ajax-reload-page>

			<div class="row collapse">
				<div class="small-12 columns">
					<h2>Delete Address</h2>
					<p><strong>Are you sure you want to delete the address "<span class="addressName"></span>"?</strong> This cannon be undone.
				</div>
			</div>

			<div class="row collapse">
				<div class="small-12 columns">
					<button type="submit" class="button alert">Delete Address</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
				</div>
			</div>

			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>

		</form>

	</div>

@endsection

@section('scripts')

	<script type="text/javascript" language="JavaScript">
	<!--

		$(document).ready( function() {

			$(".setDefaultBilling").on( "click", function(e) {

				e.preventDefault();

				var checkbox = this;

				var action = "unset";
				if ( $(this).prop("checked") ) action = "set";
				$(".setDefaultBilling").prop( "disabled", true );

				$.ajax({
			
					url: "{{ route('user.address.defaultBilling' ) }}/" + $(this).attr( "data-address-id" ),
					type: "POST",
					async: true,
					dataType: "json",

					data: {
						action: action,
						_token: "{{ csrf_token() }}"
					},
			
					success: function (response) {
			
						if ( response.success == true ) {
							if ( action == "set" ) {
								$(".setDefaultBilling:not(this)").prop( "checked", false );
								$(checkbox).prop( "checked", true );
							}
							else {
								$(checkbox).prop( "checked", false );
							}
						}
			
						// Run the error function, if it exists
						else {
							showGlobalAlert( response.message, 'alert', true );
						}
			
						$(".setDefaultBilling").prop( "disabled", false );

					},
			
					error: function (xhr, ajaxOptions, thrownError) {
						showGlobalAlert( '<strong>An error occurred: ' + thrownError + '</strong>', 'alert', true );
					},
			
					statusCode: {
						404: function() {
							showGlobalAlert( '<strong>An error occurred: 404 Page Not Found</strong>', 'alert', true );
						}
					},
			
				});

			});

			$(".setDefaultShipping").on( "click", function(e) {

				e.preventDefault();

				var checkbox = this;

				var action = "unset";
				if ( $(this).prop("checked") ) action = "set";
				$(".setDefaultShipping").prop( "disabled", true );

				$.ajax({
			
					url: "{{ route('user.address.defaultShipping' ) }}/" + $(this).attr( "data-address-id" ),
					type: "POST",
					async: true,
					dataType: "json",

					data: {
						action: action,
						_token: "{{ csrf_token() }}"
					},
			
					success: function (response) {
			
						if ( response.success == true ) {
							if ( action == "set" ) {
								$(".setDefaultShipping").prop( "checked", false );
								$(checkbox).prop( "checked", true );
							}
							else {
								$(checkbox).prop( "checked", false );
							}
						}
			
						// Run the error function, if it exists
						else {
							showGlobalAlert( response.message, 'alert', true );
						}
			
						$(".setDefaultShipping").prop( "disabled", false );

					},
			
					error: function (xhr, ajaxOptions, thrownError) {
						showGlobalAlert( '<strong>An error occurred: ' + thrownError + '</strong>', 'alert', true );
					},
			
					statusCode: {
						404: function() {
							showGlobalAlert( '<strong>An error occurred: 404 Page Not Found</strong>', 'alert', true );
						}
					},
			
				});

			});

			$(".setDefaultShipping").on( "click", function(e) {
				e.preventDefault();
			});

			// Show the set default billing address modal
			$(".setDefaultBillingButton").on( "click", function(e) {

				$("#setDefaultBillingForm").attr( "data-form-url", "{{ route('user.address.defaultBilling' ) }}/" + $(this).parents( "div.panel" ).first().attr( "data-address-id" ) );
				$("#setDefaultBillingModal .addressName").html( $(this).parents( "div.panel" ).first().attr( "data-address-name" ) );

				if ( $(this).attr( "data-current-default" ) == "1" ) {
					$("#setDefaultBillingModal .titleAction").html( "Unset" );
					$("#setDefaultBillingModal .action").html( "unset" );
				}

				$("#setDefaultBillingModal").foundation( "reveal", "open" );

			});

			// Show the set default shipping address modal
			$(".setDefaultShippingButton").on( "click", function(e) {

				$("#setDefaultShippingForm").attr( "data-form-url", "{{ route('user.address.defaultShipping' ) }}/" + $(this).parents( "div.panel" ).first().attr( "data-address-id" ) );
				$("#setDefaultShippingModal .addressName").html( $(this).parents( "div.panel" ).first().attr( "data-address-name" ) );

				if ( $(this).attr( "data-current-default" ) == "1" ) {
					$("#setDefaultShippingModal .titleAction").html( "Unset" );
					$("#setDefaultShippingModal .action").html( "unset" );
				}

				$("#setDefaultShippingModal").foundation( "reveal", "open" );

			});

			// Show the delete address modal
			$(".deleteAddressButton").on( "click", function(e) {
				$("#deleteAddressForm").attr( "data-form-url", "{{ route('user.address.delete' ) }}/" + $(this).parents( "div.callout" ).first().attr( "data-address-id" ) );
				$("#deleteAddressModal .addressName").html( $(this).parents( "div.callout" ).first().attr( "data-address-name" ) );
				$("#deleteAddressModal").foundation( "open" );
			});

		});

	//-->
	</script>

@append
