<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Get Admin role
        $adminRole = Role::where('slug', 'admin')->first();

        if (!$adminRole) {
            $this->command->warn('Admin role not found. Please run RoleSeeder first.');
            return;
        }

        // Only create users if they don't exist (production-safe)
        // This prevents overwriting existing users in production
        $users = [
            [
                'name' => 'Palkesh Patel',
                'email' => 'patel.palkesh@gmail.com',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
                'role_id' => $adminRole->id,
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
                'role_id' => $adminRole->id,
            ],
            [
                'name' => 'User Admin',
                'email' => 'user@admin.com',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
                'role_id' => $adminRole->id,
            ],
        ];

        foreach ($users as $userData) {
            // Only create if user doesn't exist
            $existingUser = User::where('email', $userData['email'])->first();

            if (!$existingUser) {
                User::create($userData);
                $this->command->info("Created user: {$userData['email']}");
            } else {
                // If user exists but has no role, assign admin role
                if (!$existingUser->role_id) {
                    $existingUser->update(['role_id' => $adminRole->id]);
                    $this->command->info("Assigned admin role to existing user: {$userData['email']}");
                } else {
                    $this->command->line("User already exists with role: {$userData['email']}");
                }
            }
        }

        // Assign admin role to all existing users without a role (production-safe)
        $usersWithoutRole = User::whereNull('role_id')->get();
        if ($usersWithoutRole->count() > 0) {
            User::whereNull('role_id')->update(['role_id' => $adminRole->id]);
            $this->command->info("Assigned admin role to {$usersWithoutRole->count()} existing user(s) without role.");
        }
    }
}
