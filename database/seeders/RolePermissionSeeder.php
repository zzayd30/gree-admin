<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User permissions
            'View Users',
            'Create Users',
            'Edit Users',
            'Delete Users',
            
            // Role permissions
            'View Roles',
            'Create Roles',
            'Edit Roles',
            'Delete Roles',
            
            // Permission permissions
            'View Permissions',
            'Create Permissions',
            'Edit Permissions',
            'Delete Permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Assign all permissions to superadmin
        $superAdminRole->syncPermissions(Permission::all());

        // Assign specific permissions to admin
        $adminRole->syncPermissions([
            'View Users',
            'Create Users',
            'Edit Users',
            'View Roles',
            'View Permissions',
        ]);

        // Assign basic permissions to user
        $userRole->syncPermissions([
            'View Users',
        ]);

        // Assign superadmin role to first user if exists
        $firstUser = User::first();
        if ($firstUser && !$firstUser->hasRole('Super Admin')) {
            $firstUser->assignRole('Super Admin');
            $this->command->info('Superadmin role assigned to first user: ' . $firstUser->email);
        }
    }
}
