

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Account Activated')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Account Activated</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">
		<div class="small-12 columns">
			<p><strong>Thank you for activating your account!</strong> You can now <a href="<?php echo e(route('user.login' )); ?>" title="Log on to your account">log on to your account</a>.</p>
			<p><a class="button" href="<?php echo e(route('user.login' )); ?>" title="Log on to your account">Log on to your account</a>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>