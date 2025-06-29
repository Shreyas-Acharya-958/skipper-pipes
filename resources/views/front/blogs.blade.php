@extends('front.layouts.app')

@section('title', 'Skipper Pipes - Blogs')

@section('styles')
    <style>
        .blog-items .single-item {
            margin-bottom: 30px;
        }

        .blog-items .item {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-items .thumb {
            height: 250px;
            overflow: hidden;
            position: relative;
        }

        .blog-items .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-items .info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-items .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-items .content h4 {
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .blog-items .content p {
            flex: 1;
            margin-bottom: 15px;
        }

        .blog-items .content .more-btn {
            align-self: flex-start;
            margin-top: auto;
        }
    </style>
@endsection

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
                    @forelse($blogs as $blog)
                        <!-- Single Item -->
                        <div class="col-lg-4 col-md-6 single-item">
                            <div class="item">
                                <div class="thumb">
                                    <a href="{{ route('front.blogs.show', $blog->slug) }}">
                                        <img src="{{ asset('storage/' . $blog->image_1) }}" alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="meta">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>
                                                        @if ($blog->published_at)
                                                            {{ $blog->published_at->format('d F, Y') }}
                                                        @else
                                                            {{ $blog->created_at->format('d F, Y') }}
                                                        @endif
                                                    </span>
                                                </a>
                                            </li>
                                            @if ($blog->category)
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-folder"></i>
                                                        <span>{{ $blog->category->name }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <h4>
                                            <a href="{{ route('front.blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h4>
                                        <p>
                                            {{ Str::limit($blog->short_description, 150) }}
                                        </p>
                                        <a class="more-btn" href="{{ route('front.blogs.show', $blog->slug) }}">Read More
                                            <i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                No blogs found.
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                {{-- <div class="row">
                    <div class="col-md-12 pagi-area text-center ml-auto">
                        <nav aria-label="navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fas fa-angle-double-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fas fa-angle-double-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection
