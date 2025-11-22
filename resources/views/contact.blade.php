@extends('layouts.frontend')

@section('head')
<title>{{ pageTitle('Contact Us') }}</title>
@stop

@section('stylesheets')
<style>
.tight p {
    font-size: 15px !important;
    color: #333333 !important;
}
</style>
@stop

@section('title')	
@stop

@section('content')

					<h1>Contact Us</h1>

					<h2 class="t">Stagnaro Charter Boats | Santa Cruz Whale Watching</h2>

					<section class="tight">
						<p>Gift Shop / Advance Reservations & Questions:</p>
						<p>1718 Brommer Street</p>
						<p>Santa Cruz, CA 95062</p>
						<p>(831) 427-0230</p>
					</section>

					<section class="tight">
						<p>Departure Location:</p>
						<p>789 Mariner Park Way</p>
						<p>Santa Cruz, CA 95062</p>
						<p>DOCK F / Santa Cruz Harbor West / past Aldo's</p>
					</section>

					<section class="tight">
						<p>Mailing Address:</p>
						<p>Post Office Box 2427</p>
						<p>Santa Cruz, CA 95063</p>
					</section>

					<section class="tight">
						<p>info@stagnaros.com</p>
						<p>info@santacruzwhalewatching.com</p>
					</section>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
			
					<p>The Stagnaro family has been serving the Santa Cruz area for over a century when Italian Patriarch Cottardo Stagnaro settled in Santa Cruz in 1879. Stagnaro Charters, a Santa Cruz California Whale Watching Company, is a historical landmark business which still providing Ocean Adventures to thousands of people each year. Your friendly crew people are all experienced hands. Most are native to the Monterey Bay area, and have first hand working knowledge of our local marine environment. They are dedicated to making your trip fun and memorable.</p>

					<p class="book">Book your trip today! <a @include('linkhref')>Book online now</a> or call <em>(831) 427-0230</em></p>
@stop

@section('scripts')
@append