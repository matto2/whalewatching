

<?php $__env->startSection('head'); ?>
	<meta name="robots" content="none">
	<meta name="Keywords" content="404 HTTP Error">
	<meta name="Description" content="404 HTTP Error">
	<title><?php echo e(pageTitle('404 HTTP Error')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>404 HTTP Error</h1>

					<p>404 HTTP Error — Page Not Found. That's kind of geek speak. In plain English that means the page you were looking for doesn't seem to be there. Hit your back arrow or go to our <a class="a" href="/" title="Click to go to Home Page">Home Page</a> and start over.</p>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>