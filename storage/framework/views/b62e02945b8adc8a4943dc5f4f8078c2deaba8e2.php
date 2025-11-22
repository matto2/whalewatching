<!DOCTYPE html><!-- ADMIN -->
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="icon" href="/images/icon.jpg" type="image/x-icon">
	<meta name="robots" content="noindex nofollow">
	<meta name="description" content="Admin">
	<meta name="keywords" content="Admin">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">

	<?php echo $__env->yieldContent('head'); ?>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|PT+Sans|Lato|PT+Sans+Narrow"> 
	<link rel="stylesheet" type='text/css' href="/css/f.6.3.1.sass.and.scww.min.css">

	<?php echo $__env->yieldContent('stylesheets'); ?>
	<!-- Google Analytics updated 4/14/16 -->
	
</head>
<body id="tophead">
	<div class="row collapse">
		<div class="small-12 columns">
			<p class="home"><a href="/" title="Go to Home Page"><img class="logo" src="/images/logo.jpg" alt="Logo" title="Go to Home Page"></a>
		</div>
	</div>
	<div id="wrapper">
		<div class="row collapse">
			<div class="columns">
				<div class="title-bar hide-for-large" data-responsive-toggle="nav" data-hide-for="large">
					<button class="menu-icon" type="button" data-toggle></button>
					<div class="title-bar-title" data-toggle>Menu</div>
				</div>
				<div id="nav" class="top-bar">
					<nav class="top-bar-section">
						<ul class="dropdown vertical large-horizontal menu no-js nav-bar" data-responsive-menu="drilldown large-dropdown">
							<li><a href="/">Home</a></li>
							<li><a href="/monterey-bay-whale-watching">Whale &amp; Dolphin Cruises</a></li>
							<li><a href="/sanctuary-cruises">Scenic Bay Cruises</a></li><!--
							<li class="has-submenu opens-right"><a href="#">Scenic Bay Cruises</a>
								<ul class="submenu menu vertical" data-submenu>
									<li><a href="/sanctuary-cruises">Scenic Bay Cruises</a></li>
									<li><a href="/sunset">Sunset Cruises</a></li>
								</ul>
							</li> -->
							<li><a href="/rates">Rates</a></li>
							<li><a href="/recent-sightings">Recent Sightings</a></li>
							<li><a href="/about-us">About Us</a></li><!--
							<li class="has-submenu opens-right"><a href="#">About Us</a>
								<ul class="submenu menu vertical" data-submenu>
									<li><a href="/about-us">About Stagnaros</a></li>
									<li><a href="/about-our-boats">About Our Boats</a></li>
								</ul>
							</li> -->
							<li><a href="/private-charters">Private Charters</a></li>
							<li><a href="/scatterings-at-sea">Scattering at Sea</a></li>
							<li><a href="/directions">Directions</a></li>
							<li class="h"><a href="/whale-watching-in-monterey-bay-california">Why Monterey Bay?</a></li>
							<li class="h"><a href="/monterey-ca-whale-watching">Monterey Bay Whale Watching</a></li>
							<li class="h"><a href="/sanctuary-cruises/san-francisco-day-trips">San Francisco Day Trips</a></li>
							<li class="h"><a href="/whale-watching-monterey-bay-california">Whales of Monterey Bay</a></li>
							<li class="h"><a href="/dolphins">Dolphins &amp; Porpoises</a></li>
							<li class="h"><a href="/marine-life">Other Marine Life</a></li>
							<li class="h"><a href="/visitor-resources">Visitor Resources</a></li>
							<li class="h"><a href="/category/media/press-coverage">Press Coverage</a></li>
							<li class="h"><a href="/sea-sickness">Sea Sickness</a></li>
							<li class="h"><a href="/contact">Contact Us</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		
		<div class="row collapse">
			<div class="columns">
				<div class="small-12 medium-2 large-3 xlarge-2 columns" id="left">
					<ul class="menu vertical">
						<li><a href="/whale-watching-in-monterey-bay-california">Why Monterey Bay?</a></li>
						<li><a href="/monterey-ca-whale-watching">Monterey Bay Whale Watching</a></li>
						<li><a href="/sanctuary-cruises/san-francisco-day-trips">San Francisco Day Trips</a></li>
						<li><a href="/whale-watching-monterey-bay-california">Whales of Monterey Bay</a></li>
						<li><a href="https://www.stagnaros.com/" title="Stagnaro Fishing">Stagnaro Fishing</a></li>
						<li><a href="/dolphins">Dolphins &amp; Porpoises</a></li>
						<li><a href="/marine-life">Other Marine Life</a></li>
						<li><a href="/visitor-resources">Visitor Resources</a></li>
						<li><a href="/category/media/press-coverage">Press Coverage</a></li>
						<li><a href="/sea-sickness">Sea Sickness</a></li>
						<li><a href="/contact">Contact Us</a></li>
			<?php if( auth()->check() && auth()->user()->hasPermission('admin.*') ): ?>
				<li class="h"><a href="<?php echo e(route( 'admin' )); ?>">Admin</a></li>
			<?php endif; ?>
			<?php if( Auth::check() ): ?>
				<li class="h"><a class="userLogoutLink" href="<?php echo e(route( 'user.logout' )); ?>">Logout - <?php echo e(auth()->user()->first_name); ?></a></li>
			<?php else: ?>
				<li class="h"><a href="<?php echo e(route( 'user.login' )); ?>">Login</a></li>
			<?php endif; ?>
					</ul>

					<div class="callout">
						<h5>Gift Certificates</h5>
						<p>Any Dollar amount!<p>
						<p>For any Stagnaro Trip</p>
						<p>Call (831) 427-0230</p>
						<p>Gift certificate doesn't guarantee a spot on a specific trip. Reservations required</p>
					</div>
				</div>

				<div class="small-12 medium-12 large-9 xlarge-10 columns">
		<!-- Start Individual Pages -->
		<div class="row">
			<div id="globalAlerts" class="small-12 columns">
