@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Details</h4>
                    <div class="card-header-actions">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                            <i class="icon icon-pencil"></i> Edit
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
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
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $product->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $product->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if ($product->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $product->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            @if ($product->page_image)
                                <div class="mb-3">
                                    <label class="form-label">Page Image:</label>
                                    <img src="{{ asset('storage/' . $product->page_image) }}" class="img-fluid rounded"
                                        alt="Page Image">
                                </div>
                            @endif
                            @if ($product->product_overview_image)
                                <div class="mb-3">
                                    <label class="form-label">Product Overview Image:</label>
                                    <img src="{{ asset('storage/' . $product->product_overview_image) }}"
                                        class="img-fluid rounded" alt="Product Overview Image">
                                </div>
                            @endif
                            @if ($product->brochure)
                                <div class="mb-3">
                                    <label class="form-label">Brochure:</label>
                                    <a href="{{ asset('storage/' . $product->brochure) }}" class="btn btn-sm btn-primary"
                                        target="_blank">
                                        <i class="icon icon-download"></i> Download PDF
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Product Overview</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($product->product_overview)) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Features & Benefits</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($product->features_benefits)) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Technical Specifications</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($product->technical)) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Applications</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($product->application)) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>FAQ</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($product->faq)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
