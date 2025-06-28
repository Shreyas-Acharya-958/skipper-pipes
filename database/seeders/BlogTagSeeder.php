<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogTagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            'Skipper Pipes',
            'Environmental',
            'Sustainable',
            'Pipe Manufacturer',
            'Polymer pipes',
        ];

        foreach ($tags as $tag) {
            DB::table('blog_tags')->insert([
                'name' => $tag,
                'slug' => Str::slug($tag),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
