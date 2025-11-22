

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Paul Schraub’s whales shot shows why California’s Santa Cruz is so special')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<?php echo $__env->make('includes.paul-schraubs-whales-shot-shows-why-californias-santa-cruz-is-so-special', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>