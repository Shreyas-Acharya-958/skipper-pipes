@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Company Details</h4>
                    <div>
                        <a href="{{ route('admin.company.edit', $company) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.company.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Title</th>
                                    <td>{{ $company->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $company->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Short Description</th>
                                    <td>{{ $company->short_description }}</td>
                                </tr>
                                <tr>
                                    <th>Long Description</th>
                                    <td>{!! nl2br(e($company->long_description)) !!}</td>
                                </tr>
                                <tr>
                                    <th>Meta Title</th>
                                    <td>{{ $company->meta_title }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description</th>
                                    <td>{{ $company->meta_description }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Keywords</th>
                                    <td>{{ $company->meta_keywords }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($company->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Is Active</th>
                                    <td>
                                        @if ($company->is_active)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $company->created_at->format('d M Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $company->updated_at->format('d M Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            @if ($company->page_image)
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Page Image</h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ Storage::url($company->page_image) }}" alt="{{ $company->title }}"
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
