@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Company Page Details</h4>
                    <div>
                        <a href="{{ route('admin.company_pages.edit', $page) }}" class="btn btn-warning">Edit Page</a>
                        <a href="{{ route('admin.company_pages.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 200px;">ID</th>
                                    <td>{{ $page->id }}</td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $page->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $page->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        @if ($page->image)
                                            <img src="{{ asset('storage/' . $page->image) }}" alt="Page Image"
                                                class="img-thumbnail" style="max-height: 200px;">
                                        @else
                                            <span class="text-muted">No image uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Short Description</th>
                                    <td>{{ $page->short_description }}</td>
                                </tr>
                                <tr>
                                    <th>Long Description</th>
                                    <td>{!! $page->long_description !!}</td>
                                </tr>
                                <tr>
                                    <th>Meta Title</th>
                                    <td>{{ $page->meta_title }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description</th>
                                    <td>{{ $page->meta_description }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Keywords</th>
                                    <td>{{ $page->meta_keywords }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-{{ $page->status ? 'success' : 'danger' }}">
                                            {{ $page->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Is Active</th>
                                    <td>
                                        <span class="badge bg-{{ $page->is_active ? 'success' : 'danger' }}">
                                            {{ $page->is_active ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $page->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $page->updated_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
