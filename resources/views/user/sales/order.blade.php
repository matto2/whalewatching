@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('My Orders') }}</title>
@stop

@section('title')

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'user' ) }}">My Account</a></li>
					<li>
						<span class="show-for-sr">Current: </span> My Orders
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>MyOrders</h1>
		</div>
	</div>

@stop

@section('content')

	@if ( $orders->count() )

		<div class="row">

			<div class="small-12 columns">

				<table id="orderListTable" class="hover">

					<thead>
						<tr>
							<th>Order #</th>
							<th>Order Date</th>
							<th class="text-right">Total</th>
						</tr>
					</thead>

					<tbody>
						@foreach ( $orders as $order )
							<tr data-click="{{ route('user.sales.order.view', $order->id ) }}" data-search-element>
								<td data-search-content>{{ $order->id }}</td>
								<td data-search-content>{{ \Carbon\Carbon::parse( $order->created_on )->format( 'm/d/Y' ) }}</td>
								<td class="text-right" data-search-content>${{ number_format( $order->total, 2 ) }}</td>
							</tr>
						@endforeach
					</tbody>

				</table>

			</div>

		</div>

	@else

		<div class="row">
			<div class="small-12 columns">
				<div class="alert callout"><strong>You have no orders.</strong></div>
			</div>
		</div>

	@endif

@stop
