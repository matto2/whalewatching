

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Blue Whales in Monterey Bay')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Blue Whales in Monterey Bay</h1>

					<p><a href="http://theterramarproject.org/" title="">The Terramar Project</a></p>

					<p class="credit">This entry was posted in Media, Press Coverage on April 3, 2013 by admin.</p>

					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>