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
                        <input type="hidden" name="remove_page_image" value="0" id="remove_page_image_input">
                        <input type="hidden" name="remove_product_overview_image" value="0"
                            id="remove_product_overview_image_input">
                        <input type="hidden" name="remove_brochure" value="0" id="remove_brochure_input">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $product->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="page_image" class="form-label">Page Image</label>
                                    <input type="file" class="form-control @error('page_image') is-invalid @enderror"
                                        id="page_image" name="page_image" accept="image/*">
                                    @if ($product->page_image)
                                        <div class="mt-2 position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $product->page_image) }}" alt="Page Image"
                                                style="width:100px;height:100px;object-fit:cover;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                data-field="page_image">&times;</button>
                                        </div>
                                    @endif
                                    @error('page_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_overview_image" class="form-label">Product Overview Image</label>
                                    <input type="file"
                                        class="form-control @error('product_overview_image') is-invalid @enderror"
                                        id="product_overview_image" name="product_overview_image" accept="image/*">
                                    @if ($product->product_overview_image)
                                        <div class="mt-2 position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $product->product_overview_image) }}"
                                                alt="Product Overview Image"
                                                style="width:100px;height:100px;object-fit:cover;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                data-field="product_overview_image">&times;</button>
                                        </div>
                                    @endif
                                    @error('product_overview_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug', $product->slug) }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="product_overview" class="form-label">Product Overview</label>
                            <textarea class="form-control @error('product_overview') is-invalid @enderror" id="product_overview"
                                name="product_overview" rows="6">{{ old('product_overview', $product->product_overview) }}</textarea>
                            @error('product_overview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="features_benefits" class="form-label">Features & Benefits</label>
                            <textarea class="form-control @error('features_benefits') is-invalid @enderror" id="features_benefits"
                                name="features_benefits" rows="6">{{ old('features_benefits', $product->features_benefits) }}</textarea>
                            @error('features_benefits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="technical" class="form-label">Technical Details</label>
                            <textarea class="form-control @error('technical') is-invalid @enderror" id="technical" name="technical" rows="6">{{ old('technical', $product->technical) }}</textarea>
                            @error('technical')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="application" class="form-label">Application</label>
                            <textarea class="form-control @error('application') is-invalid @enderror" id="application" name="application"
                                rows="6">{{ old('application', $product->application) }}</textarea>
                            @error('application')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="faq" class="form-label">FAQ</label>
                            <textarea class="form-control @error('faq') is-invalid @enderror" id="faq" name="faq" rows="6">{{ old('faq', $product->faq) }}</textarea>
                            @error('faq')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="1"
                                            {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="brochure" class="form-label">Brochure</label>
                                    <input type="file" class="form-control @error('brochure') is-invalid @enderror"
                                        id="brochure" name="brochure" accept=".pdf,.doc,.docx">
                                    @if ($product->brochure)
                                        <div class="mt-2 position-relative d-inline-block">
                                            <a href="{{ asset('storage/' . $product->brochure) }}" target="_blank"
                                                class="btn btn-sm btn-info">View Current Brochure</a>
                                            <button type="button" class="btn btn-sm btn-danger ms-2 remove-file-btn"
                                                data-field="brochure">Remove</button>
                                        </div>
                                    @endif
                                    @error('brochure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
    <script>
        const editors = ['product_overview', 'features_benefits', 'technical', 'application', 'faq'];
        editors.forEach(editor => {
            tinymce.init({
                selector: `#${editor}`,
                height: 300,
                menubar: false,
                plugins: 'lists link image code',
                toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code'
            });
        });
    </script>
    <script>
        let slugInput = document.getElementById('slug');
        let titleInput = document.getElementById('title');
        let autoSlug = true;

        slugInput.addEventListener('input', function() {
            autoSlug = false;
        });

        titleInput.addEventListener('input', function() {
            if (autoSlug) {
                let slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
                slugInput.value = slug;
            }
        });

        // Handle image removal
        document.querySelectorAll('.remove-image-btn').forEach(button => {
            button.addEventListener('click', function() {
                const field = this.dataset.field;
                document.getElementById(`remove_${field}_input`).value = '1';
                this.closest('.position-relative').remove();
            });
        });

        // Handle file removal
        document.querySelectorAll('.remove-file-btn').forEach(button => {
            button.addEventListener('click', function() {
                const field = this.dataset.field;
                document.getElementById(`remove_${field}_input`).value = '1';
                this.closest('.position-relative').remove();
            });
        });
    </script>
@endpush
