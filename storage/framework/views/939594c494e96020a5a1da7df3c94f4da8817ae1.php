

<?php $__env->startSection('head'); ?>
	<title><?php echo e(pageTitle('View/Change User')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="<?php echo e(route( 'admin' )); ?>">Administration</a></li>
					<li><a href="<?php echo e(route( 'admin.user' )); ?>">User Accounts</a></li>
					<li>
						<span class="show-for-sr">Current: </span> View User
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>View/Change User</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php if( $user ): ?>

		<form id="editUserForm" method="post" action="<?php echo e(route( 'admin.user.view', $user->id )); ?>" data-form-ajax>

			<div class="expanded row">

				<div class="small-12 columns">

					<div class="ajax-alerts"></div>

					<?php if( auth()->check() && $user->id == auth()->user()->id ): ?>
						<div class="warning callout">
							<strong>This is your account.</strong> Some items cannot be changed while you are logged on to your own account.
						</div>
					<?php endif; ?>

					<?php if( !$user->enabled ): ?>
						<div class="warning callout">
							<strong>This user's account is disabled.</strong>
						</div>
					<?php endif; ?>
		
					<ul id="userAccountTabs" class="tabs" data-tabs>
						<li class="tabs-title is-active"><a href="#userAccountTab" aria-selected="true">Account</a></li>
						<li class="tabs-title"><a href="#userRolesTab">Roles</a></li>
						<li class="tabs-title"><a href="#userPermissionsTab">Permissions</a></li>
					</ul>

					<div class="tabs-content" data-tabs-content="userAccountTabs">

						
						
						

						<div id="userAccountTab" class="tabs-panel is-active">

							
							

							<div class="secondary callout">
				
								<h2>Account Information</h2>
				
								<div class="expanded row">
									<div class="smal-12 medium-6 columns">
										<label>First Name:
											<input class="input first-focus" type="text" name="firstName" placeholder="First Name" data-form-initial-value="<?php echo e($user->first_name); ?>">
										</label>
									</div>
									<div class="small-12 medium-6 columns">
										<label>Last Name:
											<input class="input" type="text" name="lastName" placeholder="Last Name" data-form-initial-value="<?php echo e($user->last_name); ?>">
										</label>
									</div>
								</div>
					
								<div class="expanded row">
									<div class="large-12 columns">
										<label>E-mail Address:
											<input class="input" type="email" name="email" placeholder="E-mail Address" data-form-initial-value="<?php echo e($user->email); ?>" data-form-original-data-form-initial-value="<?php echo e($user->email); ?>">
										</label>
										<?php if( setting( 'userEmailChangedEmailAdminEnable' ) ): ?>
											<div class="emailChangeAlert primary callout hide">
												<strong>Changing this user's email address will result in email confirmations being sent to the old and new addresses.</strong> <a class="revertEmail" href="#">Undo changes?</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
		
								<label><input type="checkbox" name="isAdministrator" data-form-initial-value="<?php echo e($user->administrator); ?>" data-form-disable="<?php echo e($user->id == auth()->user()->id || !auth()->user()->administrator ? 1 : 0); ?>"> User is a site administrator</label>
				
								<?php if( auth()->user()->id == 1 ): ?>
									<label><input type="checkbox" name="hidden" data-form-initial-value="<?php echo e($user->hidden); ?>"> Hidden user account</label>
								<?php endif; ?>

							</div>

							
							
		
							<div class="secondary callout">

								<?php if( $user->enabled ): ?>
				
									<?php if( !$user->activated ): ?>

										<div id="userActivationFieldset">
						
											<h2>Account Activation</h2>
						
											<div id="notActivatedAlertBox" class="primary callout">
												<strong>This user's account has not yet been activated.</strong>
											</div>
						
											<button class="button secondary" type="button" data-open="activateUserModal">Activate User</button>
											<button class="button secondary" type="button" data-open="resendActivationMessageModal">Resend Activation E-Mail</button>
						
										</div>

									<?php endif; ?>
			
									<div id="userPasswordFieldset">
										
										<h2>Password</h2>
				
										<?php if( $user->password_expires != 0 && $user->password_expires <= \Carbon\Carbon::now() ): ?>
											<div class="alert callout">
												This user's password has expired.
											</div>
										<?php else: ?>
											<div class="primary callout hide">
												This user's password has expired.
											</div>
										<?php endif; ?>
				
										<?php if( $user->password_never_expires ): ?>
											<label><input type="checkbox" name="neverExpire" checked="checked"> Password does not expire</label>
										<?php else: ?>
											<label><input type="checkbox" name="neverExpire"> Password does not expire</label>
										<?php endif; ?>
								
										<button type="button" class="button secondary" data-open="setPasswordModal">Set Password</button>
				
										<?php if( auth()->check() && $user->id != auth()->user()->id ): ?>
											<button type="button" class="button secondary" data-open="resetPasswordModal">Email New Password</button>
											<?php if( $user->password_expires == 0 || $user->password_expires > \Carbon\Carbon::now() ): ?>
												<button type="button" id="expirePasswordButton" class="button secondary" data-open="expirePasswordModal">Expire Password</button>
											<?php else: ?>
												<button type="button" id="expirePasswordButton" class="button secondary hide" data-open="expirePasswordModal">Expire Password</button>
											<?php endif; ?>
										<?php endif; ?>
		
										<?php if( setting( 'userPasswordremember' ) > 0 ): ?>
											<button type="button" class="button secondary" data-open="clearPasswordHistoryModal">Clear Password History</button>
										<?php endif; ?>
	
									</div>

								<?php endif; ?>
			
							</div>
		
							
							

							<div class="secondary callout">
		
								<h2>Addresses</h2>
		
								<?php if( $user->addresses()->count() ): ?>
		
									<table>
		
										<thead>
		
											<tr>
												<th>Address Name</th>
											</tr>
		
										</thead>
		
										<tbody>
											<?php $__currentLoopData = $user->addresses()->orderBy( 'name', 'asc' )->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr data-click="<?php echo e(route( 'admin.user.address.view', [ $user->id, $address->id ] )); ?>">
													<td><?php echo e($address->name); ?></td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
		
									</table>
		
								<?php else: ?>
		
									<div class="primary callout">
										This user does not have any saved addresses.
									</div>
		
								<?php endif; ?>
		
								<a class="button secondary" href="<?php echo e(route( 'admin.user.address.add', $user->id )); ?>" title="Add a new saved address for this user">Add New Address</a>
		
							</div>

							
							

							<div class="secondary callout">
				
								<h2>Usage Summary</h2>
				
								<table>
				
									<tr>
										<th class="text-right">Activated:</th>
										<?php if( $user->isActivated() ): ?>
											<td><?php echo e($user->activated); ?></td>
										<?php else: ?>
											<td>Not Activated</td>
										<?php endif; ?>
									</tr>
				
									<tr>
										<th class="text-right">Last Login:</th>
										<?php if( $user->last_logon == 0 ): ?>
											<td>Never Logged On</td>
										<?php else: ?>
											<td><?php echo e($user->last_logon); ?></td>
										<?php endif; ?>
									</tr>
				
									<tr>
										<th class="text-right">Password Expires:</th>
										<?php if( $user->password_expires == 0 ): ?>
											<td>Does Not Expire</td>
										<?php else: ?>
											<td><?php echo e($user->password_expires); ?></td>
										<?php endif; ?>
									</tr>
				
									<tr>
										<th class="text-right">Password Last Changed:</th>
										<?php if( $user->password_last_changed == 0 ): ?>
											<td>Never Changed</td>
										<?php else: ?>
											<td><?php echo e($user->password_last_changed); ?></td>
										<?php endif; ?>
									</tr>
				
								</table>
				
							</div>

						</div>

						
						
						

						<div id="userRolesTab" class="tabs-panel">

							<h2>Roles</h2>

							<?php if( $user->administrator ): ?>
								<div class="secondary callout">
									Roles are disabled because this user is an administrator.
								</div>
							<?php endif; ?>

							<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<label><input type="checkbox" value="<?php echo e($role->id); ?>" name="roles[]" data-form-initial-value="<?php echo e($user->administrator ? 0 : $user->hasRole( $role->identifier )); ?>" data-form-disable="<?php echo e($user->administrator); ?>" data-acl-role-permissions="<?php echo e($role->permissionString()); ?>"> <?php echo e($role->name); ?></label>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</div>

						
						
						

						<div id="userPermissionsTab" class="tabs-panel">

							<h2>Permissions</h2>

							<?php if( $user->administrator ): ?>
								<div class="secondary callout">
									Permissions are disabled because this user is an administrator.
								</div>
							<?php else: ?>
								<div class="secondary callout">
									Any permissions that are disabled are provided by a role.
								</div>
							<?php endif; ?>

							<?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<label><input type="checkbox" value="<?php echo e($permission->id); ?>" name="permissions[]" data-form-initial-value="<?php echo e($user->administrator ? 0 : $user->hasPermission( $permission->identifier )); ?>" data-form-disable="<?php echo e($user->administrator || $user->hasRolePermission( $permission->identifier )); ?>" data-acl-permission="<?php echo e($permission->identifier); ?>"> <?php echo e($permission->name); ?></label>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</div>

					</div>

				</div>

			</div>
		
			<div class="expanded row">

				<div class="small-12 columns">

				<button type="button" class="button" data-form-ajax-submit="#editUserForm">Save Changes</button>
				<?php if( auth()->check() && $user->id != auth()->user()->id ): ?>
					<?php if( ( $user->administrator && auth()->user()->hasRole( 'admin.user' ) ) || ( !$user->administrator && auth()->user()->hasPermission( 'admin.user.delete' ) ) ): ?>
						<button type="button" class="delete-user button alert" data-open="deleteUserModal">Delete User</button>
					<?php endif; ?>
					<?php if( $user->enabled ): ?>
						<button type="button" class="button secondary" data-open="disableUserModal">Disable User</button>
					<?php else: ?>
						<button type="button" class="button secondary" data-open="enableUserModal">Enable User</button>
					<?php endif; ?>
				<?php endif; ?>
				<a class="button secondary" href="<?php echo e(route( 'admin.user' )); ?>" title="Return to the main user account administration page">Cancel</a>

				</div>

			</div>

		</form>

		<div id="setPasswordModal" class="reveal" data-reveal data-close-on-click="false">

			<form id="setPasswordForm" method="post" action="<?php echo e(route( 'admin.user.password', $user->id )); ?>" data-form-ajax data-form-ajax-reload>

				<input type="hidden" name="action" value="set">

				<h2>Set Password</h2>

				<p>Enter a new password below for user '<?php echo e($user->email); ?>'.</p>

				<label>New Password:
					<input class="first-focus" type="text" name="password" placeholder="New Password">
				</label>

				<?php if( auth()->check() && $user->id != auth()->user()->id ): ?>
					<label>
						<input type="checkbox" name="change_password" title="Require user to change their password on next logon">
						Require user to change their password on next logon
					</label>
				<?php endif; ?>

				<button type="submit" class="button">Set Password</button>
				<button type="button" class="button secondary" data-close>Cancel</button>

				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>

			</form>

		</div>

		<div id="expirePasswordModal" class="reveal" data-reveal data-close-on-click="false">
			<form id="activateUserForm" method="post" action="<?php echo e(route( 'admin.user.password', $user->id )); ?>" data-form-ajax data-form-ajax-reload>
				<input type="hidden" name="action" value="expire">
				<h2>Expire Password?</h2>
				<p><strong>Are you sure you want to expire this user's password?</strong> This user will be required to change their password the next time they are online.</p>
				<button type="submit" class="button primary">Expire Password</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

		<div id="resetPasswordModal" class="reveal" data-reveal data-close-on-click="false">
			<form id="activateUserForm" method="post" action="<?php echo e(route( 'admin.user.password', $user->id )); ?>" data-form-ajax data-form-ajax-reload>
				<input type="hidden" name="action" value="reset">
				<h2>Email New Password?</h2>
				<p><strong>Are you sure you want to reset this user's password?</strong> This user will be sent an email with a link to reset their password.</p>
				<button type="submit" class="button">Email New Password</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

		<div id="clearPasswordHistoryModal" class="reveal" data-reveal data-close-on-click="false">
			<form id="clearPasswordHistoryForm" method="post" action="<?php echo e(route( 'admin.user.password', $user->id )); ?>" data-form-ajax>
				<input type="hidden" name="action" value="history.clear">
				<h2>Clear User's Password History?</h2>
				<p><strong>Are you sure you want to clear this user's password history?</strong> Once this user's password history is cleared, they will be able to re-use old passwords. This cannot be undone.</p>
				<button type="submit" class="button alert">Clear Password History</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

		<?php if( $user->enabled ): ?>
			<div id="disableUserModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="disableUserForm" method="post" action="<?php echo e(route( 'admin.user.disable', $user->id )); ?>" data-form-ajax data-form-ajax-reload>
					<h2>Disable User?</h2>
					<p><strong>Are you sure you want to disable the user "<?php echo e($user->email); ?>"?</strong> This will prevent this user from being able to log on.</p>
					<button type="submit" class="button alert">Disable User</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>
		<?php else: ?>
			<div id="enableUserModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="enableUserForm" method="post" action="<?php echo e(route( 'admin.user.enable', $user->id )); ?>" data-form-ajax data-form-ajax-reload>
					<h2>Enable User?</h2>
					<p><strong>Are you sure you want to enable the user "<?php echo e($user->email); ?>"?</strong> Once enabled, this user will be able to log on to their account.</p>
					<button type="submit" class="button primary">Enable User</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>
		<?php endif; ?>

		<div id="deleteUserModal" class="reveal" data-reveal data-close-on-click="false">
			<form id="deleteUserForm" method="post" action="<?php echo e(route( 'admin.user.delete', $user->id )); ?>" data-form-ajax>
				<h2>Delete User?</h2>
				<p><strong>Are you sure you want to delete the user "<?php echo e($user->email); ?>"?</strong> This action cannot be undone.</p>
				<button type="submit" class="button alert">Delete User</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

		<?php if( !$user->isActivated() ): ?>

			<div id="activateUserModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="activateUserForm" method="post" action="<?php echo e(route( 'admin.user.activate', $user->id )); ?>" data-form-ajax data-form-ajax-reload>
					<input type="hidden" name="action" value="activate">
					<h2>Activate This User?</h2>
					<p>Do you want to activate the user account for "<?php echo e($user->email); ?>"?</p>
					<button type="submit" class="button primary">Activate User</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>
	
			<div id="resendActivationMessageModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="activateUserForm" method="post" action="<?php echo e(route( 'admin.user.activate', $user->id )); ?>" data-form-ajax>
					<input type="hidden" name="action" value="resend">
					<h2>Resend Activation Email?</h2>
					<p>Do you want to resend the activation email to the user "<?php echo e($user->email); ?>"?</p>
					<button type="submit" class="button">Resend Activation Email</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>

		<?php endif; ?>

	<?php else: ?>

		<div class="expanded row">
			<div class="small-12 columns">
				<div class="alert callout"><strong>We were unable to find the user account you are looking for.</strong></div>
			</div>
		</div>

	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script src="/assets/js/components/acl.js"></script>

	<script type="text/javascript" language="JavaScript">
	<!--

		$(document).ready( function() {

			// ********************************************************************************
			// Reset modal inputs when they are opened
			// --------------------------------------------------------------------------------

			$(document).on( 'open.fndtn.reveal', '[data-reveal]', function () {

				var modal = $(this);

				// Remove all errors from the modal
				$(this).find( ".alert-box").addClass( "hide" );
				$(this).find( "label, .input").removeClass( "error" );
				$(this).find( ".error").remove();

				if ( $(modal).attr( "id" ) == "setPasswordModal" ) {
					$("#setPasswordForm .alert-box").addClass( "hide" );
					$("#setPasswordForm label, #setPasswordForm .input").removeClass( "error" );
					$("#setPasswordForm .error").remove();
					$("#setPasswordForm .password").val( "" );
					$("#setPasswordForm .change_password").prop( "checked", false );
				}

			});

			<?php if( setting( 'userEmailChangedEmailAdminEnable' ) ): ?>

				// ********************************************************************************
				// Display alert if the user's e-mail address is being changed
				// --------------------------------------------------------------------------------
	
				$("#editUserForm input[name=email]").on( "keyup", function(e) {
					if ( $("#editUserForm input[name=email]").val() != $("#editUserForm input[name=email]").attr( "data-form-original-value" ) ) {
						$("#editUserForm .emailChangeAlert").removeClass( "hide" );
					}
					else {
						$("#editUserForm .emailChangeAlert").addClass( "hide" );
					}
				});
	
				// ********************************************************************************
				// Revert changes to the user's e-mail address
				// --------------------------------------------------------------------------------
	
				$("#editUserForm .revertEmail").on( "click", function(e) {
					$("#editUserForm input[name=email]").val( $("#editUserForm input[name=email]").attr( "data-form-original-value" ) );
					$("#editUserForm .emailChangeAlert").addClass( "hide" );
					$("#editUserForm input[name=email]").focus();
				});

			<?php endif; ?>

		});

	//-->
	</script>

<?php $__env->appendSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>