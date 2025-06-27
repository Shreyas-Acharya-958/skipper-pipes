@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ App\Models\Blog::count() }}
                        </div>
                        <div>Blogs</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ App\Models\Product::count() }}
                        </div>
                        <div>Products</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ App\Models\Contact::count() }}
                        </div>
                        <div>Contacts</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ App\Models\BlogComment::count() }}
                        </div>
                        <div>Comments</div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activities</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Recent Blogs</h6>
                            <ul class="list-unstyled">
                                @foreach (App\Models\Blog::latest()->take(5)->get() as $blog)
                                    <li class="mb-2">
                                        <a href="{{ route('admin.blogs.show', $blog) }}" class="text-decoration-none">
                                            {{ $blog->title }}
                                        </a>
                                        <small class="text-muted d-block">{{ $blog->created_at->diffForHumans() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Recent Contacts</h6>
                            <ul class="list-unstyled">
                                @foreach (App\Models\Contact::latest()->take(5)->get() as $contact)
                                    <li class="mb-2">
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-decoration-none">
                                            {{ $contact->name }} - {{ $contact->subject }}
                                        </a>
                                        <small
                                            class="text-muted d-block">{{ $contact->created_at->diffForHumans() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
