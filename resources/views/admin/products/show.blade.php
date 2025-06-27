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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Title:</strong>
                                <p>{{ $product->title }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Slug:</strong>
                                <p>{{ $product->slug }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Status:</strong>
                                <p>
                                    @if ($product->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Page Image:</strong>
                                @if ($product->page_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $product->page_image) }}" alt="Page Image"
                                            style="max-width: 200px; height: auto;">
                                    </div>
                                @else
                                    <p>No page image uploaded</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <strong>Product Overview Image:</strong>
                                @if ($product->product_overview_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $product->product_overview_image) }}"
                                            alt="Product Overview Image" style="max-width: 200px; height: auto;">
                                    </div>
                                @else
                                    <p>No product overview image uploaded</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <strong>Brochure:</strong>
                                @if ($product->brochure)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $product->brochure) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-download"></i> Download Brochure
                                        </a>
                                    </div>
                                @else
                                    <p>No brochure uploaded</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="mb-4">
                                <strong>Product Overview:</strong>
                                <div class="mt-2">
                                    {!! $product->product_overview !!}
                                </div>
                            </div>

                            <div class="mb-4">
                                <strong>Features & Benefits:</strong>
                                <div class="mt-2">
                                    {!! $product->features_benefits !!}
                                </div>
                            </div>

                            <div class="mb-4">
                                <strong>Technical Details:</strong>
                                <div class="mt-2">
                                    {!! $product->technical !!}
                                </div>
                            </div>

                            <div class="mb-4">
                                <strong>Application:</strong>
                                <div class="mt-2">
                                    {!! $product->application !!}
                                </div>
                            </div>

                            <div class="mb-4">
                                <strong>FAQ:</strong>
                                <div class="mt-2">
                                    {!! $product->faq !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
