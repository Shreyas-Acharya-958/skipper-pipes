@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Company Page</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.company_pages.update', $company_page) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="remove_image" value="0" id="remove_image_input">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $company_page->title) }}"
                                        required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug', $company_page->slug) }}"
                                        required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="page_image" class="form-label">Page Image</label>
                            <input type="file" class="form-control @error('page_image') is-invalid @enderror"
                                id="page_image" name="page_image" accept="image/*">
                            @if ($company_page->page_image)
                                <div class="mt-2 position-relative d-inline-block">
                                    <img src="{{ asset('storage/' . $company_page->page_image) }}" alt="Page Image"
                                        style="width:100px;height:100px;object-fit:cover;">
                                    <button type="button"
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                        data-field="page_image">&times;</button>
                                </div>
                            @endif
                            @error('page_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Allowed formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                name="short_description" rows="3" required>{{ old('short_description', $company_page->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="long_description" class="form-label">Long Description</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description"
                                name="long_description" rows="6">{{ old('long_description', $company_page->long_description) }}</textarea>
                            @error('long_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sections 1-8 -->
                        <div class="mb-3" style="display: none;">
                            <label for="section_1" class="form-label">Section 1</label>
                            <textarea class="form-control @error('section_1') is-invalid @enderror" id="section_1" name="section_1" rows="6">{{ old('section_1', $company_page->section_1) }}</textarea>
                            @error('section_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="section_2" class="form-label">Section 2</label>
                            <textarea class="form-control @error('section_2') is-invalid @enderror" id="section_2" name="section_2" rows="6">{{ old('section_2', $company_page->section_2) }}</textarea>
                            @error('section_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="section_3" class="form-label">Section 3</label>
                            <textarea class="form-control @error('section_3') is-invalid @enderror" id="section_3" name="section_3" rows="6">{{ old('section_3', $company_page->section_3) }}</textarea>
                            @error('section_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="section_4" class="form-label">Section 4</label>
                            <textarea class="form-control @error('section_4') is-invalid @enderror" id="section_4" name="section_4"
                                rows="6">{{ old('section_4', $company_page->section_4) }}</textarea>
                            @error('section_4')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="section_5" class="form-label">Section 5</label>
                            <textarea class="form-control @error('section_5') is-invalid @enderror" id="section_5" name="section_5"
                                rows="6">{{ old('section_5', $company_page->section_5) }}</textarea>
                            @error('section_5')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="section_6" class="form-label">Section 6</label>
                            <textarea class="form-control @error('section_6') is-invalid @enderror" id="section_6" name="section_6"
                                rows="6">{{ old('section_6', $company_page->section_6) }}</textarea>
                            @error('section_6')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="section_7" class="form-label">Section 7</label>
                            <textarea class="form-control @error('section_7') is-invalid @enderror" id="section_7" name="section_7"
                                rows="6">{{ old('section_7', $company_page->section_7) }}</textarea>
                            @error('section_7')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label for="section_8" class="form-label">Section 8</label>
                            <textarea class="form-control @error('section_8') is-invalid @enderror" id="section_8" name="section_8"
                                rows="6">{{ old('section_8', $company_page->section_8) }}</textarea>
                            @error('section_8')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Meta Information -->
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        id="meta_title" name="meta_title"
                                        value="{{ old('meta_title', $company_page->meta_title) }}">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                        name="meta_description" rows="2">{{ old('meta_description', $company_page->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text"
                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                        id="meta_keywords" name="meta_keywords"
                                        value="{{ old('meta_keywords', $company_page->meta_keywords) }}">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="1"
                                            {{ old('status', $company_page->status) == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $company_page->status) == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none;">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Is Active</label>
                                    <select class="form-select @error('is_active') is-invalid @enderror" id="is_active"
                                        name="is_active" required>
                                        <option value="1"
                                            {{ old('is_active', $company_page->is_active) == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0"
                                            {{ old('is_active', $company_page->is_active) == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.company_pages.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning">Update Page</button>
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
        const editors = ['long_description', 'section_1', 'section_2', 'section_3', 'section_4', 'section_5', 'section_6',
            'section_7', 'section_8'
        ];
        editors.forEach(editor => {
            tinymce.init({
                selector: `#${editor}`,
                height: 300,
                menubar: false,
                plugins: 'lists link image code',
                toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
                verify_html: false,
                cleanup: false,
                valid_elements: '*[*]',
                extended_valid_elements: '*[*]',
                valid_children: '+*[*]',
                preserve_cdata: true,
                entity_encoding: 'raw',
                force_br_newlines: false,
                force_p_newlines: false,
                forced_root_block: '',
                keep_styles: true
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
    </script>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var content = tinymce.get('long_description').getContent({
                format: 'text'
            }).trim();
            if (!content) {
                alert('Long Description is required!');
                tinymce.get('long_description').focus();
                e.preventDefault();
            }
        });

        // Image removal functionality
        document.querySelectorAll('.remove-image-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const field = this.dataset.field;
                // Clear file input
                const input = document.getElementById(field);
                if (input) input.value = '';
                // Hide the preview
                this.parentElement.remove();
                // Set hidden input to 1 (mark for removal)
                document.getElementById('remove_image_input').value = '1';
            });
        });
    </script>
@endpush
