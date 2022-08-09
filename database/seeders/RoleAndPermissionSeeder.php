<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'developer']);
        $role1->givePermissionTo([
            'read roles',
            'read permissions',
        ]);

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo([
            'create roles',
            'read roles',
            'update roles',
            'create permissions',
            'read permissions',
            'read permissions',
            'update permissions',
        ]);

        $role3 = Role::create(['name' => 'super-admin']);

        // create users
        $user = User::create([
            'name' => 'test developer',
            'email' => 'developer1@tashicell.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'name' => 'test admin',
            'email' => 'admin1@tashicell.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role2);

        $user = User::create([
            'name' => 'super admin',
            'email' => 'superadmin@tashicell.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role3);

    }
}
