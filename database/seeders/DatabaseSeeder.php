<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
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
