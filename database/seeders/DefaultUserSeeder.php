<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'superadmin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Application User
        $user = User::create([
            'name' => 'Student1',
            'email' => 'student@example.com',
            'password' => Hash::make('student1')
        ]);
        $user->assignRole('User');
    }
}
