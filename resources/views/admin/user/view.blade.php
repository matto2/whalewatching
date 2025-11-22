@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('View/Change User') }}</title>
@endsection

@section('title')

	<div id="breadcrumbs" class="expanded row">
		<div class="small-12 columns">
			<nav aria-label="You are here:" role="navigation">
				<ul class="breadcrumbs">
					<li><a href="/">Home</a></li>
					<li><a href="{{ route( 'admin' ) }}">Administration</a></li>
					<li><a href="{{ route( 'admin.user' ) }}">User Accounts</a></li>
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

@endsection

@section('content')

	@if ( $user )

		<div class="expanded row">

			<div class="small-12 columns">

				<div class="ajax-alerts"></div>

				@if ( auth()->check() && $user->id == auth()->user()->id )
					<div class="warning callout">
						<strong>This is your account.</strong> Some items cannot be changed while you are logged on to your own account.
					</div>
				@endif

				@if ( !$user->enabled )
					<div class="warning callout">
						<strong>This user's account is disabled.</strong>
					</div>
				@endif
	
				<ul id="userAccountTabs" class="tabs" data-tabs>
					<li class="tabs-title is-active"><a href="#userAccountTab" aria-selected="true">Account</a></li>
					<li class="tabs-title"><a href="#userOrdersTab">Orders</a></li>
				</ul>

				<div class="tabs-content" data-tabs-content="userAccountTabs">

					<div id="userAccountTab" class="tabs-panel is-active">

						<div id="original" class="hide">
							<input class="email" type="hidden" value="{{ $user->email }}">
						</div>
			
						<div class="expanded row">

							{{-- ******************************************************************************** --}}
							{{-- Account Information                                                              --}}
							{{-- -------------------------------------------------------------------------------- --}}
	
							<div class="small-12 columns">

								<div class="secondary callout">
					
									<h2>Account Information</h2>
					
									<div class="expanded row">
										<div class="smal-12 medium-6 columns">
											<label>First Name:
												<input class="input first-focus" type="text" name="firstName" disabled="disabled" placeholder="First Name" value="{{ $user->first_name}}">
											</label>
										</div>
										<div class="small-12 medium-6 columns">
											<label>Last Name:
												<input class="input" type="text" name="lastName" disabled="disabled" placeholder="Last Name" value="{{ $user->last_name}}">
											</label>
										</div>
									</div>
						
									<div class="expanded row">
										<div class="large-12 columns">
											<label>E-mail Address:
												<input class="input" type="email" name="email" disabled="disabled" placeholder="E-mail Address" value="{{ $user->email }}" data-form-original-value="{{ $user->email }}">
											</label>
											@if ( setting( 'userEmailChangedEmailAdminEnable' ) )
												<div class="emailChangeAlert primary callout hide">
													<strong>Changing this user's email address will result in email confirmations being sent to the old and new addresses.</strong> <a class="revertEmail" href="#">Undo changes?</a>
												</div>
											@endif
										</div>
									</div>
			
									<label><input type="checkbox" name="isAdministrator" disabled="disabled" data-form-initial-value="{{ $user->administrator }}"> User is a site administrator</label>
					
									@if ( auth()->user()->id == 1 )
										<label><input type="checkbox" name="hidden" data-form-initial-value="{{ $user->hidden }}"> Hidden user account</label>
									@endif

								</div>

							</div>

							{{-- ******************************************************************************** --}}
							{{-- Password and Account Activation                                                  --}}
							{{-- -------------------------------------------------------------------------------- --}}
	
							<div class="small-12 columns">

								<div class="secondary callout">

									@if ( $user->enabled )
					
										@if ( !$user->activated )

											<div id="userActivationFieldset">
							
												<h2>Account Activation</h2>
							
												<div id="notActivatedAlertBox" class="primary callout">
													<strong>This user's account has not yet been activated.</strong>
												</div>
							
												<button class="button secondary" type="button" data-open="activateUserModal">Activate User</button>
												<button class="button secondary" type="button" data-open="resendActivationMessageModal">Resend Activation E-Mail</button>
							
											</div>

										@endif
				
										<div id="userPasswordFieldset">
											
											<h2>Password</h2>
					
											@if ( $user->password_expires != 0 && $user->password_expires <= \Carbon\Carbon::now() )
												<div class="alert callout">
													This user's password has expired.
												</div>
											@else
												<div class="primary callout hide">
													This user's password has expired.
												</div>
											@endif
					
											<label><input type="checkbox" name="neverExpire" disabled="disabled" data-form-initial-value="{{ $user->password_never_expires }}"> Password does not expire</label>
									
											<button type="button" class="button secondary" data-open="setPasswordModal">Set Password</button>
					
											@if ( auth()->check() && $user->id != auth()->user()->id )
												<button type="button" class="button secondary" data-open="resetPasswordModal">Email New Password</button>
												@if ( $user->password_expires == 0 || $user->password_expires > \Carbon\Carbon::now() )
													<button type="button" id="expirePasswordButton" class="button secondary" data-open="expirePasswordModal">Expire Password</button>
												@else
													<button type="button" id="expirePasswordButton" class="button secondary hide" data-open="expirePasswordModal">Expire Password</button>
												@endif
											@endif
			
											@if ( setting( 'userPasswordremember' ) > 0 )
												<button type="button" class="button secondary" data-open="clearPasswordHistoryModal">Clear Password History</button>
											@endif
		
										</div>

									@endif
				
								</div>

							</div>
	
						{{-- ******************************************************************************** --}}
						{{-- User Addresses                                                                   --}}
						{{-- -------------------------------------------------------------------------------- --}}

						<div class="small-12 columns">

							<div class="secondary callout">
		
								<h2>Addresses</h2>
		
								@if ( $user->addresses()->count() )
		
									<table>
		
										<thead>
		
											<tr>
												<th>Address Name</th>
											</tr>
		
										</thead>
		
										<tbody>
											@foreach ( $user->addresses()->orderBy( 'name', 'asc' )->get() as $address )
												<tr data-click="{{ route( 'admin.user.address.view', [ $user->id, $address->id ] ) }}">
													<td>{{ $address->name }}</td>
												</tr>
											@endforeach
										</tbody>
		
									</table>
		
								@else
		
									<div class="primary callout">
										This user does not have any saved addresses.
									</div>
		
								@endif
		
							</div>

						</div>

						{{-- ******************************************************************************** --}}
						{{-- Usage Summary                                                                    --}}
						{{-- -------------------------------------------------------------------------------- --}}

						<div class="small-12 columns">

							<div class="secondary callout">
				
								<h2>Usage Summary</h2>
				
								<table>
				
									<tr>
										<th class="text-right">Activated:</th>
										@if ( $user->isActivated() )
											<td>{{ $user->activated }}</td>
										@else
											<td>Not Activated</td>
										@endif
									</tr>
				
									<tr>
										<th class="text-right">Last Login:</th>
										@if ( $user->last_logon == 0 )
											<td>Never Logged On</td>
										@else
											<td>{{ $user->last_logon }}</td>
										@endif
									</tr>
				
									<tr>
										<th class="text-right">Password Expires:</th>
										@if ( $user->password_expires == 0 )
											<td>Does Not Expire</td>
										@else
											<td>{{ $user->password_expires }}</td>
										@endif
									</tr>
				
									<tr>
										<th class="text-right">Password Last Changed:</th>
										@if ( $user->password_last_changed == 0 )
											<td>Never Changed</td>
										@else
											<td>{{ $user->password_last_changed }}</td>
										@endif
									</tr>
				
								</table>
				
							</div>
						</div>

					</div>

					<div id="userOrdersTab" class="tabs-panel is-active">
						orders
					</div>

				</div>

			</div>

		</div>
	
		<div class="expanded row">

			<div class="small-12 columns">

				<a class="button secondary" href="{{ route( 'admin.user' ) }}" title="Return to the main user account administration page">Back to User Accounts</a>

			</div>

		</div>

		<div id="setPasswordModal" class="reveal" data-reveal data-close-on-click="false">

			<form id="setPasswordForm" method="post" action="{{ route( 'admin.user.password', $user->id ) }}" data-form-ajax data-form-ajax-reload>

				<input type="hidden" name="action" value="set">

				<h2>Set Password</h2>

				<p>Enter a new password below for user '{{ $user->email}}'.</p>

				<label>New Password:
					<input class="first-focus" type="text" name="password" placeholder="New Password">
				</label>

				@if ( auth()->check() && $user->id != auth()->user()->id )
					<label>
						<input type="checkbox" name="change_password" title="Require user to change their password on next logon">
						Require user to change their password on next logon
					</label>
				@endif

				<button type="submit" class="button">Set Password</button>
				<button type="button" class="button secondary" data-close>Cancel</button>

				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>

			</form>

		</div>

		<div id="expirePasswordModal" class="reveal" data-reveal data-close-on-click="false">
			<form id="activateUserForm" method="post" action="{{ route( 'admin.user.password', $user->id ) }}" data-form-ajax data-form-ajax-reload>
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
			<form id="activateUserForm" method="post" action="{{ route( 'admin.user.password', $user->id ) }}" data-form-ajax data-form-ajax-reload>
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
			<form id="clearPasswordHistoryForm" method="post" action="{{ route( 'admin.user.password', $user->id ) }}" data-form-ajax>
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

		@if ( $user->enabled )
			<div id="disableUserModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="disableUserForm" method="post" action="{{ route( 'admin.user.disable', $user->id ) }}" data-form-ajax data-form-ajax-reload>
					<h2>Disable User?</h2>
					<p><strong>Are you sure you want to disable the user "{{ $user->email}}"?</strong> This will prevent this user from being able to log on.</p>
					<button type="submit" class="button alert">Disable User</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>
		@else
			<div id="enableUserModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="enableUserForm" method="post" action="{{ route( 'admin.user.enable', $user->id ) }}" data-form-ajax data-form-ajax-reload>
					<h2>Enable User?</h2>
					<p><strong>Are you sure you want to enable the user "{{ $user->email}}"?</strong> Once enabled, this user will be able to log on to their account.</p>
					<button type="submit" class="button primary">Enable User</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>
		@endif

		<div id="deleteUserModal" class="reveal" data-reveal data-close-on-click="false">
			<form id="deleteUserForm" method="post" action="{{ route( 'admin.user.delete', $user->id ) }}" data-form-ajax>
				<h2>Delete User?</h2>
				<p><strong>Are you sure you want to delete the user "{{ $user->email}}"?</strong> This action cannot be undone.</p>
				<button type="submit" class="button alert">Delete User</button>
				<button type="button" class="button secondary" data-close>Cancel</button>
				<button class="close-button" data-close aria-label="Close reveal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>

		@if ( !$user->isActivated() )

			<div id="activateUserModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="activateUserForm" method="post" action="{{ route( 'admin.user.activate', $user->id ) }}" data-form-ajax data-form-ajax-reload>
					<input type="hidden" name="action" value="activate">
					<h2>Activate This User?</h2>
					<p>Do you want to activate the user account for "{{ $user->email}}"?</p>
					<button type="submit" class="button primary">Activate User</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>
	
			<div id="resendActivationMessageModal" class="reveal" data-reveal data-close-on-click="false">
				<form id="activateUserForm" method="post" action="{{ route( 'admin.user.activate', $user->id ) }}" data-form-ajax>
					<input type="hidden" name="action" value="resend">
					<h2>Resend Activation Email?</h2>
					<p>Do you want to resend the activation email to the user "{{ $user->email}}"?</p>
					<button type="submit" class="button">Resend Activation Email</button>
					<button type="button" class="button secondary" data-close>Cancel</button>
					<button class="close-button" data-close aria-label="Close reveal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</form>
			</div>

		@endif

	@else

		<div class="expanded row">
			<div class="small-12 columns">
				<div class="alert callout"><strong>We were unable to find the user account you are looking for.</strong></div>
			</div>
		</div>

	@endif

@endsection

@section('scripts')

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

			@if ( setting( 'userEmailChangedEmailAdminEnable' ) )

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

			@endif

		});

	//-->
	</script>

@append
