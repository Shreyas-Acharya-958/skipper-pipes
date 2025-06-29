<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get category IDs
        $plumbingId = ProductCategory::where('name', 'Plumbing & Sewage')->first()->id;
        $agricultureId = ProductCategory::where('name', 'Agriculture')->first()->id;
        $borewellId = ProductCategory::where('name', 'Borewell')->first()->id;
        $hdpeId = ProductCategory::where('name', 'HDPE Pipes')->first()->id;

        $products = [
            // Plumbing & Sewage Category
            [
                'product_category_id' => $plumbingId,
                'title' => 'UPVC Pipes',
                'slug' => 'upvc-pipes',
                'page_image' => 'products/upvc-pipes-page_image-1751176357.jpg',
                'product_overview' => '<div class="col-md-6">...',
                'product_overview_image' => 'products/upvc-overview.jpg',
                'features_benefits' => '<div class="row">...',
                'technical' => '<table class="table table-bordered table-striped">...',
                'application' => '<div class="col-xl-4 col-lg-6 col-md-6">...',
                'faq' => '<div class="col-12">...',
                'brochure' => 'products/brochures/upvc-pipes-brochure-1751180852.pdf',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-29 02:32:05'
            ],
            [
                'product_category_id' => $plumbingId,
                'title' => 'CPVC Pipes',
                'slug' => 'cpvc-pipes',
                'page_image' => 'products/upvc-pipes-page_image-1751176357.jpg',
                'product_overview' => '<div class="col-md-6">...',
                'product_overview_image' => 'products/cpvc-overview.jpg',
                'features_benefits' => '<div class="row">...',
                'technical' => '<table class="table table-bordered table-striped">...',
                'application' => '<div class="col-xl-4 col-lg-6 col-md-6">...',
                'faq' => '<div class="col-12">...',
                'brochure' => null,
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            // Agriculture Category
            [
                'product_category_id' => $agricultureId,
                'title' => 'Agriculture Column Pipes',
                'slug' => 'agriculture-column-pipes',
                'page_image' => 'products/upvc-pipes-page_image-1751176357.jpg',
                'product_overview' => '<div class="col-md-6">...',
                'product_overview_image' => 'products/agri-overview.jpg',
                'features_benefits' => '<div class="row">...',
                'technical' => '<table class="table table-bordered table-striped">...',
                'application' => '<div class="col-xl-4 col-lg-6 col-md-6">...',
                'faq' => '<div class="col-12">...',
                'brochure' => null,
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            // Borewell Category
            [
                'product_category_id' => $borewellId,
                'title' => 'Ribbed Strainer Pipes',
                'slug' => 'ribbed-strainer-pipes',
                'page_image' => 'products/upvc-pipes-page_image-1751176357.jpg',
                'product_overview' => '<div class="col-md-6">...',
                'product_overview_image' => 'products/strainer-overview.jpg',
                'features_benefits' => '<div class="row">...',
                'technical' => '<table class="table table-bordered table-striped">...',
                'application' => '<div class="col-xl-4 col-lg-6 col-md-6">...',
                'faq' => '<div class="col-12">...',
                'brochure' => null,
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            // HDPE Category
            [
                'product_category_id' => $hdpeId,
                'title' => 'HDPE Water Supply Pipes',
                'slug' => 'hdpe-water-supply-pipes',
                'page_image' => 'products/upvc-pipes-page_image-1751176357.jpg',
                'product_overview' => '<div class="col-md-6">...',
                'product_overview_image' => 'products/hdpe-overview.jpg',
                'features_benefits' => '<div class="row">...',
                'technical' => '<table class="table table-bordered table-striped">...',
                'application' => '<div class="col-xl-4 col-lg-6 col-md-6">...',
                'faq' => '<div class="col-12">...',
                'brochure' => null,
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'status' => 1,
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
