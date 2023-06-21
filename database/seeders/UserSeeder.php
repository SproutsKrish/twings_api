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
        $admin_role = Role::create(['name' => 'Super Admin']);
        $user_role = Role::create(['name' => 'Admin']);

        //Give PermissionToRole
        $admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
        ]);

        $user_role->givePermissionTo([
            $user_list
        ]);

        //Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        //Admin User as Admin
        $admin->assignRole($admin_role);

        //Give PermissionToAdminUser Based On Role
        $admin->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
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
