

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('A Whale of a show: Krill bloom draws blues and humpbacks to bay')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
					<?php echo $__env->make('includes.a-whale-of-a-show-krill-bloom-draws-blues-and-humpbacks-to-bay', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>