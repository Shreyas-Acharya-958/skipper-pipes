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
                'description' => 'Bharat Chakra category'
            ],
            [
                'name' => 'SAMAJ SEBI',
                'description' => 'Samaj Sebi category'
            ],
            [
                'name' => 'MUDIALI CLUB',
                'description' => 'Mudiali Club category'
            ],
            [
                'name' => 'COMMUNITY EVENTS',
                'description' => 'Community Events category'
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\JalRakshakPhotoCategory::create($category);
        }
    }
}
