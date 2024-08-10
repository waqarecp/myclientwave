<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilities = [
            'read', 'write', 'create',
        ];

        $permissions_by_role = [
            'admin' => [
                'user', 'role', 'permission', 'leads'
            ],
            'operator' => [
                'leads'
            ]
        ];

        foreach ($permissions_by_role['admin'] as $permission) {
            foreach ($abilities as $ability) {
                Permission::create(['name' => $ability . ' ' . $permission]);
            }
        }

        foreach ($permissions_by_role as $role => $permissions) {
            $full_permissions_list = [];
            foreach ($abilities as $ability) {
                foreach ($permissions as $permission) {
                    $full_permissions_list[] = $ability . ' ' . $permission;
                }
            }
            Role::create(['name' => $role])->syncPermissions($full_permissions_list);
        }

        // Retrieve the roles
        $adminRole = Role::where('name', 'admin')->first();
        $operatorRole = Role::where('name', 'operator')->first();

        // Assign the 'admin' role to the first 2 users
        User::find([1, 2])->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
        });

        // Assign the 'operator' role to all other users
        User::whereNotIn('id', [1, 2])->get()->each(function ($user) use ($operatorRole) {
            $user->assignRole($operatorRole);
        });
    }
}
