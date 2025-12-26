<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->command->info('🔄 Creating Permissions...');

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
            
            // Category permissions
            'View Categories',
            'Create Categories',
            'Edit Categories',
            'Delete Categories',
            
            // Video permissions
            'View Videos',
            'Create Videos',
            'Edit Videos',
            'Delete Videos',

            // Troubleshoot permissions
            'View Troubleshoots',
            'Create Troubleshoots',
            'Edit Troubleshoots',
            'Delete Troubleshoots',

            // Customer permissions
            'View Customers',
            'Create Customers',
            'Edit Customers',
            'Delete Customers',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('✅ ' . count($permissions) . ' permissions created successfully!');

        $this->command->info('🔄 Creating Roles...');

        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        $this->command->info('✅ Roles created successfully!');

        $this->command->info('🔄 Assigning Permissions to Roles...');

        // Assign all permissions to Super Admin
        $superAdminRole->syncPermissions(Permission::all());

        // Assign specific permissions to Admin
        $adminRole->syncPermissions([
            'View Users',
            'Create Users',
            'Edit Users',
            'View Roles',
            'View Permissions',
            'View Categories',
            'Create Categories',
            'Edit Categories',
            'View Videos',
            'Create Videos',
            'Edit Videos',
            'View Troubleshoots',
            'View Customers',
        ]);

        $this->command->info('✅ Permissions assigned to roles successfully!');

        $this->command->info('🔄 Creating Admin User...');

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12341234'),
                'status' => 'active',
                'role' => 'Super Admin',
            ]
        );

        // Assign Super Admin role to the user
        if (!$admin->hasRole('Super Admin')) {
            $admin->assignRole('Super Admin');
        }

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('');
        $this->command->info('📧 Email: admin@admin.com');
        $this->command->info('🔐 Password: 12341234');
        $this->command->info('👤 Role: Super Admin');
        $this->command->info('');
        $this->command->info('🎉 All done! You can now login with the above credentials.');
    }
}
