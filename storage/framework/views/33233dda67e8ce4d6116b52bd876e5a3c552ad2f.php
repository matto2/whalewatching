

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('SantaCruz.com')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>SantaCruz.com</h1>

					<h2>Stinky the Whale Stars in Santa Cruz</h2>

					<p>Unfortunately the link to "Stinky the Whale Stars in Santa Cruz" is no longer available at <a href="http://santacruz.com/" title="">Santa Cruz</a></p>

					<p class="credit"> This entry was posted on April 3, 2013 by admin.</p>

					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>