<?php if( Session::has( 'globalFlashAlerts' ) && is_array( Session::get( 'globalFlashAlerts' ) ) ): ?>
	<?php $__currentLoopData = Session::get( 'globalFlashAlerts' ); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if( @$alert['dismissable'] ): ?>
			<div class="<?php echo e($alert['type']); ?> callout" data-closable>
				<?php echo @$alert['message']; ?>

				<button class="close-button" data-close aria-label="Dismiss alert">&times;</button>
			</div>
		<?php else: ?>
			<div class="<?php echo e($alert['type']); ?> callout">
				<?php echo @$alert['message']; ?>

			</div>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
			</div>
		</div>
		<?php echo $__env->yieldContent('title'); ?>

		<?php echo $__env->yieldContent('content'); ?>
		<!-- End Individual Pages -->
				</div><!-- admin, END of Right div -->

			</div>
		</div>

		<footer class="row">
			<div class="columns">
				<p>Copyright&nbsp;&copy;&nbsp;<?php echo date("Y"); ?> Stagnaro Charters</p>
				<p>Powered by: <a class="wm" href="https://www.web4uinc.com/" title="Web 4U Inc">Web 4U Inc</a></p>
			</div>
		</footer>
	</div><!-- end div id="wrapper" -->
	
	<div id="globalModal" class="reveal" data-reveal>
		<h2></h2>
		<span></span>
	</div>

	<div id="globalDismissableModal" class="reveal" data-reveal>
		<h2></h2>
		<span></span>
		<a class="close-reveal-modal">&nbsp;</a>
	</div>

	<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script><!-- for foundation 214 -->
	<script type="text/javascript" src="/js/what-input.min.js"></script><!-- for foundation -->
	<script type="text/javascript" src="/js/foundation.min.js"></script><!-- for foundation -->
	<script type="text/javascript" src="/js/run_foundation.js"></script><!-- RUN foundation -->
	<script type="text/javascript" src="/js/app.min.js"></script>
	<script type="text/javascript" src="/js/ajaxform.min.js"></script>
<?php echo $__env->yieldContent('scripts'); ?>
	<script src="https://fareharbor.com/embeds/api/v1/?autolightframe=yes"></script>
</body>
</html>