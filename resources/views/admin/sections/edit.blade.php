@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Section</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sections.update', $section) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="remove_image" value="0" id="remove_image_input">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $section->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                        name="short_description" rows="3" required>{{ old('short_description', $section->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="long_description" class="form-label">Long Description</label>
                                    <textarea class="form-control tinymce @error('long_description') is-invalid @enderror" id="long_description"
                                        name="long_description">{{ old('long_description', $section->long_description) }}</textarea>
                                    @error('long_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug', $section->slug) }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Section Image</label>
                                    @if ($section->image)
                                        <div class="position-relative d-inline-block mb-2">
                                            <img src="{{ asset('storage/' . $section->image) }}"
                                                alt="{{ $section->title }}" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute remove-image-btn end-0 top-0"
                                                data-field="image">&times;</button>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="1"
                                            {{ old('status', $section->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ old('status', $section->status) == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div id="imagePreview" class="mt-2" style="display: none;">
                                        <img src="" alt="Preview" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label class="form-label mb-1">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"
                                    value="{{ old('meta_title', $section->meta_title ?? '') }}"
                                    placeholder="Enter meta title">
                            </div>
                            <div class="col-12 mb-2">
                                <label class="form-label mb-1">Meta Description</label>
                                <textarea type="text" name="meta_description" class="form-control"
                                    placeholder="Enter meta description">{{ old('meta_description', $section->meta_description ?? '') }} </textarea>
                            </div>
                            <div class="col-6 mb-2">
                                <label class="form-label mb-1">Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control"
                                    value="{{ old('meta_keywords', $section->meta_keywords ?? '') }}"
                                    placeholder="Enter meta keywords">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">Canonical URL</label>
                                <input type="text" name="canonical_url" class="form-control"
                                    value="{{ old('canonical_url', $section->canonical_url ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">Robots</label>
                                <input type="text" name="robots" class="form-control" placeholder="index, follow"
                                    value="{{ old('robots', $section->robots ?? '') }}">
                            </div>
                            <div class="col-12 mt-3">
                                <h6 class="text-success">Open Graph (Facebook)</h6>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">OG Title</label>
                                <input type="text" name="og_title" class="form-control"
                                    value="{{ old('og_title', $section->og_title ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">OG Type</label>
                                <input type="text" name="og_type" class="form-control"
                                    placeholder="website / article"
                                    value="{{ old('og_type', $section->og_type ?? '') }}">
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">OG Description</label>
                                <textarea name="og_description" class="form-control">{{ old('og_description', $section->og_description ?? '') }}</textarea>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">OG Image</label>
                                <input type="file" name="og_image" class="form-control">
                                @if (!empty($meta->og_image))
                                    <small class="text-muted">Current: {{ $section->og_image }}</small>
                                @endif
                            </div>

                            <!-- ================= TWITTER ================= -->
                            <div class="col-12 mt-3">
                                <h6 class="text-info">Twitter Tags</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">Twitter Title</label>
                                <input type="text" name="twitter_title" class="form-control"
                                    value="{{ old('twitter_title', $section->twitter_title ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">Twitter Card</label>
                                <input type="text" name="twitter_card" class="form-control"
                                    placeholder="summary_large_image"
                                    value="{{ old('twitter_card', $section->twitter_card ?? '') }}">
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">Twitter Description</label>
                                <textarea name="twitter_description" class="form-control">{{ old('twitter_description', $section->twitter_description ?? '') }}</textarea>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">Twitter Image</label>
                                <input type="file" name="twitter_image" class="form-control">
                                @if (!empty($meta->twitter_image))
                                    <small class="text-muted">Current: {{ $section->twitter_image }}</small>
                                @endif
                            </div>

                            <!-- ================= SCHEMA ================= -->
                            <div class="col-12 mt-3">
                                <h6 class="text-danger">Schema (JSON-LD)</h6>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">Auto Generated Schema</label>
                                <textarea name="schema_json" class="form-control" rows="4" readonly>
                                            {{ $section->schema_json ?? '' }}
                                    </textarea>
                                <small class="text-muted">This is auto-generated (read-only)</small>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">Custom Schema Override</label>
                                <textarea name="custom_schema_json" class="form-control" rows="5" placeholder='Paste custom JSON schema here'>
                                    {{ old('custom_schema_json', $section->custom_schema_json ?? '') }}
                                </textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Section</button>
                                <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
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
        tinymce.init({
            selector: '#long_description',
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
        // Image preview
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.display = 'block';
                preview.querySelector('img').src = e.target.result;
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        });
        // Remove image
        document.querySelectorAll('.remove-image-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const field = this.getAttribute('data-field');
                // Clear file input
                const input = document.getElementById(field);
                if (input) input.value = '';
                // Hide the preview
                this.parentElement.remove();
                // Set hidden input to 1 (mark for removal)
                document.getElementById('remove_' + field + '_input').value = '1';
            });
        });
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
@endpush
