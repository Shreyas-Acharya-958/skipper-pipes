<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Plumbing & Sewage',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Agriculture',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Borewell',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'HDPE Pipes',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Marina Tank',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Bath Fittings',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ]
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}
