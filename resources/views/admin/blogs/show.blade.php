@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Details</h4>
                    <div class="card-header-actions">
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-warning">
                            <i class="icon icon-pencil"></i> Edit
                        </a>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                            <i class="icon icon-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">ID:</th>
                                    <td>{{ $blog->id }}</td>
                                </tr>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $blog->title }}</td>
                                </tr>
                                <tr>
                                    <th>Category ID:</th>
                                    <td>{{ $blog->cat_id }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $blog->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if ($blog->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Published At:</th>
                                    <td>{{ $blog->published_at ? $blog->published_at->format('Y-m-d H:i:s') : 'Not Published' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $blog->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $blog->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            @if ($blog->page_image)
                                <div class="mb-3">
                                    <label class="form-label">Page Image:</label>
                                    <img src="{{ asset('storage/' . $blog->page_image) }}" class="img-fluid rounded"
                                        alt="Page Image">
                                </div>
                            @endif
                            @if ($blog->image_1)
                                <div class="mb-3">
                                    <label class="form-label">Image 1:</label>
                                    <img src="{{ asset('storage/' . $blog->image_1) }}" class="img-fluid rounded"
                                        alt="Image 1">
                                </div>
                            @endif
                            @if ($blog->image_2)
                                <div class="mb-3">
                                    <label class="form-label">Image 2:</label>
                                    <img src="{{ asset('storage/' . $blog->image_2) }}" class="img-fluid rounded"
                                        alt="Image 2">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Short Description</h5>
                            <p>{{ $blog->short_description }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Long Description</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($blog->long_description)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
