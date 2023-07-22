<?php

namespace Database\Seeders;

use App\Models\User;

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
        $user_index = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users-index']);
        $user_store = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users-store']);
        $user_show = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users-show']);
        $user_update = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users-update']);
        $user_showdet = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users-showdet']);
        $user_delete = Permission::create(['module_id' => '1', 'page_id' => '1', 'name' => 'users-delete']);



        //Creating Role
        $super_admin_role = Role::create(['name' => 'Super Admin']);
        $admin_role = Role::create(['name' => 'Admin']);
        $distributor_role = Role::create(['name' => 'Distributor']);
        $dealer = Role::create(['name' => 'Dealer']);
        $subdealer = Role::create(['name' => 'SubDealer']);
        $client = Role::create(['name' => 'Client']);
        $vehicle_owner = Role::create(['name' => 'Vehicle Owner']);
        $user_role = Role::create(['name' => 'User']);


        //Give PermissionToRole
        $super_admin_role->givePermissionTo([
            $user_index,
            $user_store,
            $user_show,
            $user_update,
            $user_showdet
        ]);

        $admin_role->givePermissionTo([
            $user_index,
            $user_store,
            $user_show
        ]);

        $user_role->givePermissionTo([
            $user_index
        ]);

        //Admin User
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('password'),
            'secondary_password' => bcrypt('twingszxc')
        ]);

        //Super Admin as Super Admin
        $superadmin->assignRole($super_admin_role);

        //Give PermissionToAdminUser Based On Role
        $superadmin->givePermissionTo([
            $user_index,
            $user_store,
            $user_show,
            $user_update,
            $user_showdet,
        ]);

        //Admin As Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'secondary_password' => bcrypt('twingszxc')
        ]);

        $admin->assignRole($admin_role);

        $admin->givePermissionTo([
            $user_index,
            $user_store,
            $user_show
        ]);

        //User As User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'secondary_password' => bcrypt('twingszxc')
        ]);

        $user->assignRole($user_role);

        $user->givePermissionTo([
            $user_index
        ]);
    }
}
