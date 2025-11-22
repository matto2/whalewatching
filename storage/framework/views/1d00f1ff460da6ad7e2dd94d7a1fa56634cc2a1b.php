

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Your Password Has Expired')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Your Password Has Expired</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<div class="row">

		<div class="small-12 columns">
	
			<p>In order to continue, you will need to change your password.</p>
	
			<form method="post" action="<?php echo e(route('user.expired' )); ?>" autocomplete="off" data-form-ajax>
	
				<div class="row">
					<div class="large-12 columns">
						<label>New Password:
							<input class="input first-focus" type="password" name="password" placeholder="New Password">
						</label>
					</div>
				</div>
	
				<button class="button primary" type="submit">Change Your Password</button>
	
			</form>
	
		</div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>