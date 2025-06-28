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
            'Plumbing & Sewage',
            'Agriculture Pipes',
            'Borewell',
            'HDPE Pipes',
            'Marina Tank',
            'Bath Fittings'
        ];

        foreach ($categories as $category) {
            ProductCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => $category . ' products category',
                'status' => true
            ]);
        }
    }
}
