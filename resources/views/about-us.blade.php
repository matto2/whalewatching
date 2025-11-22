@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('About Us') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')
					
					<h1>About Us &amp; <a href="#boats" title="About Our Boats">Our Boats</a></h1>

					<h3>Whale Watching in Santa Cruz &amp; Monterey Bay California</h3>

					<p class="mb0"><img src="/images/ken.jpg" alt="Ken Stagnaro"></p>

					<aside>
						<p>Ken Stagnaro, Captain of the VelocityWhale Watching in Santa Cruz &amp; Monterey Bay California Scenic Cruises.</p>
					</aside>

					<h5>CAPTAIN: </h5>
					
					<p>Most likely your skipper will be Ken Stagnaro. A Santa Cruz native, Ken was skipper of a U.S. Coast Guard search and rescue vessel in the San Francisco bay area in the early 1980’s. Later, Ken returned home to Santa Cruz to run the family boats. Ken has been running whale and sea life excursions, scenic cruises and private charters for over 20 years. His knowledge of the Monterey Bay is matched by few. Ken also has performed our trips narrative for many years; his insights are both fascinating and educational.</p>

					<h5>CREW AND NATURALISTS:</h5>

					<p>Your friendly crew people are all experienced hands. Most are native to the Monterey Bay area, and have first hand working knowledge of our local marine environment. They are dedicated to making your trip fun and memorable.</p>

					<!-- Names 

					Ken Stagnaro - Captain/Owner
					Gabe Torres - Boat Captain
					Kris Victorino - Boat Captain
					(Mike Baxter - Boat Captain)

					Boat Crew: Jason Truesdale, 			******** KEN you are better to fill out crew-members ********

					Maureen Gilbert - Naturalist/Guide
					Jenn Yuhas - Naturalist/Guide
					Megan Petersen - Naturalist/Guide

					Shop/Reservations:
					Monica Reynolds
					Jenny O'Leary
					Sherry Casacky -->


					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
					<hr>

					<h2 id="boats">About Our Boats</h2>

					<h5>Experience Whale Watching on the Velocity &amp; Legacy</h5>

					<p><img src="/images/velocityfull.jpg" alt="Velocity"></p>

					<p>Stagnaro Charter Boats proudly presents the charter boat Velocity. Built by Yank Marine, Inc., in Tuckahoe, New Jersey, she was completed in California in 2005 and complies with all the latest safety standards. Velocity is 60′ long and is certified by the U.S. Coast Guard to carry 66 passengers. She features a galley that sells snack items as well as your favorite beverages.<!--



						Velocity is equipped with comfortable interior high back seating. Her spacious walk-around deck and exterior seating make her a great choice for whale watching and scenic tours. Indeed, Velocity is speedy so you spend less time traveling and more time watching marine life. --></p>

					<p><img src="/images/legacy.jpg" alt="Legacy"></p>

					<p>Stagnaro Charter Boats is pleased to introduce a new addition to our fleet, joining Velocity at Dock F this season. Our new boat Legacy is a 56′ fiberglass Westport yacht, featuring a spacious deck and deluxe interiors plus comfortable galley, snack bar/beer/wine and restroom amenities. Legacy can accommodate passengers for public or private fishing excursions. With this gorgeous new addition to our fleet, we are excited to offer more opportunities for our neighbors and visitors alike to go fishing, or for a relaxing cruise on Monterey Bay.</p>

					<p><em>SEE THE BAY THE VELOCITY &amp; LEGACY WAY!</em></p>

					<p>** Velocity and Legacy are licensed beer and wine vessels. No outside alcohol may be brought on board. Coolers longer than 20 inches in length are not allowed.</p>

					<p>***Velocity and Legacy are our main touring yachts, however Stagnaro Charter Boats reserves the right to substitute boats without notice.</p>
@stop

@section('scripts')
@append