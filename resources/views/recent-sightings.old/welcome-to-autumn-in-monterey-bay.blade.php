@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Welcome to Autumn in Monterey Bay') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Welcome to Autumn in Monterey Bay</h1>
					<p><img src="/images/surfacing.jpg" alt="Dolphin while Whale Watching in Monterey Bay California with Stagnaro Charters"></p>
					<p>Sunday 9/25 on Velocity– 12 Humpback Whales, 500 Common Dolphin, 100 Pacific White-sided Dolphin</p>
					<p>Saturday 9/24 on Legacy– We found 6 Humpback Whales, lunge feeding, plus 12 Risso’s Dolphins</p>
					<p><img src="/images/legacy.jpg" alt="Dolphin while Whale Watching in Monterey Bay California with Stagnaro Charters"></p>
					<p class="credit">This entry was posted on September 26, 2016 by jennyo.</p>
					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append