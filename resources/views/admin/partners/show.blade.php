@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Partner Details</h4>
                    <div>
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Title</th>
                                    <td>{{ $partner->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $partner->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Partner Type</th>
                                    <td>{{ $partner->partner_type }}</td>
                                </tr>
                                <tr>
                                    <th>Short Description</th>
                                    <td>{{ $partner->short_description }}</td>
                                </tr>
                                <tr>
                                    <th>Long Description</th>
                                    <td>{!! nl2br(e($partner->long_description)) !!}</td>
                                </tr>
                                <tr>
                                    <th>Meta Title</th>
                                    <td>{{ $partner->meta_title }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description</th>
                                    <td>{{ $partner->meta_description }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Keywords</th>
                                    <td>{{ $partner->meta_keywords }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($partner->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $partner->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $partner->updated_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            @if ($partner->page_image)
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Image</h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ asset('storage/' . $partner->page_image) }}" alt="Partner Image"
                                            class="img-fluid rounded">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
