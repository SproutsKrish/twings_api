<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating Permissions
        $user_list = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users.list']);
        $user_view = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users.view']);
        $user_create = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users.create']);
        $user_update = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users.update']);
        $user_delete = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users.delete']);

        //Creating Role
        $super_admin_role = Role::create(['name' => 'Super Admin']);
        $admin_role = Role::create(['name' => 'Admin']);
        $user_role = Role::create(['name' => 'User']);

        //Give PermissionToRole
        $super_admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
        ]);

        $admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create
        ]);

        $user_role->givePermissionTo([
            $user_list
        ]);

        //Admin User
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('password')
        ]);

        //Super Admin as Super Admin
        $superadmin->assignRole($super_admin_role);

        //Give PermissionToAdminUser Based On Role
        $superadmin->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
        ]);

        //Admin As Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole($admin_role);

        $admin->givePermissionTo([
            $user_list,
            $user_view,
            $user_create
        ]);

        //User As User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole($user_role);

        $user->givePermissionTo([
            $user_list
        ]);
    }
}
