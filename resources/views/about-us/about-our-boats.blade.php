@extends('layouts.frontend')

@section('head')
	<title>{{ pageTitle('About Our Boats') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>About Our Boats</h1>

					<h5>Experience Whale Watching on the Velocity &amp; Legacy</h5>

					<p><img src="/images/velocityfull.jpg" alt="Velocity"></p>

					<p>Stagnaro Charter Boats proudly presents the charter boat Velocity. Built by Yank Marine, Inc., in Tuckahoe, New Jersey, she was completed in California in 2005 and complies with all the latest safety standards. Velocity is 60′ long and is certified by the U.S. Coast Guard to carry 64 passengers. She is the only charter boat on Monterey Bay to feature a full service galley and serves both breakfast and lunch items as well as your favorite beverage. Velocity is equipped with comfortable interior high back seating. Her spacious walk-around deck and exterior seating make her a great choice for whale watching and scenic tours. Indeed, Velocity is speedy so you spend less time traveling and more time watching marine life.</p>

					<p><img src="/images/legacy.jpg" alt="Legacy"></p>

					<p>Stagnaro Charter Boats is pleased to introduce a new addition to our fleet, joining Velocity at Dock F this season. Our new boat Legacy is a 56′ fiberglass Westport yacht, featuring a spacious deck and deluxe interiors plus comfortable galley, snack bar/beer/wine and restroom amenities. Legacy can accommodate passengers for public or private fishing excursions. With this gorgeous new addition to our fleet, we are excited to offer more opportunities for our neighbors and visitors alike to go fishing, or for a relaxing cruise on Monterey Bay.</p>

					<p><em>SEE THE BAY THE VELOCITY &amp; LEGACY WAY!</em></p>

					<p>** Velocity and Legacy are licensed beer and wine vessels. No outside alcohol may be brought on board. Coolers longer than 20 inches in length are not allowed.</p>

					<p>***Velocity and Legacy are our main touring yachts, however Stagnaro Charter Boats reserves the right to substitute boats without notice.</p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append