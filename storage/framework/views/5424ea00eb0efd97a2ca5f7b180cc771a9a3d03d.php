

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
	
			<p>In order to reset your password, please enter your email address below. We'll then send you an email with a link that will allow you to reset your password.</p>
	
			<form method="post" action="<?php echo e(route('user.reset' )); ?>" data-form-ajax data-form-ajax-clear autocomplete="off">

				<div class="row">
					<div class="large-12 columns">
						<label>E-mail Address:
							<input class="input first-focus" type="email" name="email" placeholder="E-mail Address">
						</label>
					</div>
				</div>
	
				<button class="button primary" type="submit">Reset Your Password</button>
	
			</form>
	
		</div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>