<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'link' => '/',
                'sequence' => 1,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Company',
                'slug' => 'company',
                'link' => '/company',
                'sequence' => 2,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Products',
                'slug' => 'products',
                'link' => '/products',
                'sequence' => 3,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Blog',
                'slug' => 'blog',
                'link' => '/blogs',
                'sequence' => 4,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'link' => '/contact',
                'sequence' => 5,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
