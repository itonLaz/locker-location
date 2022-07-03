<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Preset Permissions
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create booking']);
        Permission::create(['name' => 'view report']);
        Permission::create(['name' => 'export report']);
        Permission::create(['name' => 'add roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'add permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'delete permissions']);

        
        //Create Admin Role and Apply Roles
        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo('add users');
        $admin_role->givePermissionTo('edit users');
        $admin_role->givePermissionTo('view users');
        $admin_role->givePermissionTo('delete users');
        $admin_role->givePermissionTo('create booking');
        $admin_role->givePermissionTo('view report');
        $admin_role->givePermissionTo('export report');
        $admin_role->givePermissionTo('add roles');
        $admin_role->givePermissionTo('edit roles');
        $admin_role->givePermissionTo('view roles');
        $admin_role->givePermissionTo('delete roles');
        $admin_role->givePermissionTo('add permissions');
        $admin_role->givePermissionTo('edit permissions');
        $admin_role->givePermissionTo('view permissions');
        $admin_role->givePermissionTo('delete permissions');

        $admin = User::create([
            'name' => 'Admin Admin', 
        	'email' => 'admin@argon.com',
        	'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole($admin_role);


        $member_role = Role::create(['name' => 'member']);
        $member_role->givePermissionTo('create booking');
        $member_role->givePermissionTo('view report');
        $member_role->givePermissionTo('view roles');
        $member_role->givePermissionTo('view permissions');



        $member = User::create([
            'name' => 'Member',
            'email' => 'member@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $member->assignRole($member_role);
        

        $super_admin_role = Role::create(['name' => 'Super Admin']);
        //No need to add permission since it is already set via Gate::before, see AuthServiceProvider

        $super_admin = User::create([
            'name' => 'Super Admin', 
        	'email' => 'super_admin@argon.com',
        	'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $super_admin->assignRole($super_admin_role);
        
    }
}
