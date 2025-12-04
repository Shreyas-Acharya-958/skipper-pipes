@extends('content-management.layouts.app')

@section('title', 'Dashboard')
@section('content')
    <style>
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-4">Content Management Dashboard</h2>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('content-management.blogs.index') }}" class="text-decoration-none">
                <div class="card mb-4 text-white bg-info card-hover">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">
                                {{ $stats['blogs'] }}
                            </div>
                            <div>Blogs</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('content-management.blog_categories.index') }}" class="text-decoration-none">
                <div class="card mb-4 text-white bg-warning card-hover">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">
                                {{ $stats['blog_categories'] }}
                            </div>
                            <div>Blog Categories</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('content-management.products.index') }}" class="text-decoration-none">
                <div class="card mb-4 text-white bg-primary card-hover">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">
                                {{ $stats['products'] }}
                            </div>
                            <div>Products</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('content-management.product_categories.index') }}" class="text-decoration-none">
                <div class="card mb-4 text-white bg-success card-hover">
                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">
                                {{ $stats['product_categories'] }}
                            </div>
                            <div>Product Categories</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

