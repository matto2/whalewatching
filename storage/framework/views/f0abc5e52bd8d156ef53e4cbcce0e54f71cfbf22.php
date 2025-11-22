

<?php $__env->startSection('head'); ?>
	<title>Log In to Your Account</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Log In to Your Account</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="row">

		<div class="small-12 columns">

			<form method="post" action="<?php echo e(route( 'user.login' )); ?>" data-form-ajax>
		
				<?php if( session()->has( 'userLoginRedirect' ) ): ?>
					<div class="warning callout">
						<strong>You must log in to your account in order to continue.</strong>
					</div>
				<?php endif; ?>
		
				<label>
					E-mail Address:
					<input class="first-focus" type="email" name="email" placeholder="E-mail Address">
				</label>
		
				<label>
					Password:
					<input type="password" name="password" placeholder="Password">
				</label>
		
				<button class="button" type="submit">Log In</button>
				<a href="<?php echo e(route( 'user.reset' )); ?>" class="secondary button">Forgot Password</a>
				<?php if( setting( 'userSignupEnable' ) ): ?>
					<a href="<?php echo e(route( 'user.signup' )); ?>" class="secondary button">Sign Up</a>
				<?php endif; ?>
		
			</form>

		</div>

	</div>	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>