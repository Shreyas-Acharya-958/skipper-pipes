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
            'link' => '/',
            'sequence' => 1,
        ]);

        $company = DB::table('menus')->insertGetId([
            'title' => 'Company',
            'slug' => 'company',
            'link' => 'company',
            'sequence' => 2,
        ]);

        $products = DB::table('menus')->insertGetId([
            'title' => 'Products',
            'slug' => 'products',
            'link' => 'products',
            'sequence' => 3,
        ]);

        $network = DB::table('menus')->insertGetId([
            'title' => 'Network',
            'slug' => 'network',
            'link' => 'network',
            'sequence' => 4,
        ]);

        $partner = DB::table('menus')->insertGetId([
            'title' => 'Partner',
            'slug' => 'partner',
            'link' => 'partner',
            'sequence' => 5,
        ]);

        $resources = DB::table('menus')->insertGetId([
            'title' => 'Resources',
            'slug' => 'resources',
            'link' => 'resources',
            'sequence' => 6,
        ]);

        $contact = DB::table('menus')->insertGetId([
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'link' => 'contact',
            'sequence' => 7,
        ]);

        // Company submenu
        $companySubmenus = [
            ['title' => 'Overview', 'link' => 'company/overview', 'sequence' => 1],
            ['title' => 'Leadership', 'link' => 'company/leadership', 'sequence' => 2],
            ['title' => 'Manufacturing', 'link' => 'company/manufacturing', 'sequence' => 3],
            ['title' => 'CSR', 'link' => 'company/csr', 'sequence' => 4],
            ['title' => 'Certifications', 'link' => 'company/certifications', 'sequence' => 5],
        ];

        foreach ($companySubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'link' => $menu['link'],
                'sequence' => $menu['sequence'],
                'parent_id' => $company,
            ]);
        }

        // Products submenu
        $productsSubmenus = [
            ['title' => 'Why Skipper Pipes', 'link' => 'products/why-skipper-pipes', 'sequence' => 1],
        ];

        foreach ($productsSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'link' => $menu['link'],
                'sequence' => $menu['sequence'],
                'parent_id' => $products,
            ]);
        }

        // Plumbing & Sewage submenu
        $plumbing = DB::table('menus')->insertGetId([
            'title' => 'Plumbing & Sewage',
            'slug' => 'plumbing-and-sewage',
            'link' => 'products/plumbing-and-sewage',
            'sequence' => 2,
            'parent_id' => $products,
        ]);

        $plumbingSubmenus = [
            ['title' => 'UPVC Pipes', 'link' => 'products/plumbing-and-sewage/upvc-pipes', 'sequence' => 1],
            ['title' => 'CPVC Pipes', 'link' => 'products/plumbing-and-sewage/cpvc-pipes', 'sequence' => 2],
            ['title' => 'SWR Pipes', 'link' => 'products/plumbing-and-sewage/swr-pipes', 'sequence' => 3],
        ];

        foreach ($plumbingSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'link' => $menu['link'],
                'sequence' => $menu['sequence'],
                'parent_id' => $plumbing,
            ]);
        }

        // Agriculture Pipes
        DB::table('menus')->insert([
            'title' => 'Agriculture Pipes',
            'slug' => 'agriculture-pipes',
            'link' => 'products/agriculture-pipes',
            'sequence' => 3,
            'parent_id' => $products,
        ]);

        // Borewell submenu
        $borewell = DB::table('menus')->insertGetId([
            'title' => 'Borewell',
            'slug' => 'borewell',
            'link' => 'products/borewell',
            'sequence' => 4,
            'parent_id' => $products,
        ]);

        $borewellSubmenus = [
            ['title' => 'Casing Pipes', 'link' => 'products/borewell/casing-pipes', 'sequence' => 1],
            ['title' => 'Column Pipes', 'link' => 'products/borewell/column-pipes', 'sequence' => 2],
            ['title' => 'Ribbed Strainer Pipes', 'link' => 'products/borewell/ribbed-strainer-pipes', 'sequence' => 3],
        ];

        foreach ($borewellSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'link' => $menu['link'],
                'sequence' => $menu['sequence'],
                'parent_id' => $borewell,
            ]);
        }

        // Other product items
        $otherProducts = [
            ['title' => 'HDPE Pipes', 'link' => 'products/hdpe-pipes', 'sequence' => 5],
            ['title' => 'Marina Tank', 'link' => 'products/marina-tank', 'sequence' => 6],
            ['title' => 'Bath Fittings', 'link' => 'products/bath-fittings', 'sequence' => 7],
        ];

        foreach ($otherProducts as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'link' => $menu['link'],
                'sequence' => $menu['sequence'],
                'parent_id' => $products,
            ]);
        }

        // Resources submenu
        $resourcesSubmenus = [
            ['title' => 'News', 'link' => 'resources/news', 'sequence' => 1],
            ['title' => 'Blogs', 'link' => 'resources/blogs', 'sequence' => 2],
            ['title' => 'Media', 'link' => 'resources/media', 'sequence' => 3],
            ['title' => 'FAQs', 'link' => 'resources/faqs', 'sequence' => 4],
        ];

        foreach ($resourcesSubmenus as $menu) {
            DB::table('menus')->insert([
                'title' => $menu['title'],
                'slug' => Str::slug($menu['title']),
                'link' => $menu['link'],
                'sequence' => $menu['sequence'],
                'parent_id' => $resources,
            ]);
        }
    }
}
