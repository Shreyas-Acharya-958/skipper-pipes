@extends('front.layouts.app')

@section('title', $blog->title . ' - Skipper Pipes')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-banner single-blog">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="hero-banner-img">
                        <img src="{{ asset('assets/img/final/blogs-banner-final.jpg') }}" alt="hero-banner">
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
                                                {{ $blog->created_at->format('d M, Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 hero-banner-img">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Blog -->
    <div class="blog-area single full-blog right-sidebar full-blog default-padding">
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <div class="blog-content col-lg-8 col-md-12">
                        <div class="blog-item-box">
                            <div class="blog-content-box">
                                {!! $blog->content !!}
                            </div>

                            <!-- Start Post Tags-->
                            <div class="post-tags share">
                                <div class="tags">
                                    <span>Tags: </span>
                                    @foreach ($blog->tags as $tag)
                                        <a href="#">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Post Tags -->

                            <!-- Start Blog Comment -->
                            <div class="blog-comments">
                                <div class="comments-area">
                                    <div class="comments-title">
                                        <h3>{{ $blog->comments->count() }} Comments</h3>
                                    </div>
                                    <div class="comments-list">
                                        <div class="comment-list">
                                            @foreach ($blog->comments as $comment)
                                                <div class="comment-item">
                                                    <div class="avatar">
                                                        <img src="{{ asset('assets/img/100x100.png') }}" alt="Author">
                                                    </div>
                                                    <div class="content">
                                                        <div class="title">
                                                            <h5>{{ $comment->name }}</h5>
                                                            <span>{{ $comment->created_at->format('d M, Y') }}</span>
                                                        </div>
                                                        <p>
                                                            {{ $comment->content }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="comments-form">
                                    <div class="title">
                                        <h3>Leave a comment</h3>
                                    </div>
                                    <form action="{{ route('blog.comment', $blog->id) }}" method="POST"
                                        class="contact-comments">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="name" class="form-control" placeholder="Name *"
                                                        type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="email" class="form-control" placeholder="Email *"
                                                        type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group comments">
                                                    <textarea name="content" class="form-control" placeholder="Comment *"></textarea>
                                                </div>
                                                <div class="form-group full-width submit">
                                                    <button type="submit" class="btn btn-theme effect btn-md">Post
                                                        Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Comments Form -->
                        </div>
                    </div>

                    <!-- Start Sidebar -->
                    <div class="sidebar col-lg-4 col-md-12">
                        <aside>
                            <!-- Start Recent Post -->
                            <div class="sidebar-item recent-post">
                                <div class="title">
                                    <h4>Recent Posts</h4>
                                </div>
                                <ul>
                                    @foreach ($recentBlogs as $recentBlog)
                                        <li>
                                            <div class="thumb">
                                                <a href="{{ route('blog.detail', $recentBlog->slug) }}">
                                                    <img src="{{ asset('storage/' . $recentBlog->image) }}"
                                                        alt="{{ $recentBlog->title }}">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <a
                                                    href="{{ route('blog.detail', $recentBlog->slug) }}">{{ $recentBlog->title }}</a>
                                                <div class="meta-title">
                                                    <span
                                                        class="post-date">{{ $recentBlog->created_at->format('d M, Y') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End Recent Post -->

                            <!-- Start Categories -->
                            <div class="sidebar-item category">
                                <div class="title">
                                    <h4>categories</h4>
                                </div>
                                <div class="sidebar-info">
                                    <ul>
                                        @foreach ($blog->categories as $category)
                                            <li>
                                                <a href="#">{{ $category->name }}
                                                    <span>({{ $category->blogs->count() }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- End Categories -->
                        </aside>
                    </div>
                    <!-- End Start Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog -->
@endsection
