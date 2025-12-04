<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * NOTE: For production deployment, run seeders individually:
     * 1. php artisan db:seed --class=RoleSeeder
     * 2. php artisan db:seed --class=AssignRolesToExistingUsersSeeder
     *
     * Do NOT run AdminUserSeeder in production unless you want test users.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class, // Only creates users if they don't exist (production-safe)
            AssignRolesToExistingUsersSeeder::class, // Assigns roles to existing users
            BannerSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
            BlogTagSeeder::class,
            MenuSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            CompanySeeder::class,
        ]);
    }
}
