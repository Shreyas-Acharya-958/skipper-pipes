@extends('front.layouts.app')

@section('title', 'Skipper Pipes - Blogs')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="hero-banner-img">
                        <img src="{{ asset('assets/img/final/blogs-banner2.jpg') }}" alt="hero-banner">
                    </div>
                    <div class="hero-bg-overlay"></div>
                    <div class="hero-banner-content">
                        <h1>Build Better with Expert Advice</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam dolorum perferendis distinctio
                            perspiciatis soluta sequi, ducimus aliquam eaque eos nihil?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-blogs-grid blog-area home-blog default-padding">
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <!-- Single Item -->
                        <div class="col-lg-4 col-md-6 single-item">
                            <div class="item">
                                <div class="thumb">
                                    <a href="{{ route('front.blogs.show', $blog->slug) }}">
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="meta">
                                        <ul>
                                            <li>
                                                <a href="#"><i class="fas fa-calendar-alt"></i>
                                                    {{ $blog->created_at->format('d M, Y') }}</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fas fa-user-circle"></i> Admin</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h4>
                                        <a href="{{ route('front.blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h4>
                                    <p>
                                        {{ Str::limit(strip_tags($blog->content), 150) }}
                                    </p>
                                    <a class="btn-simple" href="{{ route('front.blogs.show', $blog->slug) }}">Read More <i
                                            class="fas fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-md-12 pagi-area text-center">
                        {{ $blogs->links('vendor.pagination.bootstrap-5-always') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
