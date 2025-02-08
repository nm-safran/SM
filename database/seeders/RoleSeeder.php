<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $user = Role::create(['name' => 'User']);

        $superAdmin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-studentdetail',
            'edit-studentdetail',
            'delete-studentdetail'
        ]);

        $user->givePermissionTo([
            'view-studentdetail'
        ]);
    }
}
