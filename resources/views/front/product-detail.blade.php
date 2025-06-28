@extends('front.layouts.app')

@section('content')
    <!-- Product Detail Section -->
    <section class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-detail__img">
                        @if ($product->page_image)
                            <img src="{{ asset('storage/' . $product->page_image) }}" alt="{{ $product->title }}"
                                class="img-fluid">
                        @else
                            <img src="{{ asset('assets/img/final/project1.jpg') }}" alt="{{ $product->title }}"
                                class="img-fluid">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-detail__content">
                        <h2 class="product-detail__title">{{ $product->title }}</h2>
                        <div class="product-detail__category">
                            <span>Category:</span> {{ $product->category->name }}
                        </div>

                        @if ($product->product_overview)
                            <div class="product-detail__overview">
                                <h3>Overview</h3>
                                {!! $product->product_overview !!}
                            </div>
                        @endif

                        @if ($product->features_benefits)
                            <div class="product-detail__features">
                                <h3>Features & Benefits</h3>
                                {!! $product->features_benefits !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if ($product->product_overview_image)
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="product-detail__overview-image">
                            <img src="{{ asset('storage/' . $product->product_overview_image) }}" alt="Overview"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .product-detail {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .product-detail__img {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .product-detail__img img {
            width: 100%;
            height: auto;
        }

        .product-detail__content {
            padding: 20px;
        }

        .product-detail__title {
            font-size: 32px;
            margin-bottom: 20px;
            color: #333;
        }

        .product-detail__category {
            margin-bottom: 20px;
            color: #666;
        }

        .product-detail__category span {
            font-weight: bold;
            color: #333;
        }

        .product-detail__overview,
        .product-detail__features {
            margin-top: 30px;
        }

        .product-detail__overview h3,
        .product-detail__features h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        .product-detail__overview p,
        .product-detail__features p {
            color: #666;
            line-height: 1.6;
        }

        .product-detail__features ul {
            padding-left: 20px;
        }

        .product-detail__features li {
            margin-bottom: 10px;
            color: #666;
        }

        .product-detail__overview-image {
            margin-top: 40px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
