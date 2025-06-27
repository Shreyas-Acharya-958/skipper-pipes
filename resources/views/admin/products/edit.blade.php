@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Product</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $product->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="page_image" class="form-label">Page Image</label>
                                    <input type="file" class="form-control @error('page_image') is-invalid @enderror"
                                        id="page_image" name="page_image">
                                    @if ($product->page_image)
                                        <small class="form-text text-muted">Current: {{ $product->page_image }}</small>
                                    @endif
                                    @error('page_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="product_overview_image" class="form-label">Product Overview Image</label>
                                    <input type="file"
                                        class="form-control @error('product_overview_image') is-invalid @enderror"
                                        id="product_overview_image" name="product_overview_image">
                                    @if ($product->product_overview_image)
                                        <small class="form-text text-muted">Current:
                                            {{ $product->product_overview_image }}</small>
                                    @endif
                                    @error('product_overview_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="brochure" class="form-label">Brochure (PDF)</label>
                                    <input type="file" class="form-control @error('brochure') is-invalid @enderror"
                                        id="brochure" name="brochure" accept=".pdf">
                                    @if ($product->brochure)
                                        <small class="form-text text-muted">Current: {{ $product->brochure }}</small>
                                    @endif
                                    @error('brochure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="product_overview" class="form-label">Product Overview</label>
                            <textarea class="form-control @error('product_overview') is-invalid @enderror" id="product_overview"
                                name="product_overview" rows="4" required>{{ old('product_overview', $product->product_overview) }}</textarea>
                            @error('product_overview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="features_benefits" class="form-label">Features & Benefits</label>
                            <textarea class="form-control @error('features_benefits') is-invalid @enderror" id="features_benefits"
                                name="features_benefits" rows="4" required>{{ old('features_benefits', $product->features_benefits) }}</textarea>
                            @error('features_benefits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="technical" class="form-label">Technical Specifications</label>
                            <textarea class="form-control @error('technical') is-invalid @enderror" id="technical" name="technical" rows="4"
                                required>{{ old('technical', $product->technical) }}</textarea>
                            @error('technical')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="application" class="form-label">Applications</label>
                            <textarea class="form-control @error('application') is-invalid @enderror" id="application" name="application"
                                rows="4" required>{{ old('application', $product->application) }}</textarea>
                            @error('application')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="faq" class="form-label">FAQ</label>
                            <textarea class="form-control @error('faq') is-invalid @enderror" id="faq" name="faq" rows="4"
                                required>{{ old('faq', $product->faq) }}</textarea>
                            @error('faq')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
