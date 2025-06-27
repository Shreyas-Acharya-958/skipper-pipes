@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Category Details</h4>
                    <div class="card-header-actions">
                        <a href="{{ route('admin.blog_categories.edit', $category) }}" class="btn btn-warning">
                            <i class="icon icon-pencil"></i> Edit
                        </a>
                        <a href="{{ route('admin.blog_categories.index') }}" class="btn btn-secondary">
                            <i class="icon icon-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">ID:</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Title:</th>
                            <td>{{ $category->title }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if ($category->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
