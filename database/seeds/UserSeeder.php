<?php
 
	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;
	use App\Models\ACL\Permission;
	use App\Models\ACL\Role;
	use App\Models\ACL\RolePermission;
	use App\Models\User\User;
	use App\Models\User\UserAddress;
	use App\Models\User\UserPermission;
	use App\Models\User\UserRole;
	use App\Models\System\Setting;

	class UserSeeder extends Seeder {
 
		public function run() {

			// Create user permission records
			$userPermission[0] = Permission::create([ 'name' => 'Users - Add Accounts',    'identifier' => 'admin.user.add' ]);
			$userPermission[1] = Permission::create([ 'name' => 'Users - Delete Accounts', 'identifier' => 'admin.user.delete' ]);
			$userPermission[2] = Permission::create([ 'name' => 'Users - Edit Accounts',   'identifier' => 'admin.user.edit' ]);
			$userPermission[3] = Permission::create([ 'name' => 'Users - View Accounts',   'identifier' => 'admin.user.view' ]);
			$userPermission[4] = Permission::create([ 'name' => 'Users - Change Settings', 'identifier' => 'admin.user.settings.edit' ]);
			$userPermission[5] = Permission::create([ 'name' => 'Users - View Settings',   'identifier' => 'admin.user.settings.view' ]);

			// User administrator role
			$userRole[0] = Role::create([ 'name' => 'User Account Administrator', 'identifier' => 'admin.user' ]);
			$userRole[0]->permissions()->saveMany([
				new RolePermission([ 'acl_permission_id' => $userPermission[0]->id ]),
				new RolePermission([ 'acl_permission_id' => $userPermission[1]->id ]),
				new RolePermission([ 'acl_permission_id' => $userPermission[2]->id ]),
				new RolePermission([ 'acl_permission_id' => $userPermission[3]->id ]),
				new RolePermission([ 'acl_permission_id' => $userPermission[4]->id ]),
				new RolePermission([ 'acl_permission_id' => $userPermission[5]->id ]),
			]);

			// Default user accounts
			$user = User::create([
				'administrator'          => true,
				'first_name'             => 'Eric',
				'last_name'              => 'Costella',
				'email'                  => 'eric@costellafamily.com',
				'password'               => Hash::make( 'xFeD5JrE' ),
				'password_never_expires' => true,
				'activated'              => date( 'Y-m-d H:i:s' ),
				'hidden'                 => true,
			]);

			User::create([
				'administrator'          => false,
				'first_name'             => 'Daren',
				'last_name'              => 'Barry',
				'email'                  => 'daren@web4uinc.com',
				'password'               => Hash::make( 'bigboobs69' ),
				'password_never_expires' => true,
				'activated'              => date( 'Y-m-d H:i:s' ),
			]);

			Setting::create([ 'key' => 'userEmailSenderName',                   'value' => 'IDI' ]);
			Setting::create([ 'key' => 'userEmailSenderAddress',                'value' => 'eric@costellafamily.com' ]);
			Setting::create([ 'key' => 'userEmailAdminSenderName',              'value' => 'IDI Admin' ]);
			Setting::create([ 'key' => 'userEmailAdminSenderAddress',           'value' => 'eric@costellafamily.com' ]);

			Setting::create([ 'key' => 'userSignupEnable',                      'value' => 1 ]);
			Setting::create([ 'key' => 'userEmailWelcomeEnable',                'value' => 1 ]);
			Setting::create([ 'key' => 'userEmailWelcomeSubject',               'value' => 'Welcome to IDI!' ]);
			Setting::create([ 'key' => 'userEmailWelcomeAdminEnable',           'value' => 1 ]);
			Setting::create([ 'key' => 'userEmailWelcomeAdminSubject',          'value' => 'Welcome to IDI! (Admin)' ]);
			Setting::create([ 'key' => 'userEmailAdminNotifyEnable',            'value' => 1 ]);
			Setting::create([ 'key' => 'userEmailAdminNotifyInterval',          'value' => 'immediate' ]);
			Setting::create([ 'key' => 'userEmailAdminNotifyRecipient',         'value' => 'eric@costellafamily.com' ]);
			Setting::create([ 'key' => 'userEmailAdminNotifyRecipientCC',       'value' => '' ]);
			Setting::create([ 'key' => 'userEmailAdminNotifyRecipientBCC',      'value' => '' ]);
			Setting::create([ 'key' => 'userEmailAdminNotifySubject',           'value' => 'New User Created on the IDI Web Site' ]);

			Setting::create([ 'key' => 'userActivateEnable',                    'value' => 1 ]);
			Setting::create([ 'key' => 'userActivateEmailSubject',              'value' => 'Activate Your IDI Account' ]);
			Setting::create([ 'key' => 'userActivateEmailAdminSubject',         'value' => 'Activate Your IDI Account (Admin)' ]);
			Setting::create([ 'key' => 'userActivateEmailCompleteSubject',      'value' => 'Your IDI Account Is Now Activated' ]);

			Setting::create([ 'key' => 'userLockoutEnable',                     'value' => 1 ]);
			Setting::create([ 'key' => 'userLockoutAttempts',                   'value' => 3 ]);
			Setting::create([ 'key' => 'userLockoutWindow',                     'value' => 10 ]);
			Setting::create([ 'key' => 'userLockoutDuration',                   'value' => 60 ]);

			Setting::create([ 'key' => 'userPasswordNoExpireEnable',            'value' => 1 ]);
			Setting::create([ 'key' => 'userPasswordLengthMin',                 'value' => 6 ]);
			Setting::create([ 'key' => 'userPasswordLengthMax',                 'value' => 255 ]);
			Setting::create([ 'key' => 'userPasswordAgeMin',                    'value' => 0 ]);
			Setting::create([ 'key' => 'userPasswordAgeMax',                    'value' => 0 ]);
			Setting::create([ 'key' => 'userPasswordRemember',                  'value' => 0 ]);
			Setting::create([ 'key' => 'userPasswordChangedEmailEnable',        'value' => 1 ]);
			Setting::create([ 'key' => 'userPasswordChangedEmailSubject',       'value' => 'Your IDI Password Was Changed' ]);
			Setting::create([ 'key' => 'userPasswordChangedEmailAdminEnable',   'value' => 1 ]);
			Setting::create([ 'key' => 'userPasswordChangedEmailAdminSubject',  'value' => 'We Have Reset Your IDI Password' ]);

			Setting::create([ 'key' => 'userPasswordResetEmailSubject',         'value' => 'Reset Your IDI Password' ]);
			Setting::create([ 'key' => 'userPasswordResetEmailAdminSubject',    'value' => 'Reset Your IDI Password (Admin)' ]);

			Setting::create([ 'key' => 'userEmailChangedEmailEnable',           'value' => 1 ]);
			Setting::create([ 'key' => 'userEmailChangedEmailSubject',          'value' => 'Your IDI E-Mail Address Was Changed' ]);
			Setting::create([ 'key' => 'userEmailChangedEmailAdminEnable',      'value' => 1 ]);
			Setting::create([ 'key' => 'userEmailChangedEmailAdminSubject',     'value' => 'We Have Changed Your IDI E-Mail Address' ]);

		}
 
	}

?>

