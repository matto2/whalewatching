

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Press Coverage')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Press Coverage</h1>

					<h2>Santa Cruz Whale Watching in the News</h2>

					<?php echo $__env->make('includes.whale-time-anchovies-bring-record-numbers-humpbacks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.monterey-whale-watching-whales-on-vacation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.my-blue-heaven-abundance-of-worlds-largest-creature-seen-in-monterey-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.photos-whales-fill-the-monterey-bay-2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.a-whale-of-a-show-krill-bloom-draws-blues-and-humpbacks-to-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.nbc-news-bay-area', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.fox-news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php echo $__env->make('includes.huffington-post', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>