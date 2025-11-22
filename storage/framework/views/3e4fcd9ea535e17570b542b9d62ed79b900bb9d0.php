

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Monterey Bay whales breaching, tail slapping and feeding on anchovies')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
					
					<?php echo $__env->make('includes.monterey-bay-whales-breaching-tail-slapping-feeding-anchovies', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>