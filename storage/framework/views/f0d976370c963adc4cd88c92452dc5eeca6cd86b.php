

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Welcome to Autumn in Monterey Bay')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Welcome to Autumn in Monterey Bay</h1>
					<p><img src="/images/surfacing.jpg" alt="Dolphin while Whale Watching in Monterey Bay California with Stagnaro Charters"></p>
					<p>Sunday 9/25 on Velocity– 12 Humpback Whales, 500 Common Dolphin, 100 Pacific White-sided Dolphin</p>
					<p>Saturday 9/24 on Legacy– We found 6 Humpback Whales, lunge feeding, plus 12 Risso’s Dolphins</p>
					<p><img src="/images/legacy.jpg" alt="Dolphin while Whale Watching in Monterey Bay California with Stagnaro Charters"></p>
					<p class="credit">This entry was posted on September 26, 2016 by jennyo.</p>
					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>