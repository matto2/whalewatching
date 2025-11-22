@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Great White Shark Encounterss Santa Cruz') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')
					
					<h1>2-Hour Great White Shark Encounters</h1>

					<p><img src="/images/shark01.jpg" alt="Great White Shark Encounters"></p>

					<p>Yes!  
					    Great White Sharks in the wild! Santa Cruz and the
					    northern Monterey Bay have become a Shark Rookery every
					    year!  The warm waters every spring and our shallow,
					    sandy shores have become an ideal habitat for these
					    awesome and mysterious creatures.  Get close up viewing
					    of Great White Sharks only mere yards away from the
					    beach on these 2-hour trips.  We often see Sharks over
					    10 feet in length!
					    <br><br>
                        This trip also focuses on viewing the abundant marine
                        wildlife that inhabits our nearshore waters of northern
                        Monterey Bay, such as, Seals & Sea Lions, Sea Otters,
                        Dolphins, marine birds, and even sometimes whales!
                        <br><br>
                        Our Coast Guard Certified vessels feature a snack bar
                        and a restroom.  All of our tours have a Marine 
                        Naturalist on board that will provide fascinating
                        insights on these Apex predators of the sea!
                    </p>

					<p></p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>

					<hr>

					<p><img src="/images/sunset/01.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/sunset/02.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/sunset/03.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/sunset/04.jpg" alt="Great White Shark Encounters"></p>
					<p><img src="/images/sunset/05.jpg" alt="Great White Shark Encounters"></p>
					
					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
					<hr>
					
@stop

@section('scripts')
@append