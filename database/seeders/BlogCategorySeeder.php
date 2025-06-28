<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Plumbing & Sewage'],
            ['name' => 'Agriculture'],
            ['name' => 'Borewell'],
            ['name' => 'HDPE Pipes'],
            ['name' => 'Marina Tank'],
            ['name' => 'Bath Fittings'],
        ];

        foreach ($categories as $category) {
            DB::table('blog_categories')->insert([
                'title' => $category['name'],
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
