<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Get first category ID
        $categoryId = DB::table('blog_categories')->first()->id;

        // Create the main blog post
        $blogId = DB::table('blogs')->insertGetId([
            'cat_id' => $categoryId,
            'title' => 'The Environmental Impact of Piping Materials: Sustainable Choices for Green Building Projects',
            'slug' => Str::slug('The Environmental Impact of Piping Materials: Sustainable Choices for Green Building Projects'),
            'page_image' => 'blogs-banner-final.jpg',
            'image_1' => 'blog1.jpeg',
            'short_description' => 'In the present construction industry, sustainability is considered to be crucial. Engineers, architects and builders are largely focusing on eco-friendly and sustainable materials in order to reduce environmental footprints.',
            'long_description' => 'In the present construction industry, sustainability is considered to be crucial. Engineers, architects and builders are largely focusing on eco-friendly and sustainable materials in order to reduce environmental footprints. A crucial aspect of such endeavour is the selection of the correct piping materials which largely influences water conservation, energy efficiency and making an overall positive environmental impact. As a prominent leader in the polymer pipes and fittings industry, Skipper Pipes is wholesomely dedicated to offering sustainable piping solutions which aim to reduce ecological impact along with ensuring exceptional durability and performance. There are different environmental implications of various piping materials and it highlights why Skipper Pipes is exceptional in becoming the optimal choice for green building projects.',
            'status' => true,
            'published_at' => '2025-06-14',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add tags to the blog
        $tags = DB::table('blog_tags')->pluck('id')->toArray();
        foreach ($tags as $tagId) {
            DB::table('blog_tag')->insert([
                'blog_id' => $blogId,
                'tag_id' => $tagId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add comments to the blog
        DB::table('blog_comments')->insert([
            [
                'blog_id' => $blogId,
                'name' => 'Md Sohag Miah',
                'email' => 'sohag@example.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum assumenda nobis adipisci voluptas sint corporis, voluptate fugit quas quisquam illum!',
                'status' => true,
                'created_at' => '2025-05-28',
                'updated_at' => '2025-05-28',
            ],
            [
                'blog_id' => $blogId,
                'name' => 'Md Sohag Miah',
                'email' => 'sohag@example.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum assumenda nobis adipisci voluptas sint corporis!',
                'status' => true,
                'created_at' => '2025-04-17',
                'updated_at' => '2025-04-17',
            ],
        ]);

        // Create additional sample blogs
        $additionalBlogs = [
            [
                'title' => 'Innovation in Plumbing: The Future of Pipe Systems',
                'image' => 'blog2.jpeg',
            ],
            [
                'title' => 'Water Conservation: Smart Plumbing Solutions',
                'image' => 'blog3.jpeg',
            ],
        ];

        foreach ($additionalBlogs as $blog) {
            $blogId = DB::table('blogs')->insertGetId([
                'cat_id' => $categoryId,
                'title' => $blog['title'],
                'slug' => Str::slug($blog['title']),
                'page_image' => 'blogs-banner-final.jpg',
                'image_1' => $blog['image'],
                'short_description' => 'Sample short description for ' . $blog['title'],
                'long_description' => 'Sample long description for ' . $blog['title'],
                'status' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add some tags to each blog
            $randomTags = array_rand($tags, 2);
            foreach ($randomTags as $tagIndex) {
                DB::table('blog_tag')->insert([
                    'blog_id' => $blogId,
                    'tag_id' => $tags[$tagIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
