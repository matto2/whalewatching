@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Marine Wildlife Encounterss Santa Cruz') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')
					
					<h1>Marine Wildlife Encounters (2 Hours)</h1>

					<p><img src="/images/otter-baby1.jpg" alt="Marine Wildlife Encounters"></p>

					<p>Come view the beautiful Monterey Bay Marine 
					Sanctuary aboard Velocity or Legacy! This trip 
					focuses on viewing the abundant marine wildlife
					that inhabits our nearshore waters of northern 
					Monterey Bay. Depending on the time of year your 
					trip may include sightings of several species of 
					Seals & Sea Lions, Sea Otters, Dolphins, marine 
					birds, and possibly even great white sharks or 
					whales! Trips are led by Marine Biologists and 
					expert Naturalists. Historical points of interest 
					are narrated by your captain during this 2 hour trip.

                    <br><br>
                    Our Coast Guard Certified vessels feature a snack bar
                    and a restroom.  All of our tours have a Marine 
                    Naturalist on board that will provide fascinating
                    insights on these Apex predators of the sea!
                    </p>

					<p></p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>

					<hr>

					<p><img src="/images/sunset/01.jpg" alt="Marine Wildlife Encounters"></p>
					<p><img src="/images/sunset/02.jpg" alt="Marine Wildlife Encounters"></p>
					<p><img src="/images/sunset/03.jpg" alt="Marine Wildlife Encounters"></p>
					<p><img src="/images/sunset/04.jpg" alt="Marine Wildlife Encounters"></p>
					<p><img src="/images/sunset/05.jpg" alt="Marine Wildlife Encounters"></p>
					
					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
					<hr>
					
@stop

@section('scripts')
@append
