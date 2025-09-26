<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JalRakshakPhotoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'BHARAT CHAKRA',
                'slug' => 'bharat-chakra',
                'description' => 'Bharat Chakra category',
                'is_active' => true
            ],
            [
                'name' => 'SAMAJ SEBI',
                'slug' => 'samaj-sebi',
                'description' => 'Samaj Sebi category',
                'is_active' => true
            ],
            [
                'name' => 'MUDIALI CLUB',
                'slug' => 'mudiali-club',
                'description' => 'Mudiali Club category',
                'is_active' => true
            ],
            [
                'name' => 'COMMUNITY EVENTS',
                'slug' => 'community-events',
                'description' => 'Community Events category',
                'is_active' => true
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\JalRakshakPhotoCategory::create($category);
        }
    }
}
