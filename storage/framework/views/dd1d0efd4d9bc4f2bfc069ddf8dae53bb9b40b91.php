

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Media')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Media</h1>

					<h2>Santa Cruz Whale Watching in the News</h2>

					<?php echo $__env->make('includes.paul-schraubs-whales-shot-shows-why-californias-santa-cruz-is-so-special', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.whale-watchers-get-up-close-personal-in-santa-cruz-harbor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.monterey-california-whale-watching', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.a-whale-of-a-show-krill-bloom-draws-blues-and-humpbacks-to-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.whale-watching-monterey-california', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.cbs-evening-news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.humpback-whales-return-to-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>