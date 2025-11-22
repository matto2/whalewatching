

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Scenic Bay Cruises')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<link rel="stylesheet" type='text/css' href="/css/motion-ui.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h3>We offer both <a href="#scenic" title="Monterey Sanctuary Scenic Bay Cruises">Scenic</a> &amp; <a href="#sunset" title="Wildlife Cruises">Wildlife</a> Cruises</h3>

					<h1 id="scenic">Monterey Sanctuary Scenic Bay Cruises</h1>

					<div class="orbit" role="region" element: data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;" aria-label="Favorite Santa Cruz Whale Watching Pictures" data-orbit>
						<ul class="orbit-container">
							<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
							<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
							<li class="orbit-slide"><img src="/images/sanctuary/01.jpg" alt="Santa Cruz Whale Watching Slider 1" /></li>
							<li class="orbit-slide"><img src="/images/sanctuary/02.jpg" alt="Santa Cruz Whale Watching Slider 2" /></li>
							<li class="orbit-slide"><img src="/images/sanctuary/03.jpg" alt="Santa Cruz Whale Watching Slider 3" /></li>
							<li class="orbit-slide"><img src="/images/sanctuary/04.jpg" alt="Santa Cruz Whale Watching Slider 4" /></li>
							<li class="orbit-slide"><img src="/images/sanctuary/06.jpg" alt="Santa Cruz Whale Watching Slider 5" /></li>
						</ul>
					</div>
					<p>View the beautiful Monterey Bay Marine Sanctuary aboard Velocity or Legacy! Sightings of Sea Lions, Otters and other marine life are common, so be sure to bring your camera! Highlights of this tour include:</p>
					<ul>
						<li>The <em>Kelp Forest</em> growing off the Point of Santa Cruz, where you can catch a glimpse of frolicking sea otters.</li>
						<li><em>Steamer Lane Surfing area</em> — world-famous for its celebrity guests and competitions</li>
						<li>A close-up pass by <em>Seal Island</em></li>
						<li>A cruise down the <em>main beaches</em> of Santa Cruz and the boardwalk</li>
						<li>Sip your favorite beverage, while drifting through the beautiful <em>Santa Cruz Yacht Harbor</em></li>
					</ul>
					<p>On this fun and educational trip, you’ll hear all about the Monterey Bay area while enjoying the company of some of its playful and furry inhabitants! Ideal for families.</p>
					<p>The Stagnaro family has been serving the Santa Cruz area for over a century when Italian Patriarch Cottardo Stagnaro settled in Santa Cruz in 1879. This historical landmark business is still providing Ocean Adventures to thousands of people each year.</p>
					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
					<hr>

					<h2 id="sunset">Marine Wildlife Encounters (2 Hours)</h2>

					<p>Come view the beautiful Monterey Bay Marine Sanctuary aboard <em>Velocity</em> or <em>Legacy!</em> This trip focuses on viewing the abundant marine wildlife that inhabits our nearshore waters of northern Monterey Bay. Depending on the time of year your trip may include sightings of several species of Seals &amp; Sea Lions, Sea Otters, Dolphins, marine birds, and even whales &amp; great white sharks! Trips are led by Marine Biologists and expert Naturalists. Historical points of interest are narrated by your captain during this 2 hour trip.</p>

					<!--
					<p>Come view the beautiful Monterey Bay Marine Sanctuary aboard <em>Velocity</em> or <em>Legacy!</em> In the glow of the setting sun, you’ll catch glimpses of <em>Sea Lions, Otters</em> and other marine life, as you cruise through the breath-taking scenery of <em>The Monterey Bay</em> via Santa Cruz.</p>
					<div class="orbit" role="region" element: data-options="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;" aria-label="Favorite Santa Cruz Whale Watching Pictures" data-orbit>
						<ul class="orbit-container">
							<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
							<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
							<li class="is-active orbit-slide"><img src="/images/sunset/01.jpg" alt="Santa Cruz Whale Watching Sunset Cruise Slider 1" /></li>
							<li class="orbit-slide"><img src="/images/sunset/02.jpg" alt="Santa Cruz Whale Watching Sunset Cruise Slider 2" /></li>
							<li class="orbit-slide"><img src="/images/sunset/03.jpg" alt="Santa Cruz Whale Watching Sunset Cruise Slider 3" /></li>
							<li class="orbit-slide"><img src="/images/sunset/04.jpg" alt="Santa Cruz Whale Watching Sunset Cruise Slider 4" /></li>
							<li class="orbit-slide"><img src="/images/sunset/05.jpg" alt="Santa Cruz Whale Watching Sunset Cruise Slider 5" /></li>
						</ul>
					</div>

					<p>This fully-narrated cruise includes:</p>

					<ul>
						<li>A visit to the <em>historic cement ship</em> “Palo Alto” from the World War I era–transformed into a man-made reef teaming with marine life.</li>
						<li>The tranquil <em>Kelp Forest</em> growing off the Point of Santa Cruz</li>
						<li>Steamer’s Surfing area—one of the most famous surfing spots in the world</li>
						<li>A scenic cruise through the beautiful Santa Cruz Yacht Harbor</li>
						<li>A full-service galley where you can purchase <em>lunch, snacks, beer and wine.</em></li>
					</ul>

					<p>You’ll also encounter teaming marine life along the way, since, as you know, the ocean comes alive as night falls!</p> -->

					<p>The Stagnaro family has been serving the Santa Cruz area for over a century when Italian Patriarch Cottardo Stagnaro settled in <a title="Whale Watching In Monterey Bay" href="/whale-watching-santa-cruz-california/">Santa Cruz</a> in 1879. This historical landmark business is still providing Ocean Adventures to thousands of people each year.</p>

					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>