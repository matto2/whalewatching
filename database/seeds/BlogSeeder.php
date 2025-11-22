<?php

	use App\Models\ACL\Permission;
	use App\Models\ACL\Role;
	use App\Models\ACL\RolePermission;
	use App\Models\Blog\Blog;
	use App\Models\System\Setting;
	use Illuminate\Database\Seeder;
	use Illuminate\Database\Eloquent\Model;

	class BlogSeeder extends Seeder {

		public function run() {

			Setting::create([ 'key' => 'blogActiveDefault', 'value' => 1 ]);
			Setting::create([ 'key' => 'blogHiddenDefault', 'value' => 0 ]);
			Setting::create([ 'key' => 'blogRestrictedDefault', 'value' => 0 ]);
			Setting::create([ 'key' => 'blogAllowCommentsDefault', 'value' => 0 ]);

			Setting::create([ 'key' => 'blogEntryActiveDefault', 'value' => 1 ]);
			Setting::create([ 'key' => 'blogEntryHiddenDefault', 'value' => 0 ]);
			Setting::create([ 'key' => 'blogEntryRestrictedDefault', 'value' => 0 ]);
			Setting::create([ 'key' => 'blogEntryAllowCommentsDefault', 'value' => 0 ]);

			// Create blog permission records
			$blogPermission[0] = Permission::create([ 'name' => 'Blog - Add Entries',     'identifier' => 'admin.blog.entry.add' ]);
			$blogPermission[1] = Permission::create([ 'name' => 'Blog - Edit Entries',    'identifier' => 'admin.blog.entry.edit' ]);
			$blogPermission[2] = Permission::create([ 'name' => 'Blog - View Entries',    'identifier' => 'admin.blog.entry.view' ]);
			$blogPermission[3] = Permission::create([ 'name' => 'Blog - Change Settings', 'identifier' => 'admin.blog.settings.edit' ]);
			$blogPermission[4] = Permission::create([ 'name' => 'Blog - View Settings',   'identifier' => 'admin.blog.settings.view' ]);

			// Blog administrator role
			$blogRole[0] = Role::create([ 'name' => 'Blog Administrator', 'identifier' => 'admin.blog' ]);
			$blogRole[0]->permissions()->saveMany([
				new RolePermission([ 'acl_permission_id' => $blogPermission[0]->id ]),
				new RolePermission([ 'acl_permission_id' => $blogPermission[1]->id ]),
				new RolePermission([ 'acl_permission_id' => $blogPermission[2]->id ]),
				new RolePermission([ 'acl_permission_id' => $blogPermission[3]->id ]),
				new RolePermission([ 'acl_permission_id' => $blogPermission[4]->id ]),
			]);

			// Blog editor role
			$blogRole[1] = Role::create([ 'name' => 'Blog Editor', 'identifier' => 'admin.blog.editor' ]);
			$blogRole[1]->permissions()->saveMany([
				new RolePermission([ 'acl_permission_id' => $blogPermission[0]->id ]),
				new RolePermission([ 'acl_permission_id' => $blogPermission[1]->id ]),
				new RolePermission([ 'acl_permission_id' => $blogPermission[2]->id ]),
			]);

			$user = \App\Models\User\User::find( 2 );
			$user->roles()->save( new \App\Models\User\UserRole([ 'acl_role_id' => $blogRole[0]->id ]) );

			Blog::create([ 'name' => 'Blog', 'slug' => 'blog' ]);

		}

	}

?>
