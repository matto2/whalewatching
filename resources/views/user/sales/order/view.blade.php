@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('View Order') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'user' ) }}">My Account</a></li>
					<li><a href="{{ route( 'user.sales.order' ) }}">My Orders</a></li>
					<li>
						<span class="show-for-sr">Current: </span> View Order
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Order {{ $order->id or "Unknown" }}</h1>
		</div>
	</div>

@stop

@section('content')

	@if ( $order )
	
		<div class="row" data-equalizer>
	
			<div class="small-12 medium-6 columns">
	
				<div class="secondary callout" data-equalizer-watch>
					<h3>Billing Address</h3>
					{!! @$order->billingCompany ? "{$order->billingCompany}<br />" : '' !!}
					{{ $order->billingFirstName }} {{ $order->billingLastName }}<br />
					{{ $order->billingStreet1 }}<br />
					{!! @$order->billingStreet2 ? "{$order->billingStreet2}<br />" : '' !!}
					{!! @$order->billingStreet3 ? "{$order->billingStreet3}<br />" : '' !!}
					{{ $order->billingCity }}, {{ $order->billingState }} {{ $order->billingPostalCode }}<br />
					{{ @countries()->where( 'code', $order->billingCountry )->first()->name }}
				</div>
	
			</div>
	
			<div class="small-12 medium-6 columns">
	
				<div class="secondary callout" data-equalizer-watch>
					<h3>Shipping Address</h3>
					{!! @$order->shippingCompany ? "{$order->shippingCompany}<br />" : '' !!}
					{{ $order->shippingFirstName }} {{ $order->shippingLastName }}<br />
					{{ $order->shippingStreet1 }}<br />
					{!! @$order->shippingStreet2 ? "{$order->shippingStreet2}<br />" : '' !!}
					{!! @$order->shippingStreet3 ? "{$order->shippingStreet3}<br />" : '' !!}
					{{ $order->shippingCity }}, {{ $order->shippingState }} {{ $order->shippingPostalCode }}<br />
					{{ @countries()->where( 'code', $order->shippingCountry )->first()->name }}
				</div>
	
			</div>
	
		</div>
	
		<div class="row">
	
			<div class="small-12 columns">
	
				<table id="cartTable">
	
					<thead>
						<tr>
							<th>Item</th>
							<th class="text-right">Unit Cost</th>
							<th class="text-center">Qty</th>
							<th class="text-right">Ext Cost</th>
						</tr>
					</thead>
	
					<tbody>
						@foreach( $order->items()->get() as $item )
							<tr data-row-id="{{ $item->rowid }}">
								<td>{{ $item->name }}</td>
								<td class="alignTop text-right" width="15%">{{ sprintf( "$%0.2f", $item->price ) }}</td>
								<td class="alignTop text-center" width="10%">{{ $item->quantity }}</td>
								<td class="alignTop itemExtCost text-right" width="15%">{{ sprintf( "$%0.2f", $item->price * $item->quantity ) }}</td>
							</tr>
						@endforeach
					</tbody>
	
					<tfoot>
						<tr>
							<td class="text-right" colspan="3"><strong>Subtotal</strong></td>
							<td class="cartSubtotal text-right"><strong>${{ number_format( $order->subtotal, 2 ) }}</strong></td>
						</tr>
						<tr>
							<td class="text-right" colspan="3"><strong>Tax ({{ number_format( $order->tax_rate, 2 ) }}%)</strong></td>
							<td class="cartSubtotal text-right"><strong>${{ number_format( $order->tax, 2 ) }}</strong></td>
						</tr>
						<tr>
							<td class="text-right" colspan="3"><strong>Shipping</strong></td>
							<td class="cartSubtotal text-right"><strong>${{ number_format( $order->shipping, 2 ) }}</strong></td>
						</tr>
						<tr>
							<td class="text-right" colspan="3"><strong>Total</strong></td>
							<td class="cartSubtotal text-right"><strong>${{ number_format( $order->total, 2 ) }}</strong></td>
						</tr>
						<tr>
							<td class="text-right" colspan="3"><strong>Paid by {{ ucfirst( $order->payments()->first()->method() ) }}</strong></td>
							<td class="text-right"><strong>${{ number_format( $order->payments()->first()->amount, 2 ) }}</strong></td>
						</tr>
					</tfoot>
	
				</table>
	
			</div>
	
		</div>

	@else

		<div class="row" data-equalizer>
			<div class="small-12 columns">
				<div class="alert callout">
					<strong>The order you are looking for could not be found</strong>.
				</div>
			</div>
		</div>

	@endif

@stop
