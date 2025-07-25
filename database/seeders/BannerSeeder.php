<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use Carbon\Carbon;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'banner 1',
                'image' => 'banners/test-banner-1751114625.jpg',
                'mobile_image' => null,
                'sequence' => 1,
                'link' => null,
                'status' => 1,
                'created_at' => '2025-06-28 04:43:26',
                'updated_at' => '2025-06-28 07:14:48'
            ],
            [
                'title' => 'banner2',
                'image' => 'banners/banner2-banner-1751114646.jpeg',
                'mobile_image' => null,
                'sequence' => 2,
                'link' => null,
                'status' => 1,
                'created_at' => '2025-06-28 07:14:06',
                'updated_at' => '2025-06-28 07:14:06'
            ],
            [
                'title' => 'banner 3',
                'image' => 'banners/banner-3-banner-1751121402.jpeg',
                'mobile_image' => null,
                'sequence' => 3,
                'link' => null,
                'status' => 1,
                'created_at' => '2025-06-28 07:14:28',
                'updated_at' => '2025-06-28 09:06:42'
            ]
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
