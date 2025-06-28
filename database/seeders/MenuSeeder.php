<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->truncate();

        // Top level menus
        $home = DB::table('menus')->insertGetId([
            'title' => 'Home',
            'slug' => 'home',
            'sequence' => 1,
        ]);

        $company = DB::table('menus')->insertGetId([
            'title' => 'Company',
            'slug' => 'company',
            'sequence' => 2,
        ]);

        $products = DB::table('menus')->insertGetId([
            'title' => 'Products',
            'slug' => 'products',
            'sequence' => 3,
        ]);

        $network = DB::table('menus')->insertGetId([
            'title' => 'Network',
            'slug' => 'network',
            'sequence' => 4,
        ]);

        $partner = DB::table('menus')->insertGetId([
            'title' => 'Partner',
            'slug' => 'partner',
            'sequence' => 5,
        ]);

        $resources = DB::table('menus')->insertGetId([
            'title' => 'Resources',
            'slug' => 'resources',
            'sequence' => 6,
        ]);

        $contact = DB::table('menus')->insertGetId([
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'sequence' => 7,
        ]);

        // Company submenu
        $companySubmenus = [
            ['title' => 'Overview', 'sequence' => 1],
            ['title' => 'Leadership', 'sequence' => 2],
            ['title' => 'Manufacturing', 'sequence' => 3],
            ['title' => 'CSR', 'sequence' => 4],
            ['title' => 'Certifications', 'sequence' => 5],
        ];

        foreach ($companySubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'sequence' => $menu['sequence'],
                'parent_id' => $company,
            ]);
        }

        // Products submenu
        $productsSubmenus = [
            ['title' => 'Why Skipper Pipes', 'sequence' => 1],
        ];

        foreach ($productsSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'sequence' => $menu['sequence'],
                'parent_id' => $products,
            ]);
        }

        // Plumbing & Sewage submenu
        $plumbing = DB::table('menus')->insertGetId([
            'title' => 'Plumbing & Sewage',
            'slug' => 'plumbing-and-sewage',
            'sequence' => 2,
            'parent_id' => $products,
        ]);

        $plumbingSubmenus = [
            ['title' => 'UPVC Pipes', 'sequence' => 1],
            ['title' => 'CPVC Pipes', 'sequence' => 2],
            ['title' => 'SWR Pipes', 'sequence' => 3],
        ];

        foreach ($plumbingSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'sequence' => $menu['sequence'],
                'parent_id' => $plumbing,
            ]);
        }

        // Agriculture Pipes
        DB::table('menus')->insert([
            'title' => 'Agriculture Pipes',
            'slug' => 'agriculture-pipes',
            'sequence' => 3,
            'parent_id' => $products,
        ]);

        // Borewell submenu
        $borewell = DB::table('menus')->insertGetId([
            'title' => 'Borewell',
            'slug' => 'borewell',
            'sequence' => 4,
            'parent_id' => $products,
        ]);

        $borewellSubmenus = [
            ['title' => 'Casing Pipes', 'sequence' => 1],
            ['title' => 'Column Pipes', 'sequence' => 2],
            ['title' => 'Ribbed Strainer Pipes', 'sequence' => 3],
        ];

        foreach ($borewellSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'sequence' => $menu['sequence'],
                'parent_id' => $borewell,
            ]);
        }

        // Other product items
        $otherProducts = [
            ['title' => 'HDPE Pipes', 'sequence' => 5],
            ['title' => 'Marina Tank', 'sequence' => 6],
            ['title' => 'Bath Fittings', 'sequence' => 7],
        ];

        foreach ($otherProducts as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'sequence' => $menu['sequence'],
                'parent_id' => $products,
            ]);
        }

        // Resources submenu
        $resourcesSubmenus = [
            ['title' => 'News', 'sequence' => 1],
            ['title' => 'Blogs', 'sequence' => 2],
            ['title' => 'Media', 'sequence' => 3],
            ['title' => 'FAQs', 'sequence' => 4],
        ];

        foreach ($resourcesSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'sequence' => $menu['sequence'],
                'parent_id' => $resources,
            ]);
        }
    }
}