<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogComment;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'cat_id' => 1,
                'title' => 'The Environmental Impact of Piping Materials: Sustainable Choices for Green Building Projects',
                'page_image' => 'blogs/the-environmental-impact-of-piping-materials-sustainable-choices-for-green-building-projects-page_image-1751135501.jpg',
                'image_1' => 'blogs/the-environmental-impact-of-piping-materials-sustainable-choices-for-green-building-projects-image_1-1751126820.jpeg',
                'image_2' => null,
                'slug' => 'the-environmental-impact-of-piping-materials-sustainable-choices-for-green-building-projects',
                'short_description' => 'In the present construction industry, sustainability is considered to be crucial. Engineers, architects and builders are largely focusing on eco-friendly and sustainable materials in order to reduce environmental footprints.',
                'long_description' => '<p>In the present construction industry, sustainability is considered to be crucial. Engineers, architects and builders are largely focusing on eco-friendly and sustainable materials in order to reduce environmental footprints. A crucial aspect of such endeavour is the selection of the correct piping materials which largely influences water conservation, energy efficiency and making an overall positive environmental impact. As a prominent leader in the polymer pipes and fittings industry, Skipper Pipes is wholesomely dedicated to offering sustainable piping solutions which aim to reduce ecological impact along with ensuring exceptional durability and performance. There are different environmental implications of various piping materials and it highlights why Skipper Pipes is exceptional in becoming the optimal choice for green building projects.</p>...',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'published_at' => '2025-06-13 18:30:00',
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-29 03:08:43'
            ],
            [
                'cat_id' => 1,
                'title' => 'Innovation in Plumbing: The Future of Pipe Systems',
                'page_image' => 'blogs/the-environmental-impact-of-piping-materials-sustainable-choices-for-green-building-projects-page_image-1751135501.jpg',
                'image_1' => 'blogs/the-environmental-impact-of-piping-materials-sustainable-choices-for-green-building-projects-image_1-1751126820.jpeg',
                'image_2' => null,
                'slug' => 'innovation-in-plumbing-the-future-of-pipe-systems',
                'short_description' => 'In the present construction industry, sustainability is considered to be crucial. Engineers, architects and builders are largely focusing on eco-friendly and sustainable materials in order to reduce environmental footprints.',
                'long_description' => '<p>In the present construction industry, sustainability is considered to be crucial. Engineers, architects and builders are largely focusing on eco-friendly and sustainable materials in order to reduce environmental footprints. A crucial aspect of such endeavour is the selection of the correct piping materials which largely influences water conservation, energy efficiency and making an overall positive environmental impact...</p>',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'published_at' => '2025-06-28 08:27:00',
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-29 03:17:11'
            ],
            [
                'cat_id' => 1,
                'title' => 'Water Conservation: Smart Plumbing Solutions',
                'page_image' => 'blogs/the-environmental-impact-of-piping-materials-sustainable-choices-for-green-building-projects-page_image-1751135501.jpg',
                'image_1' => 'blogs/the-environmental-impact-of-piping-materials-sustainable-choices-for-green-building-projects-image_1-1751126820.jpeg',
                'image_2' => null,
                'slug' => 'water-conservation-smart-plumbing-solutions',
                'short_description' => 'Sample short description for Water Conservation: Smart Plumbing Solutions',
                'long_description' => '<p>In the present construction industry, sustainability is considered to be crucial. Engineers, architects and builders are largely focusing on eco-friendly and sustainable materials in order to reduce environmental footprints...</p>',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'published_at' => '2025-06-10 08:27:00',
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-29 03:09:58'
            ]
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }

        // Add blog comments
        $comments = [
            [
                'blog_id' => 1,
                'name' => 'Md Sohag Miah',
                'email' => 'sohag@example.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum assumenda nobis adipisci voluptas sint corporis, voluptate fugit quas quisquam illum!',
                'status' => 1,
                'created_at' => '2025-05-27 18:30:00',
                'updated_at' => '2025-05-27 18:30:00'
            ],
            [
                'blog_id' => 1,
                'name' => 'Md Sohag Miah',
                'email' => 'sohag@example.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum assumenda nobis adipisci voluptas sint corporis!',
                'status' => 1,
                'created_at' => '2025-04-16 18:30:00',
                'updated_at' => '2025-04-16 18:30:00'
            ]
        ];

        foreach ($comments as $comment) {
            BlogComment::create($comment);
        }
    }
}
