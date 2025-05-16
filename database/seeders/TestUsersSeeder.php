<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Method 1: updateOrCreate
        User::updateOrCreate(
            ['email' => 'admin@mindcraft.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'mentor@mindcraft.com'],
            [
                'name' => 'Mentor User',
                'password' => Hash::make('password'),
                'role' => 'mentor',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'student@mindcraft.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('password'),
                'role' => 'mentee',
                'email_verified_at' => now(),
            ]
        );

        echo "Test users created/updated successfully!\n";
    }
}