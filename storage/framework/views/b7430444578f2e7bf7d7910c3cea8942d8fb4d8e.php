

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Reset Your Password')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Reset Your Password</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">

		<div class="small-12 columns">
	
			<form method="post" action="<?php echo e(Request::url()); ?>" data-form-ajax autocomplete="off">

				<input type="hidden" name="step" value="2">
	
				<p>Please complete the following form in order to reset your password.</p>
	
				<div class="row">
					<div class="large-12 columns">
						<label>E-mail Address:
							<input class="input first-focus" type="email" name="email" placeholder="E-mail Address">
						</label>
					</div>
				</div>

				<div class="row">
					<div class="large-12 columns">
						<label>New Password:
							<input class="input" type="password" name="password" placeholder="Password">
						</label>
					</div>
				</div>
	
				<button type="submit" class="button primary">Change Password</button>
			
			</form>
	
		</div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>