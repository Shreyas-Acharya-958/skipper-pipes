<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

/**
 * This seeder is safe to run in production.
 * It assigns the Admin role to all existing users who don't have a role assigned.
 * This should be run after RoleSeeder on production deployments.
 */
class AssignRolesToExistingUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Admin role
        $adminRole = Role::where('slug', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Admin role not found. Please run RoleSeeder first.');
            return;
        }

        // Find all users without a role
        $usersWithoutRole = User::whereNull('role_id')->get();

        if ($usersWithoutRole->count() === 0) {
            $this->command->info('All users already have roles assigned.');
            return;
        }

        // Assign admin role to all users without a role
        User::whereNull('role_id')->update(['role_id' => $adminRole->id]);

        $this->command->info("Successfully assigned admin role to {$usersWithoutRole->count()} user(s).");

        foreach ($usersWithoutRole as $user) {
            $this->command->line("  - {$user->email} ({$user->name})");
        }
    }
}
