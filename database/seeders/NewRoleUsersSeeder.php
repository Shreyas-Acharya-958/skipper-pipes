<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

/**
 * This seeder creates users for Lead Management and Content Management roles.
 *
 * You can modify the email addresses and names below before running.
 */
class NewRoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $leadManagementRole = Role::where('slug', 'lead-management')->first();
        $contentManagementRole = Role::where('slug', 'content-management')->first();

        if (!$leadManagementRole || !$contentManagementRole) {
            $this->command->error('Roles not found. Please run RoleSeeder first.');
            return;
        }

        // Lead Management User
        $leadManagementUser = User::updateOrCreate(
            ['email' => 'lead@skipperpipes.com'], // Change this email if needed
            [
                'name' => 'Lead Management User',
                'email' => 'lead@skipperpipes.com',
                'password' => Hash::make('123456789'), // Change this password
                'email_verified_at' => now(),
                'role_id' => $leadManagementRole->id,
            ]
        );

        if ($leadManagementUser->wasRecentlyCreated) {
            $this->command->info("✅ Created Lead Management user: {$leadManagementUser->email}");
        } else {
            $this->command->line("ℹ️  Lead Management user already exists: {$leadManagementUser->email}");
        }

        // Content Management User
        $contentManagementUser = User::updateOrCreate(
            ['email' => 'content@skipperpipes.com'], // Change this email if needed
            [
                'name' => 'Content Management User',
                'email' => 'content@skipperpipes.com',
                'password' => Hash::make('123456789'), // Change this password
                'email_verified_at' => now(),
                'role_id' => $contentManagementRole->id,
            ]
        );

        if ($contentManagementUser->wasRecentlyCreated) {
            $this->command->info("✅ Created Content Management user: {$contentManagementUser->email}");
        } else {
            $this->command->line("ℹ️  Content Management user already exists: {$contentManagementUser->email}");
        }

        $this->command->info("\n📋 Login Credentials:");
        $this->command->line("Lead Management:");
        $this->command->line("  Email: lead@skipperpipes.com");
        $this->command->line("  Password: 123456789");
        $this->command->line("  URL: /lead-management");
        $this->command->line("\nContent Management:");
        $this->command->line("  Email: content@skipperpipes.com");
        $this->command->line("  Password: 123456789");
        $this->command->line("  URL: /content-management");
    }
}