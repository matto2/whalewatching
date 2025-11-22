@extends('layouts.shark1')

@section('head')
<title>{{ pageTitle('Great White Shark Encounters Santa Cruz') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')
					
					<h1>Great White Shark Encounters</h1>

					<p><img src="/images/shark01.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/shark02.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/shark03.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/shark04.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/shark05.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/shark06.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/shark07.jpg" alt="Great White Shark Encounters"></p>

					<p>Yes!  Great White Sharks in the wild! Santa Cruz and the northern Monterey Bay have become a Shark Rookery every year! The warm waters every spring and our shallow, sandy shores have become an ideal habitat for these awesome and mysterious creatures.  Get close up viewing of Great White Sharks only mere yards away from the beach on these 2 hour trips.  We often sight Sharks over 10 feet in length! Our Coast Guard Certified vessels feature a full service snack bar and a restroom. All of our tours have a Marine Naturalist on board that will provide fascinating insights on these Apex predators of the sea!</p>
					<p>Pricing:  Adults $39, Children $29, Infants free</p>
					</p> 2 hour trips.<p>
					
				


					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
					<hr>
					
@stop

@section('scripts')
@append