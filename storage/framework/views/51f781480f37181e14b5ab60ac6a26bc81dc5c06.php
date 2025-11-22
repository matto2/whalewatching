

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('Add a User')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="breadcrumbs" class="row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="<?php echo e(route( 'admin' )); ?>">Administration</a></li>
					<li><a href="<?php echo e(route( 'admin.user' )); ?>">User Accounts</a></li>
					<li>
						<span class="show-for-sr">Current: </span> Add a User
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="row">
		<div class="small-12 columns">
			<h1>Add a User</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<form id="addUserForm" method="post" action="<?php echo e(route('admin.user.add' )); ?>" data-form-ajax autocomplete="off" data-form-ajax-clear data-form-wait-title="Adding user...">
		<div class="row">
			<div class="small-12 columns">
				<div class="secondary callout">		
					<h2>Account Information</h2>
		
					<div class="row">
						<div class="smal-12 medium-6 columns">
							<label>First Name:<input class="input first-focus" type="text" name="firstName" placeholder="First Name"></label>
						</div>
						<div class="small-12 medium-6 columns">
							<label>Last Name:<input class="input" type="text" name="lastName" placeholder="Last Name"></label>
						</div>
					</div>
		
					<div class="row">
						<div class="small-12 columns">
							<label>E-mail Address:<input class="input" type="email" name="email" placeholder="E-mail Address" autocapitalize="off"></label>
						</div>
					</div>		
				</div>
			</div>
		</div>

		<div class="row">
			<div class="small-12 columns">
				<div class="secondary callout">		
					<h2>Password</h2>
		
					<p>If you leave this blank, the user will be required to verify their account and set their password when they do so.</p>
		
					<label>Password:<input class="input" type="password" name="password" placeholder="Password"></label>
					<label><input type="checkbox" name="neverExpire"> Password does not expire</label>		
				</div>
			</div>
		</div>

		<div class="row">
			<div class="small-12 columns">
				<div class="secondary callout">		
					<h2>User Account Options</h2>
		
					<div class="controls">		
						<label><input type="checkbox" name="isAdministrator"> User is a site administrator</label>
						<label><input type="checkbox" name="sendWelcome" checked="checked" disabled="disabled"> Send the user a welcome email message</label>
						<label><input type="checkbox" name="changePassword" checked="checked" disabled="disabled"> Require a password change on first logon</label>
						<label><input type="checkbox" name="verifyUser" checked="checked" disabled="disabled"> Require the user to verify their email address</label>
		
						<?php if( setting( 'userPasswordNoExpireEnable' ) ): ?>
							<?php if( setting( 'userPasswordAgeMax' ) > 0 ): ?>
								<label><input type="checkbox" name="passwordNoExpire"> Password does not expire</label>
							<?php else: ?>
								<label><input type="checkbox" name="passwordNoExpire" checked="checked" disabled="disabled"> Password does not expire (password expiration disabled in settings)</label>
							<?php endif; ?>
						<?php endif; ?>
		
						<?php if( auth()->user()->id == 1 ): ?>
							<label><input type="checkbox" name="hidden"> Hidden user account</label>
						<?php endif; ?>
					</div>		
				</div>
			</div>
		</div>

		<div class="row">
			<div class="small-12 columns">
				<button class="button primary" type="button" data-form-submit="addUserForm">Add User</button>
				<a class="button secondary" href="<?php echo e(route('admin.user' )); ?>" title="Return to the main user account administration page">Cancel</a>
			</div>
		</div>
	</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script type="text/javascript" language="JavaScript">
	<!--

		function show_input_errors( item_name, messages ) {
			$(item_name+"-group").addClass( "has-error" );
			$.each( messages, function( index, value ) {
				$(item_name+"-group").append( "<p class=\"help-block error-alert\"><span class=\"glyphicon glyphicon-arrow-up\"></span> <strong>" + value + "</strong></p>" );
			});
			$(item_name+"-input").focus();
		}

		function setOptions() {

			if ( $('#addUserForm input[name=password]').val() == "" ) {
				$("#addUserForm input[name=sendWelcome]").prop( "disabled", true );
				$("#addUserForm input[name=changePassword]").prop( "checked", true );
				$("#addUserForm input[name=changePassword]").prop( "disabled", true );
				$("#addUserForm input[name=verifyUser]").prop( "checked", true );
				$("#addUserForm input[name=verifyUser]").prop( "disabled", true );
			}

			else {
				$("#addUserForm input[name=sendWelcome]").prop( "checked", true );
				$("#addUserForm input[name=sendWelcome]").prop( "disabled", false );
				$("#addUserForm input[name=changePassword]").prop( "checked", true );
				$("#addUserForm input[name=changePassword]").prop( "disabled", false );
				$("#addUserForm input[name=verifyUser]").prop( "checked", true );
				$("#addUserForm input[name=verifyUser]").prop( "disabled", false );
			}

		}

		$(document).ready( function() {

			$("#addUserForm input[name=password]").on( "keyup", function(e) {
				setOptions();
			});

		});

	//-->
	</script>

<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>