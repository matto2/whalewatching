

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Comments')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
					<h1>Santa Cruz Whale Watching</h1>
					<h2>By Stagnaro Charters</h2>

					<?php echo $__env->make('includes.every-day-is-different-blue-fin-and-humpback', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.price-buster', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.humpbacks-and-orca-thrill-on-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.show-goes-whales-birds-dolphins-still-drawing-crowds', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.rare-pacific-leatherback-sea-turtles-spotted-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.santa-cruz-among-best-whale-watching-california-coast', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.rare-finds-monterey-bay-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.cbs-evening-news-rides-along-santa-cruz-whale-watching', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.monterey-whale-watching-abc-news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>