@extends('front.layouts.app')

@section('title', $blog->title . ' - Skipper Pipes')

@section('content')

    <!-- Hero Banner -->
    <section class="hero-banner single-blog">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="hero-banner-img">
                        <img src="{{ asset('storage/' . $blog->page_image) }}" alt="hero-banner">
                    </div>
                    <div class="hero-bg-overlay"></div>
                    <div class="hero-banner-contents2 align-center">
                        <div class="container">
                            <div class="row align-center">
                                <div class="col-6 hero-banner-text">
                                    <h1>{{ $blog->title }}</h1>
                                    <div class="meta">
                                        <ul>
                                            <li>
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ $blog->published_at->format('d F, Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 hero-banner-img">
                                    @if ($blog->page_image)
                                        <img src="{{ asset('storage/' . $blog->image_1) }}" alt="{{ $blog->title }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="{{ route('front.blogs.index') }}">Blogs</a></li>
                        <li class="active">{{ $blog->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Banner ends-->

    <!-- Start Blog
                                                                                                                ============================================= -->
    <div class="blog-area single full-blog right-sidebar full-blog default-padding">
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <div class="blog-content col-lg-8 col-md-12">

                        <div class="single-item">

                            <div class="blog-item-box">
                                <div class="item">
                                    {!! $blog->long_description !!}
                                    <div class="info">
                                        <div class="footer-entry">
                                            <h4>Tags: </h4>
                                            @foreach ($blog->tags as $tag)
                                                <a href="#">{{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Start Blog Comment -->
                        @if ($blog->comments->count() > 0)
                            <div class="blog-comments">
                                <div class="comments-area">
                                    <div class="comments-title">
                                        <div class="title">
                                            <h4>{{ $blog->comments->count() }} Comments</h4>
                                        </div>
                                        <div class="comments-list">
                                            @foreach ($blog->comments as $comment)
                                                <div class="commen-item {{ $comment->parent_id ? 'reply' : '' }}">
                                                    <div class="avatar">
                                                        <img src="{{ asset('assets/img/100x100.png') }}" alt="Author">
                                                    </div>
                                                    <div class="content">
                                                        <div class="title">
                                                            <h5>{{ $comment->name }}</h5>
                                                            <span>{{ $comment->created_at->format('d F, Y') }}</span>
                                                        </div>
                                                        <p>{{ $comment->description }}</p>
                                                        <div class="comments-info">
                                                            <a href="#comment-form" data-reply-to="{{ $comment->id }}"
                                                                class="reply-link">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                        @endif

                        <div class="comments-form" id="comment-form">
                            <div class="title">
                                <h4>Leave a comment</h4>
                            </div>
                            <form action="{{ route('front.blogs.comment', $blog->id) }}" method="POST"
                                class="contact-comments">
                                @csrf
                                <input type="hidden" name="parent_id" id="reply_to_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="name" class="form-control" placeholder="Name *" type="text"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="email" class="form-control" placeholder="Email *" type="email"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group comments">
                                            <textarea class="form-control" name="content" placeholder="Comment" required></textarea>
                                        </div>
                                        <div class="form-group full-width submit">
                                            <button type="submit">Post Comments</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Comments Form -->
            </div>

            <!-- Start Sidebar -->
            <div class="sidebar col-lg-4 col-md-12">
                <aside>
                    <!-- <div class="sidebar-item search">
                                                                                                                                            <div class="sidebar-info">
                                                                                                                                                <form>
                                                                                                                                                    <input type="text" name="text" placeholder="Search Here.." class="form-control">
                                                                                                                                                    <button type="submit"><i class="fas fa-search"></i></button>
                                                                                                                                                </form>
                                                                                                                                            </div>
                                                                                                                                        </div> -->
                    <div class="sidebar-item recent-post">
                        <div class="title">
                            <h4>Recent Post</h4>
                        </div>
                        <ul>
                            @foreach ($recentBlogs as $recentBlog)
                                <li>
                                    <div class="thumb">
                                        <a href="{{ route('front.blogs.show', $recentBlog->slug) }}">
                                            <img src="{{ asset('storage/' . $recentBlog->image_1) }}"
                                                alt="{{ $recentBlog->title }}">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <div class="meta-title">
                                            <span
                                                class="post-date">{{ $recentBlog->published_at->format('F d, Y') }}</span>
                                        </div>
                                        <a
                                            href="{{ route('front.blogs.show', $recentBlog->slug) }}">{{ Str::limit($recentBlog->title, 50) }}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-item category">
                        <div class="title">
                            <h4>Category List</h4>
                        </div>
                        <div class="sidebar-info">
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('front.blogs.index', ['category' => $category->id]) }}">
                                            {{ $category->title }}
                                            <span>{{ $category->blogs->count() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="sidebar-item gallery">
                                                                                                                                            <div class="title">
                                                                                                                                                <h4>Gallery</h4>
                                                                                                                                            </div>
                                                                                                                                            <div class="sidebar-info">
                                                                                                                                                <ul>
                                                                                                                                                    <li>
                                                                                                                                                        <a href="#">
                                                                                                                                                            <img src="assets/img/800x800.png" alt="thumb">
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li>
                                                                                                                                                        <a href="#">
                                                                                                                                                            <img src="assets/img/800x800.png" alt="thumb">
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li>
                                                                                                                                                        <a href="#">
                                                                                                                                                            <img src="assets/img/800x800.png" alt="thumb">
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li>
                                                                                                                                                        <a href="#">
                                                                                                                                                            <img src="assets/img/800x800.png" alt="thumb">
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li>
                                                                                                                                                        <a href="#">
                                                                                                                                                            <img src="assets/img/800x800.png" alt="thumb">
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li>
                                                                                                                                                        <a href="#">
                                                                                                                                                            <img src="assets/img/800x800.png" alt="thumb">
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                </ul>
                                                                                                                                            </div>
                                                                                                                                        </div> -->

                    <!-- <div class="sidebar-item social-sidebar">
                                                                                                                                            <div class="title">
                                                                                                                                                <h4>follow us</h4>
                                                                                                                                            </div>
                                                                                                                                            <div class="sidebar-info">
                                                                                                                                                <ul>
                                                                                                                                                    <li class="facebook">
                                                                                                                                                        <a href="#">
                                                                                                                                                            <i class="fab fa-facebook-f"></i>
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li class="twitter">
                                                                                                                                                        <a href="#">
                                                                                                                                                            <i class="fab fa-twitter"></i>
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li class="g-plus">
                                                                                                                                                        <a href="#">
                                                                                                                                                            <i class="fab fa-google-plus-g"></i>
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                    <li class="linkedin">
                                                                                                                                                        <a href="#">
                                                                                                                                                            <i class="fab fa-linkedin-in"></i>
                                                                                                                                                        </a>
                                                                                                                                                    </li>
                                                                                                                                                </ul>
                                                                                                                                            </div>
                                                                                                                                        </div> -->

                    <div class="sidebar-item tags">
                        <div class="title">
                            <h4>Tags</h4>
                        </div>
                        <div class="sidebar-info">
                            <ul>
                                @foreach (App\Models\BlogTag::all() as $tag)
                                    <li>
                                        <a
                                            href="{{ route('front.blogs.index', ['tag' => $tag->id]) }}">{{ $tag->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </aside>
            </div>
            <!-- End Start Sidebar -->
        </div>
    </div>
    </div>
    </div>
    <!-- End Blog -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.reply-link').click(function(e) {
                e.preventDefault();
                const replyToId = $(this).data('reply-to');
                $('#reply_to_id').val(replyToId);
                $('html, body').animate({
                    scrollTop: $("#comment-form").offset().top
                }, 1000);
            });
        });
    </script>
@endpush
