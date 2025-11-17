<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // All permissions
        $permissions = [
            'manage-doctors',
            'view-doctors',
            'create-doctors',
            'edit-doctors',
            'delete-doctors',

            'manage-specializations',
            'view-specializations',
            'create-specializations',
            'edit-specializations',
            'delete-specializations',

            'manage-appointments',
            'view-appointments',
            'view-own-appointments',
            'create-appointments',
            'update-appointment-status',
            'add-diagnosis',

            'manage-schedules',
            'view-schedules',
            'create-schedules',
            'edit-schedules',
            'delete-schedules',

            'manage-users',
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
        ];

        // Create permissions with guard_name
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $doctor = Role::firstOrCreate(['name' => 'doctor', 'guard_name' => 'web']);
        $patient = Role::firstOrCreate(['name' => 'patient', 'guard_name' => 'web']);

        // Assign permissions
        $admin->syncPermissions([
            'manage-doctors', 'view-doctors', 'create-doctors', 'edit-doctors', 'delete-doctors',
            'manage-specializations', 'view-specializations', 'create-specializations', 'edit-specializations', 'delete-specializations',
            'manage-appointments', 'view-appointments',
            'manage-users', 'view-users', 'create-users', 'edit-users', 'delete-users',
        ]);

        $doctor->syncPermissions([
            'view-own-appointments',
            'update-appointment-status',
            'add-diagnosis',
            'manage-schedules', 'view-schedules', 'create-schedules', 'edit-schedules', 'delete-schedules',
        ]);

        $patient->syncPermissions([
            'view-doctors',
            'create-appointments',
            'view-own-appointments',
        ]);
    }
}
