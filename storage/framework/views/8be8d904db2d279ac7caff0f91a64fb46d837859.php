

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Media')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Media - Santa Cruz Whale Watching</h1>

					<h2>Whale Watching Monterey Bay California</h2>
					<p class="credit">By Stagnaro Charters</p>

					<?php echo $__env->make('includes.show-goes-whales-birds-dolphins-still-drawing-crowds', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.rare-pacific-leatherback-sea-turtles-spotted-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.santa-cruz-among-best-whale-watching-california-coast', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.cbs-evening-news-rides-along-santa-cruz-whale-watching', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.monterey-whale-watching-abc-news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.dan-haifley-ocean-backyard-gray-whale-time', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.a-variety-of-whales', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.year-whale-2013-brought-marine-show-unlike', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.monterey-bay-humpbacks-made-new-york-times', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.whales-still-going-wild-monterey-bay-ksbw-news-report-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.lets-go-fishin-whales-red-tide', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>