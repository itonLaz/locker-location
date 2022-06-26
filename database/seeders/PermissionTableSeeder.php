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
        
        //Create Admin Role and Apply Roles
        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo('add users');
        $admin_role->givePermissionTo('edit users');
        $admin_role->givePermissionTo('view users');
        $admin_role->givePermissionTo('delete users');
        $admin_role->givePermissionTo('create booking');
        $admin_role->givePermissionTo('view report');
        $admin_role->givePermissionTo('export report');


        $super_admin_role = Role::create(['name' => 'Super Admin']);
        //No need to add permission since it is already set via Gate::before, see AuthServiceProvider

        $admin = User::create([
            'name' => 'Admin Admin', 
        	'email' => 'admin@argon.com',
        	'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole($admin_role);

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
