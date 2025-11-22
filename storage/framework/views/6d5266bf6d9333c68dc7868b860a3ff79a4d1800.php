

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Sitemap')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><span class="show-for-sr">Current: </span> Sitemap</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Sitemap</h1>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">
		<div class="small-12 columns">
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/monterey-bay-whale-watching">Whale &amp; Dolphin Cruises</a></li>
				<li><a href="/sanctuary-cruises">Scenic Bay Cruises</a></li>
				<li><a href="/sunset">Sunset Cruises</a></li>
				<li><a href="/rates">Rates</a></li>
				<li><a href="/recent-sightings">Recent Sightings</a></li>
				<li><a href="/about-us">About Stagnaros</a></li>
				<li><a href="/about-our-boats">About Our Boats</a></li>
				<li><a href="/private-charters">Private Charters</a></li>
				<li><a href="/scatterings-at-sea">Scattering at Sea</a></li>
				<li><a href="/directions">Directions</a></li>
				<li><a href="/whale-watching-in-monterey-bay-california">Why Monterey Bay?</a></li>
				<li><a href="/monterey-ca-whale-watching">Monterey Bay Whale Watching</a></li>
				<li><a href="/sanctuary-cruises/san-francisco-day-trips">San Francisco Day Trips</a></li>
				<li><a href="/whale-watching-monterey-bay-california">Whales of Monterey Bay</a></li>
				<li><a href="/dolphins">Dolphins &amp; Porpoises</a></li>
				<li><a href="/marine-life">Other Marine Life</a></li>
				<li><a href="/visitor-resources">Visitor Resources</a></li>
				<li><a href="/press-coverage">Press Coverage</a></li>
				<li><a href="/videos">Videos</a></li>
				<li><a href="/sea-sickness">Sea Sickness</a></li>
				<li><a href="/contact">Contact Us</a></li>
				<?php if( auth()->check() && auth()->user()->hasPermission('admin.*') ): ?>
					<li class="h"><a href="<?php echo e(route( 'admin' )); ?>">Admin</a></li>
				<?php endif; ?>
				<?php if( Auth::check() ): ?>
					<li class="h"><a class="userLogoutLink" href="<?php echo e(route( 'user.logout' )); ?>">Logout</a></li>
				<?php else: ?>
					<li class="h"><a href="<?php echo e(route( 'user.login' )); ?>">Login</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>