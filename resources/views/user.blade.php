@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('My Account') }}</title>
@stop

@section('title')
	<div id="pageTitle" class="row collapse">
		<div class="small-12 columns">
			<h1>My Account</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
@stop

@section('content')

	<div class="row" data-equalizer>

		<div class="small-12 medium-6 columns">

			<div class="secondary callout" data-equalizer-watch>

				<h2>My Account</h2>
				
				<p><strong>{{ $user->first_name }} {{ $user->last_name }}</strong><br>{{ $user->email }}</p>

				<p>
					<a class="secondary button" href="{{ route('user.email' ) }}" title="Change my e-mail address">Change E-Mail Address</a>
					<a class="secondary button" href="{{ route('user.password' ) }}" title="Change my password">Change Password</a>
					<a class="secondary button" href="{{ route('user.address' ) }}" title="Manage my addresses">Addresses</a>
				</p>
				
			</div>
			
		</div>

		<div class="small-12 medium-6 columns">

			<div class="secondary callout" data-equalizer-watch>

				<h2>Recent Orders</h2>

				@if ( $user->orders->count() )
			
					<table id="orderListTable" class="hover">
	
						<thead>
							<tr>
								<th>Order #</th>
								<th>Order Date</th>
								<th class="text-right">Total</th>
							</tr>
						</thead>
	
						<tbody>
							@foreach ( $user->orders->sortByDesc( 'created_at' )->take( 5 ) as $order )
								<tr data-click="{{ route('user.sales.order.view', $order->id ) }}" data-search-element>
									<td data-search-content>{{ $order->id }}</td>
									<td data-search-content>{{ \Carbon\Carbon::parse( $order->created_on )->format( 'm/d/Y' ) }}</td>
									<td class="text-right" data-search-content>${{ number_format( $order->total, 2 ) }}</td>
								</tr>
							@endforeach
						</tbody>
	
					</table>
			
					<a class="primary button" href="{{ route( 'user.sales.order') }}" title="View My Orders">View All Orders</a>

				@else
			
					<div class="row">
						<div class="small-12 columns">
							<div class="alert callout"><strong>You have no orders.</strong></div>
						</div>
					</div>
			
				@endif

			</div>

		</div>

	</div>

@stop
