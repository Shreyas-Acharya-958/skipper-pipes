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
            height: auto;
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
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('storage/' . $blogs_section_two->image ?? '') }}" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>{{ $blogs_section_two->title ?? 'Blogs' }}</h1>
            <p>{!! $blogs_section_two->description ??
                'Gain industry insights, professional guidance, and technical
                                                    knowledge to make smarter, more efficient infrastructure decisions.' !!}
            </p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>{{ $blogs_section_two->title ?? 'Blogs' }}</h1>
            <p>{!! $blogs_section_two->description ??
                'Gain industry insights, professional guidance, and technical
                            knowledge to make smarter, more efficient infrastructure decisions.' !!}
            </p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('storage/' . $blogs_section_two->image ?? '') }}" alt="">
        </div>
    </section>
    <!-- Hero banner-section ends -->


    <section class="main-blogs-grid blog-area home-blog default-padding">
        <div class="container">
            <div class="blog-items">
                <div class="row" id="blog-container">
                    @foreach ($blogs as $index => $blog)
                        <!-- Single Item -->
                        <div class="col-lg-4 col-md-6 single-item blog-item" data-page="{{ ceil(($index + 1) / 6) }}"
                            style="display: {{ $index < 6 ? 'block' : 'none' }};">
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
                                                            {{ $blog->published_at ? $blog->published_at->format('d F, Y') : '' }}
                                                        @endif
                                                    </span>
                                                </a>
                                            </li>
                                            @if ($blog->category)
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-folder"></i>
                                                        <span>{{ $blog->category->title }} </span>
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
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row" id="pagination-container" style="display: {{ count($blogs) > 6 ? 'block' : 'none' }};">
                    <div class="col-md-12 pagi-area text-center ml-auto">
                        <nav aria-label="navigation">
                            <ul class="pagination" id="pagination">
                                <!-- Pagination will be generated by JavaScript -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const itemsPerPage = 6;
            const totalItems = $('.blog-item').length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            let currentPage = 1;

            // Generate pagination
            function generatePagination() {
                if (totalPages <= 1) {
                    $('#pagination-container').hide();
                    return;
                }

                let paginationHtml = '';

                // Previous button
                paginationHtml +=
                    '<li class="page-item"><a class="page-link" href="#" data-page="prev"><i class="fas fa-angle-double-left"></i></a></li>';

                // Page numbers
                for (let i = 1; i <= totalPages; i++) {
                    const activeClass = i === currentPage ? 'active' : '';
                    paginationHtml +=
                        `<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                }

                // Next button
                paginationHtml +=
                    '<li class="page-item"><a class="page-link" href="#" data-page="next"><i class="fas fa-angle-double-right"></i></a></li>';

                $('#pagination').html(paginationHtml);
            }

            // Show page
            function showPage(page) {
                currentPage = page;

                // Hide all items
                $('.blog-item').hide();

                // Show items for current page
                $('.blog-item').each(function() {
                    const itemPage = parseInt($(this).data('page'));
                    if (itemPage === page) {
                        $(this).show();
                    }
                });

                // Update pagination
                generatePagination();

                // Scroll to top
                $('html, body').animate({
                    scrollTop: $('.main-blogs-grid').offset().top - 100
                }, 500);
            }

            // Handle pagination clicks
            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();

                const page = $(this).data('page');

                if (page === 'prev') {
                    if (currentPage > 1) {
                        showPage(currentPage - 1);
                    }
                } else if (page === 'next') {
                    if (currentPage < totalPages) {
                        showPage(currentPage + 1);
                    }
                } else {
                    showPage(parseInt(page));
                }
            });

            // Initialize pagination
            generatePagination();
        });
    </script>
@endsection
