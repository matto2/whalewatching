@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Humpbacks') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Humpbacks</h1>

					<h1>Beautiful day up close with humpback whales: VIDEO</h1>
					<p>Tuesday, Sept. 27, 2016 – Mama and baby humpback playing with us today! Calf was breaching and pec slapping. Humpback whales are scattered, feeding throughout the Bay.</p>
					<iframe id="homeVid" src="https://www.youtube.com/embed/Dy9yF61XUIo" allowfullscreen="" allowfullscreen=""></iframe>
					<p>Monday, Sept. 26– We found whales! 7-8 humpback whales and ~100 sea lions center of Monterey Bay.</p>
					<iframe id="homeVid" src="https://www.youtube.com/embed/SD7AFJUACMY" allowfullscreen=""></iframe>
					<p class="credit">This entry was posted on September 30, 2016 by jennyo.</p>
					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
					<hr>

					<h1>Welcome to Autumn in Monterey Bay</h1>
					<p><img src="/images/surfacing.jpg" alt="Dolphin while Whale Watching in Monterey Bay California with Stagnaro Charters"></p>
					<p>Sunday 9/25 on Velocity– 12 Humpback Whales, 500 Common Dolphin, 100 Pacific White-sided Dolphin</p>
					<p>Saturday 9/24 on Legacy– We found 6 Humpback Whales, lunge feeding, plus 12 Risso’s Dolphins</p>
					<p><img src="/images/legacy.jpg" alt="Dolphin while Whale Watching in Monterey Bay California with Stagnaro Charters"></p>
					<p class="credit">This entry was posted on September 26, 2016 by jennyo.</p>
					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
					<hr>

					<h1><a href="/beautiful-day-up-close-with-humpback-whales-video" title="Beautiful day up close with humpback whales: VIDEO">Beautiful day up close with humpback whales: VIDEO</a></h1>
					<p>Tuesday, Sept. 27, 2016 – Mama and baby humpback playing with us today! Calf was breaching and pec slapping. Humpback whales are scattered, feeding throughout the Bay.</p>
					<iframe id="homeVid" src="https://www.youtube.com/embed/Dy9yF61XUIo" allowfullscreen="" allowfullscreen=""></iframe>
					<p>Monday, Sept. 26– We found whales! 7-8 humpback whales and ~100 sea lions center of Monterey Bay.</p>
					<iframe id="homeVid" src="https://www.youtube.com/embed/SD7AFJUACMY" allowfullscreen=""></iframe>
					<p class="credit">This entry was posted on September 30, 2016 by jennyo.</p>
					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append