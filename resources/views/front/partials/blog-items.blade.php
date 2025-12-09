@forelse($blogs as $blog)
    <!-- Single Item -->
    <div class="col-lg-4 col-md-6 single-item">
        <div class="item">
            <div class="thumb">
                <a href="{{ route('front.blogs.show', $blog->slug) }}">
                    <img src="{{ asset('storage/' . $blog->image_1) }}" alt="{{ image_alt_text('storage/' . $blog->image_1, $blog->title) }}">
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
