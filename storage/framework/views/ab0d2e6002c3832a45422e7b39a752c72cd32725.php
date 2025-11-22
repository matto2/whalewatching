

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Santa Cruz Whale Watching')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h6>This page is no longer maintained. Please visit <a href="/recent-sightings" title="Recent Sightings">Recent Sightings</a></h6>

					<h1>Santa Cruz Whale Watching</h1>

					<p>This page is no longer maintained. Please select another page using the Navigation Links. Thank you!</p>

					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>