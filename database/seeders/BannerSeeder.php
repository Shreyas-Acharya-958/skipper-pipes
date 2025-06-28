<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'id' => 1,
                'title' => 'banner 1',
                'image' => 'banners/test-banner-1751114625.jpg',
                'sequence' => 1,
                'link' => null,
                'status' => 1,
                'created_at' => '2025-06-28 10:13:26',
                'updated_at' => '2025-06-28 12:44:48'
            ],
            [
                'id' => 2,
                'title' => 'banner2',
                'image' => 'banners/banner2-banner-1751114646.jpeg',
                'sequence' => 2,
                'link' => null,
                'status' => 1,
                'created_at' => '2025-06-28 12:44:06',
                'updated_at' => '2025-06-28 12:44:06'
            ],
            [
                'id' => 3,
                'title' => 'banner 3',
                'image' => 'banners/banner3-banner-1751114668.jpeg',
                'sequence' => 3,
                'link' => null,
                'status' => 1,
                'created_at' => '2025-06-28 12:44:28',
                'updated_at' => '2025-06-28 12:44:28'
            ]
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}