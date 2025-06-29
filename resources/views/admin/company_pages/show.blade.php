@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Company Page Details</h4>
                    <div class="card-header-actions">
                        <a href="{{ route('admin.company_pages.edit', $page) }}" class="btn btn-warning">
                            <i class="icon icon-pencil"></i> Edit
                        </a>
                        <a href="{{ route('admin.company_pages.index') }}" class="btn btn-secondary">
                            <i class="icon icon-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $page->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $page->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Short Description:</th>
                                    <td>{{ $page->short_description }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $page->status ? 'Active' : 'Inactive' }}</td>
                                </tr>
                                <tr>
                                    <th>Is Active:</th>
                                    <td>{{ $page->is_active ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $page->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $page->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            @if ($page->page_image)
                                <div class="mb-3">
                                    <label class="form-label">Page Image:</label>
                                    <img src="{{ asset('storage/' . $page->page_image) }}" class="img-fluid rounded"
                                        alt="Page Image">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Long Description</h5>
                            <div>{!! $page->long_description !!}</div>
                        </div>
                    </div>

                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $section = "section_$i";
                        @endphp
                        @if ($page->$section)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5>Section {{ $i }}</h5>
                                    <div>{!! $page->$section !!}</div>
                                </div>
                            </div>
                        @endif
                    @endfor

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Meta Information</h5>
                            <table class="table">
                                <tr>
                                    <th>Meta Title:</th>
                                    <td>{{ $page->meta_title }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description:</th>
                                    <td>{{ $page->meta_description }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Keywords:</th>
                                    <td>{{ $page->meta_keywords }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
