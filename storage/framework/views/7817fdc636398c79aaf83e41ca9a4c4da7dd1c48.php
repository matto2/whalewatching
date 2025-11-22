

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Lots of Dolphins')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Lots of Dolphins</h1>

					<h2>December 21, 2012</h2>

					<p>Wednesday we saw some of the first Gray Whales of the year. We followed 3 animals for about 45 minutes. The winter migration has begun!!</p>

					<p class="credit">This entry was posted on December 21, 2012 by admin.</p>

					<p class="book">Book your trip today! <a <?php echo $__env->make('linkhref', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>>Book online now</a> or call <em>(831) 427-0230</em></p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>