@extends('layouts.admin')

@section('head')
	<title>{{ pageTitle('User Account Settings') }}</title>
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
						<span class="show-for-sr">Current: </span> Settings
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="pageTitle" class="expanded row">
		<div class="small-12 columns">
			<h1>User Account Settings</h1>
			<div id="alerts" data-form-ajax-alerts></div>
		</div>
	</div>

@endsection

@section('content')

	<div class="expanded row">

		<div class="small-12 columns">

			<form id="userSettingsForm" method="post" action="{{ route('admin.user.settings' ) }}" data-form-ajax>

				<div class="secondary callout">

					<h2>E-Mail Sender Settings</h2>

					<p>These settings configure who the sender is for all user-related e-mail messages.</p>

					<p>
						<strong>Front End Sender Details</strong><br>
						This is the name and e-mail address that's used for all emails sent in response to user-initiated actions.
					</p>

					<div class="expanded row">
						<div class="small-12 medium-6 columns">
							<label>
								Sender Name:
								<input type="text" name="userEmailSenderName" value="{{ setting( 'userEmailSenderName' ) }}" placeholder="">
							</label>
						</div>
						<div class="small-12 medium-6 columns">
							<label>
								Sender E-mail Address:
								<input type="text" name="userEmailSenderAddress" value="{{ setting( 'userEmailSenderAddress' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>Administrator Sender Details</strong><br>
						This is the name and e-mail address that's used for all emails sent in response to administrator-initiated actions.
					</p>

					<div class="expanded row">
						<div class="small-12 medium-6 columns">
							<label>
								Sender Name:
								<input type="text" name="userEmailAdminSenderName" value="{{ setting( 'userEmailAdminSenderName' ) }}" placeholder="">
							</label>
						</div>
						<div class="small-12 medium-6 columns">
							<label>
								Sender E-mail Address:
								<input type="text" name="userEmailAdminSenderAddress" value="{{ setting( 'userEmailAdminSenderAddress' ) }}" placeholder="">
							</label>
						</div>
					</div>

				</div>

				<div class="secondary callout">

					<h2>New User Accounts</h2>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								@if ( setting( 'userSignupEnable' ) )
									<input type="checkbox" name="userSignupEnable" checked="checked">
								@else
									<input type="checkbox" name="userSignupEnable">
								@endif
								Enable new user signups
							</label>
						</div>
					</div>

					<p>
						<strong>New User Welcome Message</strong><br>
						This message is sent to all new users. If account activation is enabled, this message is not sent. The Account Activation Complete message will be sent instead.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								@if ( setting( 'userEmailWelcomeEnable' ) )
									<input type="checkbox" name="userEmailWelcomeEnable" checked="checked">
								@else
									<input type="checkbox" name="userEmailWelcomeEnable">
								@endif
								Enable the New User Welcome Message
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userEmailWelcomeSubject" value="{{ setting( 'userEmailWelcomeSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>New User Welcome Message - Admin</strong><br>
						This message is sent to all new users created by an administrator. If account activation is enabled, this message is not sent. The Account Activation Complete message will be sent instead.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								@if ( setting( 'userEmailWelcomeAdminEnable' ) )
									<input type="checkbox" name="userEmailWelcomeAdminEnable" checked="checked">
								@else
									<input type="checkbox" name="userEmailWelcomeAdminEnable">
								@endif
								Enable the New User Welcome Message
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userEmailWelcomeAdminSubject" value="{{ setting( 'userEmailWelcomeAdminSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>New User Administrator Notification Message</strong><br>
						When enabled, a message is sent to the specified recipients each time a new user account is created.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								@if ( setting( 'userEmailAdminNotifyEnable' ) )
									<input type="checkbox" name="userEmailAdminNotifyEnable" checked="checked">
								@else
									<input type="checkbox" name="userEmailAdminNotifyEnable">
								@endif
								Enable the New User Administrator Notification Message
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								When to Send:
								<select name="userEmailAdminNotifyInterval" data-form-initial-value="{{ setting( 'userEmailAdminNotifyInterval' ) }}">
									<option value="immediate">As soon as the account is created</option>
									<option value="daily">Send a Daily summary</option>
									<option value="weekly">Send a Weekly summary every Sunday</option>
								</select>
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 medium-4 columns">
							<label>
								Send To:
								<input type="text" name="userEmailAdminNotifyRecipient" value="{{ setting( 'userEmailAdminNotifyRecipient' ) }}" placeholder="">
							</label>
						</div>
						<div class="small-12 medium-4 columns">
							<label>
								CC To:
								<input type="text" name="userEmailAdminNotifyRecipientCC" value="{{ setting( 'userEmailAdminNotifyRecipientCC' ) }}" placeholder="">
							</label>
						</div>
						<div class="small-12 medium-4 columns">
							<label>
								BCC To:
								<input type="text" name="userEmailAdminNotifyRecipientBCC" value="{{ setting( 'userEmailAdminNotifyRecipientBCC' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userEmailAdminNotifySubject" value="{{ setting( 'userEmailAdminNotifySubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

				</div>

				<div class="secondary callout">

					<h2>Account Activation</h2>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								@if ( setting( 'userActivateEnable' ) )
									<input type="checkbox" name="userActivateEnable" checked="checked">
								@else
									<input type="checkbox" name="userActivateEnable">
								@endif
								Require new users to verify their e-mail address
							</label>
						</div>
					</div>

					<p>
						<strong>Activate Account Message</strong><br>
						This message is sent to a new user after they sign up for a new account. This message gives the user a link to activate their account.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userActivateEmailSubject" value="{{ setting( 'userActivateEmailSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>Activate Account Message - Admin</strong><br>
						This message is sent to a new user after their account is created by an administrator. This message gives the user a link to activate their account.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userActivateEmailAdminSubject" value="{{ setting( 'userActivateEmailAdminSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>Activation Complete Message</strong><br>
						This message is sent to a new user once they have verified their account. This message takes the place of the Welcome New User message above when verification is enabled.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userActivateEmailCompleteSubject" value="{{ setting( 'userActivateEmailCompleteSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

				</div>

				<div class="secondary callout">

					<h2>Account Lockout</h2>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="userLockoutEnable" data-form-default="{{ setting( 'userLockoutEnable' ) }}">
								Enable Account Lockout after invalid login attempts
							</label>
						</div>
					</div>

					<p>
						<strong>Activate Account Message</strong><br>
						This message is sent to a new user after they sign up for a new account. This message gives the user a link to activate their account.
					</p>

					<div class="expanded row">
						<div class="small-12 medium-6 columns">
							Attempts:
							<div class="input-group">
								<input class="input-group-field" type="text" name="userLockoutAttempts" value="{{ setting( 'userLockoutAttempts' ) }}" placeholder="Attempts">
								<span class="input-group-label">login attempts over</span>
								<input class="input-group-field" type="text" name="userLockoutWindow" value="{{ setting( 'userLockoutWindow' ) }}" placeholder="Minutes">
								<span class="input-group-label">minutes</span>
							</div>
						</div>
						<div class="small-12 medium-6 columns">
							Lockout Duration:
							<div class="input-group">
								<input class="input-group-field" type="text" name="userLockoutDuration" value="{{ setting( 'userLockoutDuration' ) }}" placeholder="Minutes">
								<span class="input-group-label">minutes</span>
							</div>
						</div>
					</div>

				</div>
				
				<div class="secondary callout">

					<h2>Account Restrictions</h2>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								<input type="checkbox" name="userSingleLogin" data-form-initial-value="{{ setting( 'userSingleLogin' ) }}">
								Prevent users from logging on more than once at a time
							</label>
						</div>
					</div>

				</div>

				<div class="secondary callout">

					<h2>Passwords</h2>

					<div class="expanded row">
						<div class="small-12 columns">
							<p>
								<strong>Password Length</strong><br>
								Passwords can be anywhere from 1 to 255 characters in length. Use these settings to define your minimum and maximum length.
							</p>
						</div>
						<div class="small-12 medium-6 columns">
							<label>
								Minimum Password Length (minimum of 1):
								<input type="text" name="userPasswordLengthMin" value="{{ setting( 'userPasswordLengthMin' ) }}" placeholder="Minimum Password Length">
							</label>
						</div>
						<div class="small-12 medium-6 columns">
							<label>
								Maximum Password Length (maximum of 255):
								<input type="text" name="userPasswordLengthMax" value="{{ setting( 'userPasswordLengthMax' ) }}" placeholder="Maximum Password Length">
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<p><strong>Password Age</strong></p>
							<ul>
								<li>Minimum password age limits how often a user can change their password. Set this value to zero for no minimum age.</li>
								<li>Maximum password age determines when a user must change their password (changes to this are NOT retroactive to existing users). Set this value to zero to prevent users from being forced to periodically change their passwords.</li>
								<li>Number of Passwords to Remember prevents a user from re-using a recently-used password. <strong>Note that if you set this value to zero, previously remembered passwords for every user will be deleted and you'll be unable to recover them.</strong></li>
							</p>
						</div>
						<div class="small-12 medium-4 columns">
							<label>
								Minimum Password Age (days):
								<input type="text" name="userPasswordAgeMin" value="{{ setting( 'userPasswordAgeMin' ) }}" placeholder="Minimum Password Age">
							</label>
						</div>
						<div class="small-12 medium-4 columns">
							<label>
								Maximum Password Age (days):
								<input type="text" name="userPasswordAgeMax" value="{{ setting( 'userPasswordAgeMax' ) }}" placeholder="Maximum Password Age">
							</label>
						</div>
						<div class="small-12 medium-4 columns">
							<label>
								Number Passwords to Remember:
								<input type="text" name="userPasswordRemember" value="{{ setting( 'userPasswordRemember' ) }}" placeholder="Number of Passwords to Remember">
							</label>
						</div>
					</div>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								@if ( setting( 'userPasswordNoExpireEnable' ) )
									<input type="checkbox" name="userPasswordNoExpireEnable" checked="checked">
								@else
									<input type="checkbox" name="userPasswordNoExpireEnable">
								@endif
								Allow passwords that never expire (valid only when Maximum Password Age is not zero)
							</label>
						</div>
					</div>

					<p>
						<strong>Password Changed Message</strong><br>
						This message is sent to a new user when they change their password.
					</p>

					<label>
						@if ( setting( 'userPasswordChangedEmailEnable' ) )
							<input type="checkbox" name="userPasswordChangedEmailEnable" checked="checked">
						@else
							<input type="checkbox" name="userPasswordChangedEmailEnable">
						@endif
						Send messages to users when they change their password
					</label>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userPasswordChangedEmailSubject" value="{{ setting( 'userPasswordChangedEmailSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>Password Changed Message - Admin</strong><br>
						This message is sent to a new user when an administrator changes their password.
					</p>

					<label>
						@if ( setting( 'userPasswordChangedEmailAdminEnable' ) )
							<input type="checkbox" name="userPasswordChangedEmailAdminEnable" checked="checked">
						@else
							<input type="checkbox" name="userPasswordChangedEmailAdminEnable">
						@endif
						Send messages to users when an administrator changes their password
					</label>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userPasswordChangedEmailAdminSubject" value="{{ setting( 'userPasswordChangedEmailAdminSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

				</div>

				<div class="secondary callout">

					<h2>Password Reset</h2>

					<p>
						<strong>Reset Password Message</strong><br>
						This message is sent to an existing user when they request a password reset.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userPasswordResetEmailSubject" value="{{ setting( 'userPasswordResetEmailSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>Reset Password Message - Admin</strong><br>
						This message is sent to an existing user when an administrator resets their password.
					</p>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userPasswordResetEmailAdminSubject" value="{{ setting( 'userPasswordResetEmailAdminSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

				</div>

				<div class="secondary callout">

					<h2>E-Mail Address Changes</h2>

					<p>
						<strong>E-Mail Address Changed Message</strong><br>
						This message is sent to an existing user's new and old address when they change their e-mail address.
					</p>

					<label>
						@if ( setting( 'userEmailChangedEmailEnable' ) )
							<input type="checkbox" name="userEmailChangedEmailEnable" checked="checked">
						@else
							<input type="checkbox" name="userEmailChangedEmailEnable">
						@endif
						Send messages to users when they change their e-mail address
					</label>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userEmailChangedEmailSubject" value="{{ setting( 'userEmailChangedEmailSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

					<p>
						<strong>E-Mail Address Changed Message - Admin</strong><br>
						This message is sent to an existing user's new and old address when an administrator changes their e-mail address.
					</p>

					<label>
						@if ( setting( 'userEmailChangedEmailAdminEnable' ) )
							<input type="checkbox" name="userEmailChangedEmailAdminEnable" checked="checked">
						@else
							<input type="checkbox" name="userEmailChangedEmailAdminEnable">
						@endif
						Send messages to users when an administrator changes their e-mail address
					</label>

					<div class="expanded row">
						<div class="small-12 columns">
							<label>
								Subject:
								<input type="text" name="userEmailChangedEmailAdminSubject" value="{{ setting( 'userEmailChangedEmailAdminSubject' ) }}" placeholder="">
							</label>
						</div>
					</div>

				</div>

				<button class="button primary" type="submit">Save Changes</button>
				<a class="button secondary" href="{{ route('admin.user' ) }}" title="Return to the main user account administration page">Cancel</a>

			</form>

		</div>

	</div>

@endsection
