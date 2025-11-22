

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Contact Us')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Contact Us</h1>

					<h2 class="t">Stagnaro Charter Boats | Santa Cruz Whale Watching</h2>

					<section class="tight">
						<p>Ticket Office/Check-In:</p>
						<p>1718 Brommer Street</p>
						<p>Santa Cruz, CA 95062</p>
						<p>(831) 427-0230</p>
					</section>

					<section class="tight">
						<p>Departure Location:</p>
						<p>789 Mariner Park Way</p>
						<p>Santa Cruz, CA 95062</p>
						<p>(Lower Santa Cruz Harbor / Western side / F-Dock)</p>
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

					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
			
					<p>The Stagnaro family has been serving the Santa Cruz area for over a century when Italian Patriarch Cottardo Stagnaro settled in Santa Cruz in 1879. Stagnaro Charters, a Santa Cruz California Whale Watching Company, is a historical landmark business which still providing Ocean Adventures to thousands of people each year. Your friendly crew people are all experienced hands. Most are native to the Monterey Bay area, and have first hand working knowledge of our local marine environment. They are dedicated to making your trip fun and memorable.</p>

					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>