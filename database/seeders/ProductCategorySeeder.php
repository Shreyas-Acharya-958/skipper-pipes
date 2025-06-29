<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Plumbing & Sewage',
                'slug' => 'plumbing-sewage',
                'description' => 'Plumbing & Sewage products category',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Agriculture',
                'slug' => 'agriculture',
                'description' => 'Agriculture products category',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Borewell',
                'slug' => 'borewell',
                'description' => 'Borewell products category',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'HDPE Pipes',
                'slug' => 'hdpe-pipes',
                'description' => 'HDPE Pipes products category',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Marina Tank',
                'slug' => 'marina-tank',
                'description' => 'Marina Tank products category',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Bath Fittings',
                'slug' => 'bath-fittings',
                'description' => 'Bath Fittings products category',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ]
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
