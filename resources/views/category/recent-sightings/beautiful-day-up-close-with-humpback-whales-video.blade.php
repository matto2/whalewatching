@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Beautiful day up close with humpback whales: VIDEO') }}</title>
@stop

@section('stylesheets')
@stop

@section('title')
@stop

@section('content')

					<h1>Beautiful day up close with humpback whales: VIDEO</h1>
					<p>Tuesday, Sept. 27, 2016 – Mama and baby humpback playing with us today! Calf was breaching and pec slapping. Humpback whales are scattered, feeding throughout the Bay.</p>
					<iframe id="homeVid" src="https://www.youtube.com/embed/Dy9yF61XUIo" allowfullscreen="" allowfullscreen=""></iframe>
					<p>Monday, Sept. 26– We found whales! 7-8 humpback whales and ~100 sea lions center of Monterey Bay.</p>
					<iframe id="homeVid" src="https://www.youtube.com/embed/SD7AFJUACMY" allowfullscreen=""></iframe>
					<p class="credit">This entry was posted on September 30, 2016 by jennyo.</p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append