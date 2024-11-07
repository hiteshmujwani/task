<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::firstOrCreate(['name' => 'edit-post']);
        Permission::firstOrCreate(['name' => 'delete-post']);

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $authorRole = Role::firstOrCreate(['name' => 'author']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['edit-post', 'delete-post']);
        $authorRole->givePermissionTo('edit-post'); // Authors can only edit their own post

        // You can also assign roles to users in the seeder, but that's optional
    }
}
