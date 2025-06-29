<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogTag;
use App\Models\Blog;

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Skipper Pipes',
                'slug' => 'skipper-pipes',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Environmental',
                'slug' => 'environmental',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Sustainable',
                'slug' => 'sustainable',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Pipe Manufacturer',
                'slug' => 'pipe-manufacturer',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Polymer pipes',
                'slug' => 'polymer-pipes',
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ]
        ];

        foreach ($tags as $tag) {
            BlogTag::create($tag);
        }

        // Attach tags to blogs
        $tagRelations = [
            1 => [2, 3],    // Blog 1 has tags 2 and 3
            2 => [2, 3],    // Blog 2 has tags 2 and 3
            3 => [4, 5]     // Blog 3 has tags 4 and 5
        ];

        foreach ($tagRelations as $blogId => $tagIds) {
            $blog = Blog::find($blogId);
            if ($blog) {
                $blog->tags()->attach($tagIds);
            }
        }
    }
}
